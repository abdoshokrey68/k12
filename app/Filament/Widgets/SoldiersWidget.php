<?php

namespace App\Filament\Widgets;

use App\Models\Soldier;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class SoldiersWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // $soldiers_query = Soldier::query();

        return [
            Card::make("الجنود", Soldier::where('rank', 'soldiers')->count()),
            Card::make("صف ضباط", Soldier::where('rank', 'non_commissioned_officers')->count()),
            Card::make("ضباط", Soldier::where('rank', 'officers')->count()),
        ];
    }
}
