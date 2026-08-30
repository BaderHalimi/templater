<?php

namespace App\Filament\Resources\InvitationSends;

use App\Filament\Resources\InvitationSends\Pages\CreateInvitationSend;
use App\Filament\Resources\InvitationSends\Pages\EditInvitationSend;
use App\Filament\Resources\InvitationSends\Pages\ListInvitationSends;
use App\Filament\Resources\InvitationSends\Schemas\InvitationSendForm;
use App\Filament\Resources\InvitationSends\Tables\InvitationSendsTable;
use App\Models\InvitationSend;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvitationSendResource extends Resource
{
    protected static ?string $model = InvitationSend::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InvitationSendForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvitationSendsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInvitationSends::route('/'),
            'create' => CreateInvitationSend::route('/create'),
            'edit' => EditInvitationSend::route('/{record}/edit'),
        ];
    }
}
