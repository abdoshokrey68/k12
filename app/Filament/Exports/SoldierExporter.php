<?php

namespace App\Filament\Exports;

use App\Models\Soldier;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SoldierExporter extends Exporter
{
    protected static ?string $model = Soldier::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('rank'),
            ExportColumn::make('photo'),
            ExportColumn::make('name'),
            ExportColumn::make('phone'),
            ExportColumn::make('recruitment'),
            ExportColumn::make('forces'),
            ExportColumn::make('military_number'),
            ExportColumn::make('three_digit_n_umber'),
            ExportColumn::make('date_of_end_of_service'),
            ExportColumn::make('join_date'),
            ExportColumn::make('weapon'),
            ExportColumn::make('trained_duty'),
            ExportColumn::make('service_duration'),
            ExportColumn::make('medical_level'),
            ExportColumn::make('cultural_level'),
            ExportColumn::make('qualification'),
            ExportColumn::make('profession_before_recruitment'),
            ExportColumn::make('blood_type'),
            ExportColumn::make('religion'),
            ExportColumn::make('marital_status'),
            ExportColumn::make('date_of_birth'),
            ExportColumn::make('governorate_of_birth'),
            ExportColumn::make('national_number'),
            ExportColumn::make('governorate'),
            ExportColumn::make('job'),
            ExportColumn::make('military_rank'),
            ExportColumn::make('secret_governor'),
            ExportColumn::make('signal_governor'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your soldier export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
