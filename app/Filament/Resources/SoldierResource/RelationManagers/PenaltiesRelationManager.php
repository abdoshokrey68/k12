<?php

namespace App\Filament\Resources\SoldierResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenaltyResource;
use Illuminate\Database\Eloquent\Model;

class PenaltiesRelationManager extends RelationManager
{
    protected static string $relationship = 'penalties';

    public function form(Form $form): Form
    {
        return PenaltyResource::form($form);
    }

    public function table(Table $table): Table
    {
        return PenaltyResource::table($table);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('site.Penalties');
    }
}
