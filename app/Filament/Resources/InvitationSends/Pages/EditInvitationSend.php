<?php

namespace App\Filament\Resources\InvitationSends\Pages;

use App\Filament\Resources\InvitationSends\InvitationSendResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvitationSend extends EditRecord
{
    protected static string $resource = InvitationSendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
