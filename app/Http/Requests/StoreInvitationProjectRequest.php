<?php

namespace App\Http\Requests;

use App\InvitationTextTemplate;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreInvitationProjectRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'team_members' => ['required', 'string', 'max:2000'],
            'supervisor' => ['nullable', 'string', 'max:255'],
            'discussion_at' => ['required', 'date'],
            'discussion_place' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'text_template' => ['required', Rule::in(InvitationTextTemplate::values())],
        ];
    }

    /**
     * @return array<int, string>
     */
    public function teamMembers(): array
    {
        return Str::of($this->validated('team_members'))
            ->replace([',', '،'], "\n")
            ->explode("\n")
            ->map(fn (string $member): string => trim($member))
            ->filter()
            ->values()
            ->all();
    }
}
