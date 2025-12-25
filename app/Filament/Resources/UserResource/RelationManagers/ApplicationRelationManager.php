<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Http\Requests\SignMe\SignMeRequest;
use App\Models\File;
use App\Services\SignMeService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ApplicationRelationManager extends RelationManager
{
    protected static string $relationship = 'files';

    protected static ?string $title = 'Заявки';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function($query){
                return $query->where('type', 'Заявка')->where('is_signed', true);
            })
            ->defaultSort('files.created_at', 'desc')
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('userFile.user.inn')
                    ->label('ИНН')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('userFile.user.short_name')
                    ->label('Организация')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_signed')
                    ->label('Количество подписей')
                    ->state(function ($record) {
                        $countSigned = 0;
                        if($record->is_signed) {
                            $countSigned++;
                        }
                        if($record->is_dual_signed) {
                            $countSigned++;
                        }
                        return $countSigned;
                    })->alignCenter()

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_signed')
                    ->label('Подписан клиентом?')
                    ->options([
                        0 => 'Не подписан',
                        1 => 'Подписан',
                    ]),
                Tables\Filters\SelectFilter::make('is_dual_signed')
                    ->label('Подписан компанией?')
                    ->options([
                        0 => 'Не подписан',
                        1 => 'Подписан',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->label('Скачать')
                    ->url(fn (File $record): ?string => $record->pdf_file ? Storage::url($record->pdf_file) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (File $record): bool => !is_null($record->pdf_file)),
                Tables\Actions\Action::make('mark_signed')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->label('Подписать')
                    ->visible(fn (File $record): bool => $record->is_signed && !$record->is_dual_signed)
                    ->action(function (File $record, Tables\Actions\Action $action) {
                        try {
                            $request = new SignMeRequest(['path' => $record->path]);
                            $answer = app(SignMeService::class)->signature($request);
                            Notification::make()
                                ->success()
                                ->title('Ссылка сформирована')
                                ->actions([
                                    Action::make('open')
                                        ->button()
                                        ->label('Перейти к подписи')
                                        ->url($answer, shouldOpenInNewTab: true)
                                ])
                                ->send();

                        }
                        catch (\Exception $exception) {
                            Notification::make()
                                ->danger()
                                ->title('Ошибка')
                                ->body($exception->getMessage())
                                ->send();
                        }
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
