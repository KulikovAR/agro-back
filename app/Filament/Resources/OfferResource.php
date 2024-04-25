<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;
    protected static ?string $pluralModelLabel = 'Отклики';
    protected static ?string $modelLabel = 'Отклик';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'id')
                    ->required(),
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('offer_number')
                    ->label('Номер отклика')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->state(fn (Offer $offer) => $offer->user->phone_number)
                    ->label('Номер телефона пользователя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order.id')
                    ->state(fn (Offer $offer) => $offer->order->order_number)
                    ->label('Номер заявки')
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
