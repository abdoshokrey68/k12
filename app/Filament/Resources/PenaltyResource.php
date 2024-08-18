<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenaltyResource\Pages;
use App\Filament\Resources\PenaltyResource\RelationManagers;
use App\Models\Penalty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Soldier;

class PenaltyResource extends Resource
{
    protected static ?string $label = "العقوبات";

    protected static ?string $model = Penalty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('soldier_id')
                    ->label(__('site.name'))
                    ->options(Soldier::pluck('name', 'id')->all())
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('date_of_the_crime')
                    ->label(__('site.date_of_the_crime')),
                Forms\Components\TextInput::make('text_of_the_crime')
                    ->label(__('site.text_of_the_crime'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('penalty_imposed')
                    ->label(__('site.penalty_imposed'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('penalty_order')
                    ->label(__('site.penalty_order'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('started_from')
                    ->label(__('site.started_from')),
                Forms\Components\DatePicker::make('ends_in')
                    ->label(__('site.ends_in')),
                Forms\Components\TextInput::make('statement')
                    ->label(__('site.statement'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('orders_item_number')
                    ->label(__('site.orders_item_number'))
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('soldier.name')
                    ->label(__('site.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_of_the_crime')
                    ->label(__('site.date_of_the_crime'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('text_of_the_crime')
                    ->label(__('site.text_of_the_crime'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('penalty_imposed')
                    ->label(__('site.penalty_imposed'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('penalty_order')
                    ->label(__('site.penalty_order'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('started_from')
                    ->label(__('site.started_from'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_in')
                    ->label(__('site.ends_in'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statement')
                    ->label(__('site.statement'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('orders_item_number')
                    ->label(__('site.orders_item_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('site.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('site.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenalties::route('/'),
            'create' => Pages\CreatePenalty::route('/create'),
            'edit' => Pages\EditPenalty::route('/{record}/edit'),
        ];
    }
}
