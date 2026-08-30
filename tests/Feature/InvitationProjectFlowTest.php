<?php

use App\Mail\ProjectInvitationMail;
use App\Models\InvitationProject;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\actingAs;

it('registers a user and opens the projects area', function (): void {
    $response = $this->post(route('register'), [
        'name' => 'Demo User',
        'email' => 'demo@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('projects.index'));
    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'demo@example.com',
    ]);
});

it('creates an invitation project for the authenticated user', function (): void {
    $user = User::factory()->create();

    $response = actingAs($user)->post(route('projects.store'), [
        'title' => 'AI-Based Classification of Web Server Logs',
        'team_members' => "ديما مغاري\nفرح مدوخ\nملك البنا",
        'supervisor' => 'م. محمد زاهر الشوربجي',
        'discussion_at' => '2026-08-30T12:00',
        'discussion_place' => 'الكلية الجامعية - خانيونس',
    ]);

    $project = InvitationProject::query()->firstOrFail();

    $response->assertRedirect(route('projects.show', $project));
    $this->assertDatabaseHas('invitation_projects', [
        'id' => $project->id,
        'user_id' => $user->id,
        'title' => 'AI-Based Classification of Web Server Logs',
    ]);
    expect($project->team_members)->toBe(['ديما مغاري', 'فرح مدوخ', 'ملك البنا']);
});

it('hides another users invitation project', function (): void {
    $owner = User::factory()->create();
    $visitor = User::factory()->create();
    $project = InvitationProject::factory()->for($owner)->create();

    actingAs($visitor)
        ->get(route('projects.show', $project))
        ->assertNotFound();
});

it('sends the invitation email to unique recipients immediately', function (): void {
    Mail::fake();
    $user = User::factory()->create();
    $project = InvitationProject::factory()->for($user)->create();

    $response = actingAs($user)->post(route('projects.invitations.send', $project), [
        'emails' => "guest@example.com\nteacher@example.com\nguest@example.com",
    ]);

    $response->assertRedirect();
    Mail::assertSent(ProjectInvitationMail::class, 2);
    Mail::assertSent(ProjectInvitationMail::class, function (ProjectInvitationMail $mail): bool {
        return $mail->hasTo('guest@example.com');
    });
    Mail::assertSent(ProjectInvitationMail::class, function (ProjectInvitationMail $mail): bool {
        return $mail->hasTo('teacher@example.com');
    });
});

it('rejects invalid invitation recipients without sending mail', function (): void {
    Mail::fake();
    $user = User::factory()->create();
    $project = InvitationProject::factory()->for($user)->create();

    $response = actingAs($user)->from(route('projects.show', $project))->post(route('projects.invitations.send', $project), [
        'emails' => 'not-an-email',
    ]);

    $response->assertRedirect(route('projects.show', $project));
    $response->assertSessionHasErrors('emails');
    Mail::assertNothingSent();
});

it('renders the project details inside the html invitation mail', function (): void {
    $project = InvitationProject::factory()->create([
        'title' => 'AI-Based Classification of Web Server Logs',
        'discussion_place' => 'قاعة المؤتمرات',
    ]);

    $html = (new ProjectInvitationMail($project))->render();

    expect($html)
        ->toContain('AI-Based Classification of Web Server Logs')
        ->toContain('قاعة المؤتمرات')
        ->toContain('دعوة لحضور مناقشة مشروع تخرج');
});
