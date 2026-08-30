<?php

namespace App\Filament\Resources\InvitationSends\Pages;

use App\Filament\Resources\InvitationSends\InvitationSendResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvitationSends extends ListRecords
{
    protected static string $resource = InvitationSendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
