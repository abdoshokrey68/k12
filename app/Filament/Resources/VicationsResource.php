<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VicationsResource\Pages;
use App\Filament\Resources\VicationsResource\RelationManagers;
use App\Models\Vications;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Soldier;

class VicationsResource extends Resource
{
    protected static ?string $label = "أجازات";
    protected static ?string $model = Vications::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('soldier_id')->options(Soldier::pluck('name', 'id')->all())
                    ->label(__('site.name'))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('stay')
                    ->label(__('site.stay')),
                Forms\Components\DatePicker::make('return')
                    ->label(__('site.return')),
                Forms\Components\Select::make('type')
                    ->label(__('site.type'))
                    ->options(['leave' => 'إجازة', 'leave_extension' => "إمتداد أجازة"])
                    ->required(),
                Forms\Components\Toggle::make('emergency')
                    ->label(__('site.emergency'))
                    ->required(),
                Forms\Components\TextInput::make('notes')
                    ->label(__('site.notes'))
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
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stay')
                    ->label(__('site.stay'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return')
                    ->label(__('site.return'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('site.type'))
                    ,
                Tables\Columns\IconColumn::make('emergency')
                    ->label(__('site.emergency'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('notes')
                    ->label(__('site.notes'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVications::route('/'),
        ];
    }
}
