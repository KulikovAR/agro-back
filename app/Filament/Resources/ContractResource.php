<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages\ListContracts;
use App\Filament\Resources\ContractResource\Pages;
use App\Http\Requests\SignMe\SignMeRequest;
use App\Models\File;
use App\Services\SignMeService;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ContractResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'Договоры';
    protected static ?string $navigationGroup = 'Документы';

    protected static ?string $pluralModelLabel = 'Договоры';

    protected static ?string $modelLabel = 'Договор';
    protected static ?int $navigationSort = 1;




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(function($query){
            return $query->where('is_signed', true);
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('type', 'Договор');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContracts::route('/'),
        ];
    }

}
