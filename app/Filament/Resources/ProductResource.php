<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-m-document-magnifying-glass';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([  
                // TextInput::make('name')
                //     ->required()
                //     ->label('Название культуры'),
                // TextInput::make('class')
                //     ->required()
                //     ->label("Класс крупы")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название культуры'),
                TextColumn::make('class')
                    ->label("Класс крупы"),
                TextColumn::make('attr')
                    ->label("Атрибуты"),
                TextColumn::make('company')
                    ->label("Компания"),
                TextColumn::make('price')
                    ->label("Стоимость"),
                TextColumn::make('idk')
                    ->label("ИДК"),
                TextColumn::make('chp')
                    ->label("ЧП"),
                TextColumn::make('nature')
                    ->label("Натура"),
                TextColumn::make('humidity')
                    ->label("Влажность"),
                TextColumn::make('weed_impurity')
                    ->label("Сорная примесь"),
                TextColumn::make('chinch')
                    ->label("Клоп"),
                TextColumn::make('exporter')
                    ->label("Экспортёр"),

            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([
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
            'index' => Pages\ListProducts::route('/'),
        ];
    }
}
