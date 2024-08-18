<?php

namespace App\Filament\Widgets;

use App\Models\Point;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PointsCounts extends BaseWidget
{
    protected function getStats(): array
    {
        $first_secrecy = Point::where('statments', 'first_secrecy')->count();
        $second_secrecy = Point::where('statments', 'second_secrecy')->count();
        $third_secrecy = Point::where('statments', 'third_secrecy')->count();
        return [
            Card::make("نقاط السرية الأولي", $first_secrecy),
            Card::make("نقاط السرية الثانية", $second_secrecy),
            Card::make("نقاط السرية الثالثة", $third_secrecy),
        ];
    }
}
