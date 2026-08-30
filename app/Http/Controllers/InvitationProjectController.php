<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationProjectRequest;
use App\Models\InvitationProject;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvitationProjectController extends Controller
{
    public function index(Request $request): View
    {
        $projects = $request->user()
            ->invitationProjects()
            ->latest()
            ->get();

        return view('projects.index', ['projects' => $projects]);
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(StoreInvitationProjectRequest $request): RedirectResponse
    {
        $validated = $request->safe()->only([
            'title',
            'supervisor',
            'discussion_at',
            'discussion_place',
            'notes',
            'text_template',
        ]);

        $project = $request->user()->invitationProjects()->create([
            ...$validated,
            'team_members' => $request->teamMembers(),
        ]);

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'تم إنشاء صفحة الدعوة بنجاح.');
    }

    public function show(Request $request, InvitationProject $project): View
    {
        $this->authorizeProjectOwner($request, $project);

        return view('projects.show', ['project' => $project]);
    }

    public function edit(Request $request, InvitationProject $project): View
    {
        $this->authorizeProjectOwner($request, $project);

        return view('projects.edit', ['project' => $project]);
    }

    public function update(StoreInvitationProjectRequest $request, InvitationProject $project): RedirectResponse
    {
        $this->authorizeProjectOwner($request, $project);

        $validated = $request->safe()->only([
            'title',
            'supervisor',
            'discussion_at',
            'discussion_place',
            'notes',
            'text_template',
        ]);

        $project->update([
            ...$validated,
            'team_members' => $request->teamMembers(),
        ]);

        return redirect()
            ->route('projects.show', $project)
            ->with('status', 'تم تحديث الدعوة.');
    }

    private function authorizeProjectOwner(Request $request, InvitationProject $project): void
    {
        abort_unless($project->user_id === $request->user()->id, 404);
    }
}
