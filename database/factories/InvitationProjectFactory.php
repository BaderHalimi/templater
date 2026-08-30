<?php

namespace Database\Factories;

use App\Models\InvitationProject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvitationProject>
 */
class InvitationProjectFactory extends Factory
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
            'title' => 'AI-Based Classification of Web Server Logs',
            'team_members' => ['ديما مغاري', 'فرح مدوخ', 'ملك البنا', 'سارة السلوت'],
            'supervisor' => 'م. محمد زاهر الشوربجي',
            'discussion_at' => now()->addWeek()->setTime(12, 0),
            'discussion_place' => 'الكلية الجامعية - خانيونس، قاعة المؤتمرات',
            'notes' => null,
        ];
    }
}
