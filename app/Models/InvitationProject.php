<?php

namespace App\Models;

use Database\Factories\InvitationProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property array<int, string> $team_members
 * @property string|null $supervisor
 * @property Carbon $discussion_at
 * @property string $discussion_place
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['user_id', 'title', 'team_members', 'supervisor', 'discussion_at', 'discussion_place', 'notes'])]
class InvitationProject extends Model
{
    /** @use HasFactory<InvitationProjectFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'team_members' => 'array',
            'discussion_at' => 'datetime',
        ];
    }
}
