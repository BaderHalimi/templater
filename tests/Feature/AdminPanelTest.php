<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Filament\Facades\Filament;

it('creates an admin user through the seeder', function (): void {
    $this->seed(AdminUserSeeder::class);

    $admin = User::query()->where('email', 'admin@example.com')->firstOrFail();

    expect($admin->is_admin)->toBeTrue();
    expect($admin->password)->not->toBe('password');
});

it('only grants panel access to admins', function (): void {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $panel = Filament::getPanel('admin');

    expect($admin->canAccessPanel($panel))->toBeTrue();
    expect($user->canAccessPanel($panel))->toBeFalse();
});

it('seeds an admin without creating duplicate records', function (): void {
    User::factory()->create(['email' => 'admin@example.com', 'is_admin' => false]);

    $this->seed(AdminUserSeeder::class);

    expect(User::query()->where('email', 'admin@example.com')->count())->toBe(1);
    expect(User::query()->where('email', 'admin@example.com')->firstOrFail()->is_admin)->toBeTrue();
});