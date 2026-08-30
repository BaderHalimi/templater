<?php

use App\Filament\Resources\InvitationSends\Pages\ListInvitationSends;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\InvitationSend;
use App\Models\User;
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