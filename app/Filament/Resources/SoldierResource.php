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
use App\Models\Recruitment;
use App\Models\Point;
use App\Filament\Resources\SoldierResource\RelationManagers\VicationsRelationManager;
use App\Filament\Resources\SoldierResource\RelationManagers\PenaltiesRelationManager;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Widgets\SoldiersWidget;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\VerticalAlignment;
use App\Filament\Exports\ProductExporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Exports\SoldierExporter;
use Filament\Tables\Actions\BulkAction;


class SoldierResource extends Resource
{
    protected static ?string $model = Soldier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make(__('site.Individual data'))->schema([
                        Select::make('rank')->label(__('site.rank'))
                            ->options([
                                        'soldiers' => __('site.soldiers'),
                                        'non_commissioned_officers' => __('site.non_commissioned_officers'),
                                        'officers' => __('site.officers')
                                    ])
                            ->required()->default('soldiers'),
                        Forms\Components\TextInput::make('military_rank')->label(__('site.military_rank'))
                            ->maxLength(255)
                            ->default('مجند'),
                        Forms\Components\TextInput::make('name')
                            ->label(__("site.name"))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('military_number')->label(__('site.military_number'))
                            ->maxLength(255)
                            ->required()
                            ->default(null),
                        Forms\Components\TextInput::make('recruitment_area')->label(__('site.recruitment_area')),
                        Forms\Components\TextInput::make('phone')->label(__('site.phone'))
                            ->tel()
                            ->maxLength(255)
                            ->default(null),
                        Select::make('recruitment_id')->label(__('site.recruitment'))
                            ->options(Recruitment::pluck('name','id')->all())->required(),
                        Forms\Components\TextInput::make('forces')->label(__('site.forces'))
                            ->maxLength(255)
                            ->default('دفاع جوي'),
                        Forms\Components\TextInput::make('three_digit_n_umber')->label(__('site.three_digit_n_umber'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\DatePicker::make('join_date')->label(__('site.join_date')),
                        Forms\Components\DatePicker::make('date_of_end_of_service')->label(__('site.date_of_end_of_service'))
                            ->displayFormat('d/m/y'),
                        Forms\Components\TextInput::make('weapon')->label(__('site.weapon'))
                            ->maxLength(255)
                            ->default('الدفاع الجوي'),
                        Forms\Components\TextInput::make('trained_duty')->label(__('site.trained_duty'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\Toggle::make('with_in_power')->label(__("site.with_in_power"))->default(true),
                        Forms\Components\TextInput::make('original_power')->label(__('site.original_power'))
                            ->maxLength(255),
                        // Forms\Components\Toggle::make('end_of_service')->label(function (): ?string {
                        //     return __('site.end_of_service');
                        // }),
                    ])->columns(2),
                    Section::make(__('site.More Informaiton'))->schema([
                        Forms\Components\TextInput::make('service_duration')->label(__('site.service_duration'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('medical_level')->label(__('site.medical_level'))
                            ->maxLength(255)
                            ->default('لائق ا2'),
                        Select::make('marital_status')->label(__('site.marital_status'))->required()->default('single')
                            ->options(['married' => __('site.married'), 'single' => __('site.single')])
                            ->native(true),
                        Forms\Components\DatePicker::make('date_of_birth')->label(__('site.date_of_birth')),
                        Forms\Components\TextInput::make('governorate_of_birth')->label(__('site.governorate_of_birth'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('birth_center')->label(__('site.birth_center'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('job')->label(__('site.job'))
                            ->maxLength(255)
                            ->default(null),
                    ])->columns(2)
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make(__('site.Main Photo'))->schema([
                        Forms\Components\FileUpload::make('photo')->label(__('site.photo'))
                            ->enableDownload()
                            ->enableOpen()
                            ->directory('members'),
                    ]),
                    Section::make(__('site.Power Information'))->schema([
                        Select::make('point_id')->label(__('site.point_id'))
                            ->options([0 => __('site.Unit Power') , ...Point::pluck('name', 'id')->all()])->required(),
                        Forms\Components\Toggle::make('secret_governor')->label(__('site.secret_governor')),
                        Forms\Components\Toggle::make('signal_governor')->label(__('site.signal_governor')),
                    ]),
                    Section::make(__('site.Civil information'))->schema([
                        Forms\Components\TextInput::make('cultural_level')->label(__('site.cultural_level'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('qualification')->label(__('site.qualification'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('profession_before_recruitment')->label(__('site.profession_before_recruitment'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('blood_type')->label(__('site.blood_type'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('religion')->label(__('site.religion'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('national_number')->label(__('site.national_number'))
                            ->maxLength(14)
                            ->minLength(14)
                            ->default(null),
                        Forms\Components\TextInput::make('governorate')->label(__('site.governorate'))
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('card_center')->label(__('site.card_center'))
                            ->maxLength(255)
                            ->default(null),
                    ]),
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rank')->label(__('site.rank',))
                        ->state(function (Soldier $record): ?string {
                            return __("site.$record->rank");
                        })
                        ->color(function (Soldier $record): ?string {
                            if ($record->rank === 'soldiers')
                                return 'success';
                            if ($record->rank === 'non_commissioned_officers')
                                return 'warning';
                            if ($record->rank === 'officers')
                                return 'danger';
                            // return $record->rank ? ;
                        }),
                Tables\Columns\ImageColumn::make('photo')
                    ->circular()
                    ->verticalAlignment(VerticalAlignment::Center)
                    ->label(__("site.Avatar"))
                    ->defaultImageUrl(asset("storage/members/default-soldier-avatar.png")),
                Tables\Columns\TextColumn::make('name')
                    ->label(__("site.name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label(__("site.phone"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('recruitment.name')->label(__("site.recruitment"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('forces')->label(__("site.forces"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('military_number')->label(__("site.military_number"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('three_digit_n_umber')->label(__("site.three_digit_n_umber"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_end_of_service')->label(__("site.date_of_end_of_service"))
                    ->date()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('join_date')->label(__("site.join_date"))
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weapon')->label(__("site.weapon"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('trained_duty')->label(__("site.trained_duty"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_duration')->label(__("site.service_duration"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('medical_level')->label(__("site.medical_level"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('cultural_level')->label(__("site.cultural_level"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('qualification')->label(__("site.qualification"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession_before_recruitment')->label(__("site.profession_before_recruitment"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('blood_type')->label(__("site.blood_type"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('religion')->label(__("site.religion"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status')->label(__("site.marital_status"))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->state(function (Soldier $record): ?string {
                        return __("site.$record->marital_status");
                    }),
                Tables\Columns\TextColumn::make('date_of_birth')->label(__("site.date_of_birth"))
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('governorate_of_birth')->label(__("site.governorate_of_birth"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('birth_center')->label(__("site.birth_center"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('national_number')->label(__("site.national_number"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('governorate')->label(__("site.governorate"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('card_center')->label(__("site.card_center"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('point.name')->label(__('site.point'))
                    ->state(function (Soldier $record): ?string {
                        return __("site.$record->rank");
                    })
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('job')->label(__('site.job'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('military_rank')->label(__('site.military_rank'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('secret_governor')->label(__('site.secret_governor'))
                    ->searchable()
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('signal_governor')->label(__('site.signal_governor'))
                    ->searchable()
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->label(__('site.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label(__('site.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make(__('site.rank'))
                        ->options([
                            'soldiers' => __('site.soldiers'),
                            'non_commissioned_officers' => __('site.non_commissioned_officers'),
                            'officers' => __('site.officers')
                        ])->multiple()
                        ->attribute('rank'),
                SelectFilter::make(__('site.recruitment'))->label(__('site.recruitment'))
                        ->options(Recruitment::pluck('name', 'id')->all())
                        ->attribute('recruitment_id')
                        ->multiple(),
                SelectFilter::make(__('site.Synonym'))
                    ->multiple()
                    ->options(function () : array {
                            $soldier = Soldier::pluck('date_of_end_of_service')->unique()->all();
                            $associativeArray = array_combine($soldier, $soldier);
                            return $associativeArray;
                    })->attribute('date_of_end_of_service'),
                // SelectFilter::make(__('site.Synonym'))
                //     ->multiple()
                //     ->options(function () : array {
                //         return $soldier = Soldier::pluck('date_of_end_of_service')->unique()->all();
                //     })->attribute('date_of_end_of_service'),
                SelectFilter::make(__('site.power'))
                    ->options([0 => __('site.Unit Power') , ...Point::pluck('name', 'id')->all()])
                    ->attribute('point_id')->multiple(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportAction::make()->exporter(SoldierExporter::class),
                ]),
                // BulkAction::make('export')->button()->action('true'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            VicationsRelationManager::class,
            PenaltiesRelationManager::class,
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

    public static function getWidgets(): array
    {
        return [
            // SoldiersCounts::class,
        ];
    }

    public static function getLabel(): ?string
    {
        return __('site.Unit Power');
    }
}
