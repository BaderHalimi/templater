<?php

namespace App\Filament\Resources\InvitationSends\Tables;

use App\Models\InvitationProject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InvitationSendsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('invitationProject.title')
                    ->label('Project')
                    ->searchable(),
                TextColumn::make('recipient_email')
                    ->label('Recipient email')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('sent_at')
                    ->label('Sent at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('invitation_project_id')
                    ->label('Project')
                    ->options(fn (): array => InvitationProject::query()->pluck('title', 'id')->all()),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}