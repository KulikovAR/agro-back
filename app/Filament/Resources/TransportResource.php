<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransportResource\Pages;
use App\Filament\Resources\TransportResource\RelationManagers;
use App\Models\Transport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransportResource extends Resource
{
    protected static ?string $model = Transport::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->label('Тип')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('number')
                    ->label('Номер')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->label('Модель')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('free')
                    ->label('Занят/Свободен')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\TextInput::make('volume_cm')
                    ->label('Объём кузова')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('capacity')
                    ->label('Грузоподъёмность')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->label('ID владельца')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Номер')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->label('Модель')
                    ->searchable(),
                Tables\Columns\IconColumn::make('free')
                    ->label('Занят/Свободен')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активирован')
                    ->boolean(),
                Tables\Columns\TextColumn::make('volume_cm')
                    ->label('Объём кузова')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Грузоподъёмность')
                    ->numeric()
                    ->sortable(),
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
            RelationManagers\UserRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransports::route('/'),
            'create' => Pages\CreateTransport::route('/create'),
            'edit' => Pages\EditTransport::route('/{record}/edit'),
        ];
    }
}
