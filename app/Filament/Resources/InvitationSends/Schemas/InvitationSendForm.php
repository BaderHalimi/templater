<?php

namespace App\Filament\Resources\InvitationSends\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvitationSendForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('invitation_project_id')
                    ->relationship('invitationProject', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('recipient_email')
                    ->email()
                    ->required(),
                DateTimePicker::make('sent_at')
                    ->required(),
            ]);
    }
}