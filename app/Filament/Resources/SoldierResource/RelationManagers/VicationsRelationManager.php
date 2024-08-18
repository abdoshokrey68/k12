<?php

namespace App\Filament\Resources\SoldierResource\RelationManagers;

use App\Filament\Resources\SoldierResource;
use App\Filament\Resources\VicationsResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class VicationsRelationManager extends RelationManager
{
    protected static ?string $label = "أجازات";
    protected static string $relationship = 'vications';

    public function form(Form $form): Form
    {
        return VicationsResource::form($form);
    }

    public function table(Table $table): Table
    {
        return VicationsResource::table($table);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('site.Vications');
    }
}
