<?php

namespace App\Filament\Resources\InvitationProjects\Schemas;

use App\InvitationTextTemplate;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InvitationProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('team_members')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('supervisor'),
                DateTimePicker::make('discussion_at')
                    ->required(),
                TextInput::make('discussion_place')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('text_template')
                    ->options(InvitationTextTemplate::class)
                    ->default('formal')
                    ->required(),
            ]);
    }
}
