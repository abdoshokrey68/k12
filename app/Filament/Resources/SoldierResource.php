<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoldierResource\Pages;
use App\Filament\Resources\SoldierResource\RelationManagers;
use App\Models\Soldier;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoldierResource extends Resource
{
    protected static ?string $model = Soldier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('rank')->options(['soldiers', 'non_commissioned_officers', 'officers']),
                Forms\Components\TextInput::make('military_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('photo')
                    ->disk('public')
                    ->directory('members'),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('recruitment')->label(__('Recruitment'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('forces')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('three_digit_n_umber')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('join_date'),
                Forms\Components\TextInput::make('weapon')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('trained_duty')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('service_duration')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('medical_level')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('cultural_level')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('qualification')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('profession_before_recruitment')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('blood_type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('religion')
                    ->maxLength(255)
                    ->default(null),
                Select::make('marital_status')->options(['married', 'single', 'divorced']),
                Forms\Components\DatePicker::make('date_of_birth'),
                Forms\Components\TextInput::make('governorate_of_birth')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('national_number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('governorate')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('date_of_end_of_service')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('point_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('job')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('military_rank')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('secret_governor')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('signal_governor')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('recruitment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('forces')
                    ->searchable(),
                Tables\Columns\TextColumn::make('military_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('three_digit_n_umber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('join_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weapon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('trained_duty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_duration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('medical_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cultural_level')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qualification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession_before_recruitment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('blood_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('religion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('governorate_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('governorate')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_end_of_service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('point_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('job')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rank'),
                Tables\Columns\TextColumn::make('military_rank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('secret_governor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('signal_governor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListSoldiers::route('/'),
            'create' => Pages\CreateSoldier::route('/create'),
            'edit' => Pages\EditSoldier::route('/{record}/edit'),
        ];
    }
}
