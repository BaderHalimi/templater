<?php

use App\Filament\Resources\InvitationSends\Pages\CreateInvitationSend;
use App\Filament\Resources\InvitationSends\Pages\ListInvitationSends;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Widgets\InvitationUsageOverview;
use App\Filament\Widgets\TopConsumers;
use App\Models\InvitationProject;
use App\Models\InvitationSend;
use App\Models\User;
use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

it('renders the users admin page', function (): void {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(ListUsers::class)
        ->assertSuccessful();
});

it('renders the invitation sends admin page', function (): void {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    $send = InvitationSend::factory()->for($user)->create();

    Livewire::actingAs($admin)
        ->test(ListInvitationSends::class)
        ->assertSuccessful()
        ->assertSee($send->recipient_email);
});

it('renders the admin dashboard without errors', function (): void {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    InvitationSend::factory()->for($user)->create([
        'invitation_project_id' => InvitationProject::factory()->for($user),
    ]);

    Livewire::actingAs($admin)
        ->test(Dashboard::class)
        ->assertSuccessful();
});

it('renders the usage widgets with real data', function (): void {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(InvitationUsageOverview::class)
        ->assertSuccessful();

    Livewire::actingAs($admin)
        ->test(TopConsumers::class)
        ->assertSuccessful();
});

it('creates an admin user from the users form', function (): void {
    $admin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(CreateUser::class)
        ->fillForm([
            'name' => 'New Admin',
            'email' => 'new-admin@example.com',
            'password' => 'secret123',
            'is_admin' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::query()->where('email', 'new-admin@example.com')->firstOrFail();

    expect($user->is_admin)->toBeTrue();
    expect(Hash::check('secret123', $user->password))->toBeTrue();
});

it('creates an invitation send from its form', function (): void {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();
    $project = InvitationProject::factory()->for($user)->create();

    Livewire::actingAs($admin)
        ->test(CreateInvitationSend::class)
        ->fillForm([
            'user_id' => $user->id,
            'invitation_project_id' => $project->id,
            'recipient_email' => 'guest@example.com',
            'sent_at' => '2026-08-30 10:00:00',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('invitation_sends', [
        'user_id' => $user->id,
        'invitation_project_id' => $project->id,
        'recipient_email' => 'guest@example.com',
    ]);
});
