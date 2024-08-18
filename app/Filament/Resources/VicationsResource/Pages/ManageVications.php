<?php

namespace App\Filament\Resources\VicationsResource\Pages;

use App\Filament\Resources\VicationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVications extends ManageRecords
{
    protected static string $resource = VicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
