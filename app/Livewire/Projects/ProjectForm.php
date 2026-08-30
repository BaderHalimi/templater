<?php

namespace App\Livewire\Projects;

use App\InvitationTextTemplate;
use App\Models\InvitationProject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProjectForm extends Component
{
    public ?InvitationProject $project = null;

    public string $title = '';

    public string $teamMembers = '';

    public string $supervisor = '';

    public string $discussionAt = '';

    public string $discussionPlace = '';

    public string $notes = '';

    public string $textTemplate = 'formal';

    public function mount(?InvitationProject $project = null): void
    {
        if ($project === null) {
            return;
        }

        abort_unless($project->user_id === auth()->id(), 404);

        $this->project = $project;
        $this->title = $project->title;
        $this->teamMembers = implode("\n", $project->team_members);
        $this->supervisor = $project->supervisor ?? '';
        $this->discussionAt = $project->discussion_at->format('Y-m-d\TH:i');
        $this->discussionPlace = $project->discussion_place;
        $this->notes = $project->notes ?? '';
        $this->textTemplate = $project->invitationTextTemplate()->value;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'teamMembers' => ['required', 'string', 'max:2000'],
            'supervisor' => ['nullable', 'string', 'max:255'],
            'discussionAt' => ['required', 'date'],
            'discussionPlace' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'textTemplate' => ['required', Rule::in(InvitationTextTemplate::values())],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        $project = $this->project ?? new InvitationProject(['user_id' => auth()->id()]);

        $project->fill([
            'title' => $validated['title'],
            'team_members' => $this->teamMemberList(),
            'supervisor' => $validated['supervisor'] ?: null,
            'discussion_at' => $validated['discussionAt'],
            'discussion_place' => $validated['discussionPlace'],
            'notes' => $validated['notes'] ?: null,
            'text_template' => $validated['textTemplate'],
        ]);
        $project->save();

        $this->redirectRoute('projects.show', ['project' => $project], navigate: true);
    }

    /**
     * @return array<int, string>
     */
    private function teamMemberList(): array
    {
        return Str::of($this->teamMembers)
            ->replace([',', '،'], "\n")
            ->explode("\n")
            ->map(fn (string $member): string => trim($member))
            ->filter()
            ->values()
            ->all();
    }

    public function render(): View
    {
        return view('livewire.projects.project-form');
    }
}
