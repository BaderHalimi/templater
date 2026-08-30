<?php

namespace App\Filament\Resources\InvitationProjects;

use App\Filament\Resources\InvitationProjects\Pages\CreateInvitationProject;
use App\Filament\Resources\InvitationProjects\Pages\EditInvitationProject;
use App\Filament\Resources\InvitationProjects\Pages\ListInvitationProjects;
use App\Filament\Resources\InvitationProjects\Schemas\InvitationProjectForm;
use App\Filament\Resources\InvitationProjects\Tables\InvitationProjectsTable;
use App\Models\InvitationProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvitationProjectResource extends Resource
{
    protected static ?string $model = InvitationProject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return InvitationProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvitationProjectsTable::configure($table);
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
            'index' => ListInvitationProjects::route('/'),
            'create' => CreateInvitationProject::route('/create'),
            'edit' => EditInvitationProject::route('/{record}/edit'),
        ];
    }
}
