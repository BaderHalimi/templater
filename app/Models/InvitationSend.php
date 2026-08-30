<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $invitation_project_id
 * @property string $recipient_email
 * @property Carbon $sent_at
 */
#[Fillable(['user_id', 'recipient_email', 'sent_at'])]
class InvitationSend extends Model
{
    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<InvitationProject, $this>
     */
    public function invitationProject(): BelongsTo
    {
        return $this->belongsTo(InvitationProject::class);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
        ];
    }
}
