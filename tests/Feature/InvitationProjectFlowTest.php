<?php

use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectShow;
use App\Mail\ProjectInvitationMail;
use App\Models\InvitationProject;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('redirects manual registration to the university Google login', function (): void {
    $this->get(route('register'))->assertRedirect(route('login'));
});

it('creates an invitation project for the authenticated user', function (): void {
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(ProjectForm::class)
        ->set('title', 'AI-Based Classification of Web Server Logs')
        ->set('teamMembers', "ديما مغاري\nفرح مدوخ\nملك البنا")
        ->set('supervisor', 'م. محمد زاهر الشوربجي')
        ->set('discussionAt', '2026-08-30T12:00')
        ->set('discussionPlace', 'الكلية الجامعية - خانيونس')
        ->set('textTemplate', 'warm')
        ->call('save');

    $project = InvitationProject::query()->firstOrFail();

    $component->assertRedirect(route('projects.show', $project));
    $this->assertDatabaseHas('invitation_projects', [
        'id' => $project->id,
        'user_id' => $user->id,
        'title' => 'AI-Based Classification of Web Server Logs',
    ]);
    expect($project->team_members)->toBe(['ديما مغاري', 'فرح مدوخ', 'ملك البنا']);
    expect($project->text_template->value)->toBe('warm');
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

    Livewire::actingAs($user)
        ->test(ProjectShow::class, ['project' => $project])
        ->set('emails', "guest@example.com\nteacher@example.com\nguest@example.com")
        ->call('send')
        ->assertHasNoErrors();

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

    Livewire::actingAs($user)
        ->test(ProjectShow::class, ['project' => $project])
        ->set('emails', 'not-an-email')
        ->call('send')
        ->assertHasErrors(['emails']);

    Mail::assertNothingSent();
});

it('renders the project details inside the html invitation mail', function (): void {
    $project = InvitationProject::factory()->create([
        'title' => 'AI-Based Classification of Web Server Logs',
        'discussion_place' => 'قاعة المؤتمرات',
        'text_template' => 'academic',
        'team_members' => ['أمل خالد', 'سليم ناصر'],
    ]);

    $html = (new ProjectInvitationMail($project))->render();

    expect($html)
        ->toContain('AI-Based Classification of Web Server Logs')
        ->toContain('قاعة المؤتمرات')
        ->toContain('أمل خالد')
        ->toContain('سليم ناصر')
        ->toContain('أعضاء الفريق')
        ->toContain('النــــــــادي الهنـــــــدسي')
        ->toContain('مساحة للابداع والتميز')
        ->toContain(asset('logo/ucas_eng_club_web.png'))
        ->toContain('دعوة لحضور')
        ->toContain('مناقشة مشروع تخرج')
        ->toContain('href="'.config('app.url').'"')
        ->toContain((string) config('app.name'))
        ->toContain('ندعوكم إلى جلسة علمية نستعرض فيها منهجية المشروع ونتائجه ومساراته التطبيقية بعنوان:');
});
