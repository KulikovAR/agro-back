<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    protected function getFormSchema(): array
    {
        $dadata = new \App\Services\Dadata\Dadata;

        return [
            \Filament\Forms\Components\Select::make('crop')
                ->label('Культура')
                ->options(array_combine(array_values(\App\Enums\CropOrderEnum::getCrop()), \App\Enums\CropOrderEnum::getCrop())),
            \Filament\Forms\Components\TextInput::make('volume')
                ->label('Объем')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('distance')
                ->label('Расстояние')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('tariff')
                ->label('Тариф')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('nds_percent')
                ->label('НДС %')
                ->numeric(),
            \Filament\Forms\Components\Select::make('terminal_name')
                ->label('Название терминала')
                ->searchable()
                ->getSearchResultsUsing(fn (string $search): array => $dadata->sendCompanyForFilament($search, 'value')),
            \Filament\Forms\Components\TextInput::make('exporter_name')
                ->label('Название экспортера')
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('scale_length')
                ->label('Длина весов')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('height_limit')
                ->label('Лимит высоты')
                ->numeric(),
            \Filament\Forms\Components\Select::make('timeslot')
                ->label('Таймслот')
                ->options(array_combine(array_values(\App\Enums\OrderTimeslotEnum::getTimselot()), \App\Enums\OrderTimeslotEnum::getTimselot())),
            \Filament\Forms\Components\Select::make('status')
                ->label('Статус')
                ->options(array_combine(array_values(\App\Enums\OrderStatusEnum::getOrderStatus()), \App\Enums\OrderStatusEnum::getOrderStatus())),
            \Filament\Forms\Components\TextInput::make('outage_begin')
                ->label('Начало простоя')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('outage_price')
                ->label('Стоимость простоя')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('daily_load_rate')
                ->label('Ежедневная загрузка')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('contact_name')
                ->label('Имя контакта')
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('contact_phone')
                ->label('Телефон контакта')
                ->tel()
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('cargo_shortage_rate')
                ->label('Ставка недостачи груза')
                ->numeric(),
            \Filament\Forms\Components\Select::make('unit_of_measurement_for_cargo_shortrage_rate')
                ->label('Единица измерения ставки недостачи груза')
                ->options(array_combine(array_values(\App\Enums\UnitOfMeasurementForCargoShortrageRateEnum::getValue()), \App\Enums\UnitOfMeasurementForCargoShortrageRateEnum::getValue())),
            \Filament\Forms\Components\TextInput::make('cargo_price')
                ->label('Стоимость груза')
                ->numeric(),
            \Filament\Forms\Components\TextInput::make('load_place')
                ->label('Место загрузки')
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('approach')
                ->label('Подход')
                ->maxLength(255),
            \Filament\Forms\Components\Textarea::make('work_time')
                ->label('Время работы')
                ->columnSpanFull(),
            \Filament\Forms\Components\Select::make('clarification_of_the_weekend')
                ->label('Уточнение выходных')
                ->options(array_combine(array_values(\App\Enums\OrderClarificationDayEnum::getValue()), \App\Enums\OrderClarificationDayEnum::getValue())),
            \Filament\Forms\Components\TextInput::make('loader_power')
                ->label('Мощность погрузчика')
                ->numeric(),
            \Filament\Forms\Components\Select::make('load_method')
                ->label('Метод загрузки')
                ->preload()
                ->options(array_combine(array_values(\App\Enums\LoadMethodEnum::getLoadMethods()), \App\Enums\LoadMethodEnum::getLoadMethods())),
            \Filament\Forms\Components\Select::make('load_types')
                ->relationship(name: 'loadTypes', titleAttribute: 'title')
                ->label('Способы погрузки')
                ->searchable(['title'])
                ->preload()
                ->multiple(),
            \Filament\Forms\Components\Select::make('unload_method_id')
                ->relationship(name: 'unloadMethods', titleAttribute: 'title')
                ->label('Методы разгрузки')
                ->searchable(['title'])
                ->preload()
                ->multiple(),
            \Filament\Forms\Components\TextInput::make('unload_type')
                ->label('Тип выгрузки')
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('tolerance_to_the_norm')
                ->label('Допустимая погрешность к норме')
                ->numeric(),
            \Filament\Forms\Components\DateTimePicker::make('start_order_at')
                ->label('Дата начала заявки'),
            \Filament\Forms\Components\DateTimePicker::make('end_order_at')
                ->label('дата окончания заявки'),
            \Filament\Forms\Components\TextInput::make('load_place_name')
                ->label('Адрес места загрузки')
                ->maxLength(255),
            \Filament\Forms\Components\TextInput::make('unload_place_name')
                ->label('Адрес места выгрузки')
                ->maxLength(255),
            \Filament\Forms\Components\Toggle::make('is_full_charter')
                ->label('Полная хартия'),
            \Filament\Forms\Components\Textarea::make('description')
                ->label('Описание')
                ->columnSpanFull(),
            \Filament\Forms\Components\Toggle::make('is_moderated')
                ->label('Модерация'),
        ];
    }
}
