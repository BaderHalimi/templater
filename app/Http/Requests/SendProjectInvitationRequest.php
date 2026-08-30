<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class SendProjectInvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'emails' => ['required', 'string', 'max:10000'],
        ];
    }

    /**
     * @return array<int, string>
     */
    public function recipients(): array
    {
        return Str::of($this->string('emails')->toString())
            ->replace(["\r\n", "\r", ',', ';', '،'], "\n")
            ->explode("\n")
            ->map(fn (string $email): string => Str::lower(trim($email)))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * @return array<int, callable(Validator): void>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                $recipients = $this->recipients();

                if ($recipients === []) {
                    $validator->errors()->add('emails', 'أدخل بريداً إلكترونياً واحداً على الأقل.');

                    return;
                }

                if (count($recipients) > 50) {
                    $validator->errors()->add('emails', 'يمكن إرسال الدعوة إلى 50 بريداً كحد أقصى في كل مرة.');
                }

                foreach ($recipients as $recipient) {
                    if (filter_var($recipient, FILTER_VALIDATE_EMAIL) === false) {
                        $validator->errors()->add('emails', "البريد {$recipient} غير صحيح.");
                    }
                }
            },
        ];
    }
}
