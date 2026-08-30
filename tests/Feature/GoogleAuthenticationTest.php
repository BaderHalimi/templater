<?php

use App\Models\User;
use Illuminate\Http\Client\Request as HttpRequest;
use Illuminate\Support\Facades\Http;

beforeEach(function (): void {
    config([
        'services.google.client_id' => 'google-client-id',
        'services.google.client_secret' => 'google-client-secret',
        'services.google.redirect' => 'https://templater.ucaseng.club/auth/google/callback',
    ]);
});

it('redirects users to Google with a university domain hint', function (): void {
    $response = $this->get(route('auth.google.redirect'));

    $response->assertRedirect();

    expect($response->headers->get('Location'))
        ->toContain('https://accounts.google.com/o/oauth2/v2/auth')
        ->toContain('hd=ucas.edu.ps')
        ->toContain('state=');

    expect(session('google_oauth_state'))->not->toBeEmpty();
});

it('keeps users on the login page when Google is not configured', function (): void {
    config([
        'services.google.client_id' => null,
        'services.google.client_secret' => null,
        'services.google.redirect' => null,
    ]);

    $this->get(route('auth.google.redirect'))
        ->assertRedirect(route('login'))
        ->assertSessionHas('authError', 'تسجيل الدخول عبر Google غير مُعدّ بعد. تواصل مع مسؤول النظام.');
});

it('creates and signs in a user with a verified university email', function (): void {
    Http::preventStrayRequests();
    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response(['access_token' => 'google-access-token']),
        'https://openidconnect.googleapis.com/v1/userinfo' => Http::response([
            'email' => 'student@smail.ucas.edu.ps',
            'email_verified' => true,
            'name' => 'University Student',
        ]),
    ]);

    $response = $this->withSession(['google_oauth_state' => 'valid-state'])
        ->get(route('auth.google.callback', ['code' => 'google-code', 'state' => 'valid-state']));

    $response->assertRedirect(route('projects.index'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'student@smail.ucas.edu.ps',
        'name' => 'University Student',
    ]);

    expect(User::query()->where('email', 'student@smail.ucas.edu.ps')->firstOrFail()->email_verified_at)->not->toBeNull();

    Http::assertSent(fn (HttpRequest $request): bool => $request->url() === 'https://oauth2.googleapis.com/token'
        && $request['code'] === 'google-code');
});

it('rejects a verified Google account outside the university domains', function (): void {
    Http::preventStrayRequests();
    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response(['access_token' => 'google-access-token']),
        'https://openidconnect.googleapis.com/v1/userinfo' => Http::response([
            'email' => 'student@gmail.com',
            'email_verified' => true,
            'name' => 'Personal Account',
        ]),
    ]);

    $response = $this->withSession(['google_oauth_state' => 'valid-state'])
        ->get(route('auth.google.callback', ['code' => 'google-code', 'state' => 'valid-state']));

    $response
        ->assertRedirect(route('login'))
        ->assertSessionHas('authError', 'الدخول متاح فقط بحسابات الكلية الجامعية.');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'student@gmail.com']);
});

it('rejects a callback that does not match the Google login session', function (): void {
    Http::preventStrayRequests();

    $response = $this->withSession(['google_oauth_state' => 'valid-state'])
        ->get(route('auth.google.callback', ['code' => 'google-code', 'state' => 'wrong-state']));

    $response
        ->assertRedirect(route('login'))
        ->assertSessionHas('authError', 'تعذر التحقق من طلب الدخول. حاول مرة أخرى.');

    $this->assertGuest();
});
