<?php

namespace App\Filament\Resources\InvitationProjects\Pages;

use App\Filament\Resources\InvitationProjects\InvitationProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvitationProjects extends ListRecords
{
    protected static string $resource = InvitationProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
