<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GoogleAuthenticatedSessionController extends Controller
{
    /** @var array<int, string> */
    private const AllowedEmailDomains = ['@smail.ucas.edu.ps', '@ucas.edu.ps'];

    public function redirect(Request $request): RedirectResponse
    {
        if (! $this->googleIsConfigured()) {
            return $this->authenticationFailed('تسجيل الدخول عبر Google غير مُعدّ بعد. تواصل مع مسؤول النظام.');
        }

        $state = Str::random(40);

        $request->session()->put('google_oauth_state', $state);

        return redirect()->away('https://accounts.google.com/o/oauth2/v2/auth?'.http_build_query([
            'client_id' => config('services.google.client_id'),
            'redirect_uri' => config('services.google.redirect'),
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $state,
            'hd' => 'ucas.edu.ps',
            'prompt' => 'select_account',
        ]));
    }

    public function callback(Request $request): RedirectResponse
    {
        $expectedState = (string) $request->session()->pull('google_oauth_state');
        $state = (string) $request->query('state');

        if ($expectedState === '' || $state === '' || ! hash_equals($expectedState, $state)) {
            return $this->authenticationFailed('تعذر التحقق من طلب الدخول. حاول مرة أخرى.');
        }

        $code = (string) $request->query('code');

        if ($code === '') {
            return $this->authenticationFailed('لم يكتمل تسجيل الدخول عبر Google.');
        }

        try {
            $token = Http::asForm()
                ->connectTimeout(3)
                ->timeout(8)
                ->post('https://oauth2.googleapis.com/token', [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'redirect_uri' => config('services.google.redirect'),
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                ])
                ->throw()
                ->json('access_token');

            if (! is_string($token) || $token === '') {
                return $this->authenticationFailed('لم يكتمل تسجيل الدخول عبر Google.');
            }

            $profile = Http::withToken($token)
                ->connectTimeout(3)
                ->timeout(8)
                ->retry([100, 250])
                ->get('https://openidconnect.googleapis.com/v1/userinfo')
                ->throw()
                ->json();
        } catch (ConnectionException|RequestException) {
            return $this->authenticationFailed('تعذر الاتصال بخدمة Google. حاول مرة أخرى.');
        }

        $email = Str::lower(trim((string) ($profile['email'] ?? '')));
        $isVerified = ($profile['email_verified'] ?? false) === true;

        if (! $isVerified || ! $this->hasAllowedEmailDomain($email)) {
            return $this->authenticationFailed('الدخول متاح فقط بحسابات الكلية الجامعية.');
        }

        $name = trim((string) ($profile['name'] ?? ''));

        $user = User::query()->firstOrCreate(
            ['email' => $email],
            [
                'name' => $name !== '' ? $name : Str::before($email, '@'),
                'password' => Str::random(64),
            ],
        );

        if ($user->email_verified_at === null) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('projects.index'));
    }

    private function hasAllowedEmailDomain(string $email): bool
    {
        return Str::endsWith($email, self::AllowedEmailDomains);
    }

    private function googleIsConfigured(): bool
    {
        return filled(config('services.google.client_id'))
            && filled(config('services.google.client_secret'))
            && filled(config('services.google.redirect'));
    }

    private function authenticationFailed(string $message): RedirectResponse
    {
        return redirect()->route('login')->with('authError', $message);
    }
}
