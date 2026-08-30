<?php

namespace App\Filament\Widgets;

use App\Models\InvitationProject;
use App\Models\InvitationSend;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InvitationUsageOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $users = User::count();
        $projects = InvitationProject::count();
        $sends = InvitationSend::count();
        $avgPerUser = $users > 0 ? round($sends / $users, 1) : 0;

        return [
            Stat::make('Users', $users)
                ->icon(Heroicon::OutlinedUsers)
                ->description('Total registered users'),
            Stat::make('Invitation projects', $projects)
                ->icon(Heroicon::OutlinedClipboardDocumentList)
                ->description('Total created projects'),
            Stat::make('Invitations sent', $sends)
                ->icon(Heroicon::OutlinedPaperAirplane)
                ->description('Total emails dispatched'),
            Stat::make('Average sends per user', $avgPerUser)
                ->icon(Heroicon::OutlinedArrowTrendingUp)
                ->description('Sends divided by users'),
        ];
    }
}