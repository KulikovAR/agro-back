<?php

namespace App\Filament\Resources;

use App\Enums\CropOrderEnum;
use App\Enums\LoadMethodEnum;
use App\Enums\OrderClarificationDayEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\OrderTimeslotEnum;
use App\Enums\UnitOfMeasurementForCargoShortrageRateEnum;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\LoadType;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use App\Services\Dadata\Dadata;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;

class OrderResource extends Resource
{
    protected static ?string $pluralModelLabel = 'Заявки';

    protected static ?string $modelLabel = 'Заявка';
    private $dadata;
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function form(Form $form): Form
    {
        $dadata = new Dadata();
        return $form
            ->schema([
                Forms\Components\Select::make('crop')
                    ->label('Культура')
                    ->required()
                    ->options(array_combine(array_values(CropOrderEnum::getCrop()),CropOrderEnum::getCrop())),
                Forms\Components\TextInput::make('volume')
                    ->label('Объем')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('distance')
                    ->label('Расстояние')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tariff')
                    ->label('Тариф')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nds_percent')
                    ->label('НДС %')
                    ->numeric(),
                Forms\Components\Select::make('terminal_name')
                    ->label('Название терминала')
                    ->searchable()
                    ->required()
//                    ->options([]),
                    ->getSearchResultsUsing(fn(string $search): array => $dadata->sendCompanyForFilament($search,'value')),
                Forms\Components\TextInput::make('exporter_name')
                    ->label('Название экспортера')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('scale_length')
                    ->label('Длина весов')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('height_limit')
                    ->label('Лимит высоты')
                    ->required()
                    ->numeric(),
                Forms\Components\Toggle::make('is_overload')
                    ->label('Перегрузка')
                    ->required(),
                Forms\Components\Select::make('timeslot')
                    ->label('Таймслот')
                    ->required()
                    ->options(array_combine(array_values(OrderTimeslotEnum::getTimselot()),OrderTimeslotEnum::getTimselot())),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->required()
                    ->options(array_combine(array_values(OrderStatusEnum::getOrderStatus()),OrderStatusEnum::getOrderStatus())),
                Forms\Components\TextInput::make('outage_begin')
                    ->label('Начало простоя')
                    ->numeric(),
                Forms\Components\TextInput::make('outage_price')
                    ->label('Стоимость простоя')
                    ->numeric(),
                Forms\Components\TextInput::make('daily_load_rate')
                    ->label('Ежедневная загрузка')
                    ->numeric(),
                Forms\Components\TextInput::make('contact_name')
                    ->label('Имя контакта')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_phone')
                    ->label('Телефон контакта')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cargo_shortage_rate')
                    ->label('Ставка недостачи груза')
                    ->numeric(),
                Forms\Components\Select::make('unit_of_measurement_for_cargo_shortage_rate')
                    ->label('Единица измерения ставки недостачи груза')
                    ->options(array_combine(array_values(UnitOfMeasurementForCargoShortrageRateEnum::getValue()),UnitOfMeasurementForCargoShortrageRateEnum::getValue())),
                Forms\Components\TextInput::make('cargo_price')
                    ->label('Стоимость груза')
                    ->numeric(),
                Forms\Components\TextInput::make('load_place')
                    ->label('Место загрузки')
                    ->maxLength(255),
                Forms\Components\TextInput::make('approach')
                    ->label('Подход')
                    ->maxLength(255),
                Forms\Components\Textarea::make('work_time')
                    ->label('Время работы')
                    ->columnSpanFull(),
                Forms\Components\Select::make('clarification_of_the_weekend')
                    ->label('Уточнение выходных')
                    ->options(array_combine(array_values(OrderClarificationDayEnum::getValue()),OrderClarificationDayEnum::getValue())),
                Forms\Components\TextInput::make('loader_power')
                    ->label('Мощность погрузчика')
                    ->numeric(),
                Forms\Components\Select::make('load_method')
                    ->label('Метод загрузки')
                    ->preload()
                    ->required()
                    ->options(array_combine(array_values(LoadMethodEnum::getLoadMethods()),LoadMethodEnum::getLoadMethods())),
                Forms\Components\Select::make('load_type_id')
                    ->relationship(name: 'loadTypes', titleAttribute: 'title')
                    ->label('Способы погрузки')
                    ->searchable(['title'])
                    ->preload()
                    ->multiple(),
                Forms\Components\Select::make('unload_method_id')
                    ->relationship(name: 'unloadMethods', titleAttribute: 'title')
                    ->label('Методы разгрузки')
                    ->searchable(['title'])
                    ->preload()
                    ->multiple(),
                Forms\Components\TextInput::make('unload_type')
                    ->label('Тип выгрузки')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tolerance_to_the_norm')
                    ->label('Допустимая погрешность к норме')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('start_order_at')
                    ->label('Дата начала заявки')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_order_at')
                    ->label('дата окончания заявки')
                    ->required(),
                Forms\Components\TextInput::make('load_place_name')
                    ->label('Адрес места загрузки')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unload_place_name')
                    ->label('Адрес места выгрузки')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_full_charter')
                    ->label('Полная хартия'),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_moderated')
                    ->label('Модерация')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('id')
//                    ->label('ID')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('crop')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('volume')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('distance')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('tariff')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('nds_percent')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('terminal_name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('terminal_address')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('terminal_inn')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('exporter_name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('exporter_inn')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('scale_length')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('height_limit')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\IconColumn::make('is_overload')
//                    ->boolean(),
//                Tables\Columns\TextColumn::make('timeslot')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label('Статус'),
//                Tables\Columns\TextColumn::make('outage_begin')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('outage_price')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('daily_load_rate')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('contact_name')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('contact_phone')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('cargo_shortage_rate')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('unit_of_measurement_for_cargo_shortage_rate')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('cargo_price')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('load_place')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('approach')
//                    ->searchable(),
//                Tables\Columns\IconColumn::make('is_load_in_weekend')
//                    ->boolean(),
//                Tables\Columns\TextColumn::make('clarification_of_the_weekend')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('loader_power')
//                    ->numeric()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number')
                    ->numeric()
                    ->label('Номер заявки')
                    ->sortable(),
//                Tables\Columns\TextColumn::make('unload_method')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('load_method')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('unload_type')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('tolerance_to_the_norm')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('start_order_at')
//                    ->dateTime()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('end_order_at')
//                    ->dateTime()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('load_latitude')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('load_longitude')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('unload_latitude')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('unload_longitude')
//                    ->searchable(),
                Tables\Columns\TextColumn::make('load_place_name')
                    ->searchable()
                    ->label('Адрес начала поездки'),
                Tables\Columns\TextColumn::make('unload_place_name')
                    ->searchable()
                    ->label('Адрес пункта назначения'),
//                Tables\Columns\TextColumn::make('cargo_weight')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\IconColumn::make('is_full_charter')
//                    ->boolean(),
                Tables\Columns\IconColumn::make('is_moderated')
                    ->boolean()
                    ->label('Статус модерации')
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'info',
                        '1' => 'success',
                        '0' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Дата и время создания заявки')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата и время обновления заявки')
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
            'index'  => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit'   => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
