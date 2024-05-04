<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserHasRolesResource\Pages;
use App\Filament\Resources\UserHasRolesResource\RelationManagers;
use App\Models\Offer;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserHasRolesResource extends Resource
{
    protected static ?string $model = UserHasRoles::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('role_id')
                    ->relationship('role', 'name')
                    ->required(),
                Forms\Components\TextInput::make('model_type')
                    ->required()
                    ->default('App\Models\User')
                    ->hidden()
                    ->maxLength(255),
                Forms\Components\Select::make('model_id')
                    ->relationship('model', 'phone_number')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role.id')
                    ->state(fn (Role $role) => $role->name)
                    ->label('Номер телефона пользователя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model.id')
                    ->state(fn (User $user) => $user->phone_number)
                    ->label('Номер телефона пользователя')
                    ->searchable(),
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
            'index' => Pages\ListUserHasRoles::route('/'),
            'create' => Pages\CreateUserHasRoles::route('/create'),
            'edit' => Pages\EditUserHasRoles::route('/{record}/edit'),
        ];
    }
}
