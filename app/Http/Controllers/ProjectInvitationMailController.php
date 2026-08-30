<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendProjectInvitationRequest;
use App\Mail\ProjectInvitationMail;
use App\Models\InvitationProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ProjectInvitationMailController extends Controller
{
    public function store(SendProjectInvitationRequest $request, InvitationProject $project): RedirectResponse
    {
        abort_unless($project->user_id === $request->user()->id, 404);

        foreach ($request->recipients() as $recipient) {
            Mail::to($recipient)->send(new ProjectInvitationMail($project));
        }

        return back()->with('status', 'تم إرسال الدعوة بنجاح إلى '.count($request->recipients()).' بريد.');
    }
}
