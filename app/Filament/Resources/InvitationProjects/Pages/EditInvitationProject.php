<?php

namespace App\Filament\Resources\InvitationProjects\Pages;

use App\Filament\Resources\InvitationProjects\InvitationProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvitationProject extends EditRecord
{
    protected static string $resource = InvitationProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
