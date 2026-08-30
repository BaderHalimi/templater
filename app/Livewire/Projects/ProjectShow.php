<?php

namespace App\Livewire\Projects;

use App\Mail\ProjectInvitationMail;
use App\Models\InvitationProject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProjectShow extends Component
{
    public InvitationProject $project;

    public string $emails = '';

    public ?string $sendStatus = null;

    public function mount(InvitationProject $project): void
    {
        abort_unless($project->user_id === auth()->id(), 404);

        $this->project = $project;
    }

    public function send(): void
    {
        $this->validate([
            'emails' => ['required', 'string', 'max:10000'],
        ]);

        $recipients = $this->recipients();

        if ($recipients === []) {
            $this->addError('emails', 'أدخل بريداً إلكترونياً واحداً على الأقل.');

            return;
        }

        if (count($recipients) > 50) {
            $this->addError('emails', 'يمكن إرسال الدعوة إلى 50 بريداً كحد أقصى في كل مرة.');

            return;
        }

        foreach ($recipients as $recipient) {
            if (filter_var($recipient, FILTER_VALIDATE_EMAIL) === false) {
                $this->addError('emails', "البريد {$recipient} غير صحيح.");

                return;
            }
        }

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new ProjectInvitationMail($this->project));
        }

        $this->emails = '';
        $this->sendStatus = 'تم إرسال الدعوة بنجاح إلى '.count($recipients).' بريد.';
    }

    /**
     * @return array<int, string>
     */
    private function recipients(): array
    {
        return Str::of($this->emails)
            ->replace(["\r\n", "\r", ',', ';', '،'], "\n")
            ->explode("\n")
            ->map(fn (string $email): string => Str::lower(trim($email)))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    public function render(): View
    {
        return view('livewire.projects.project-show');
    }
}
