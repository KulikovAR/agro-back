<?php

namespace App\Filament\Resources;

use App\Enums\ModerationStatusEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $modelLabel = 'Пользователь';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Электронная почта')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Пользователь с таким email уже существует',
                    ]),
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label('Фамилия')
                    ->maxLength(255),
                Forms\Components\TextInput::make('patronymic')
                    ->label('Отчество')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->label('Номер телефона')
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Пароль')
                    ->password()
                    ->revealable(),
                Forms\Components\Select::make('moderation_status')
                    ->label('Статус модерации')
                    ->options(ModerationStatusEnum::getDescriptions())
                    ->required()
                    ->native(false),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Роли'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Электронная почта'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Время подтверждения почты')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_verified_at')
                    ->label('Время подтверждения телефона')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('Номер телефона')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('moderation_status')
                    ->label('Статус модерации')
                    ->getStateUsing(function ($record) {
                        return ModerationStatusEnum::getModerationStatus($record->moderation_status);
                    }),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                // ...
            ])
            ->actions([
                // You may add these actions to your table if you're using a simple
                // resource, or you just want to be able to delete records without
                // leaving the table.
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                // ...
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    // ...
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
