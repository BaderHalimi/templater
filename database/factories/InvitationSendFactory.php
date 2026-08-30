<?php

namespace Database\Factories;

use App\Models\InvitationProject;
use App\Models\InvitationSend;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvitationSend>
 */
class InvitationSendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'invitation_project_id' => InvitationProject::factory(),
            'recipient_email' => fake()->safeEmail(),
            'sent_at' => now()->subMinutes(rand(1, 60)),
        ];
    }
}