<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TopConsumers extends TableWidget
{
    protected function getTableHeading(): string
    {
        return 'Top consumers';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => User::query()
                    ->withCount(['invitationSends', 'invitationProjects'])
                    ->orderByDesc('invitation_sends_count')
            )
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('invitation_sends_count')
                    ->label('Invitations sent')
                    ->sortable(),
                TextColumn::make('invitation_projects_count')
                    ->label('Projects')
                    ->sortable(),
            ])
            ->paginated(false);
    }
}