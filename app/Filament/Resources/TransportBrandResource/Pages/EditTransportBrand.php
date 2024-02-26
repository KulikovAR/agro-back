<?php

namespace App\Filament\Resources\TransportBrandResource\Pages;

use App\Filament\Resources\TransportBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransportBrand extends EditRecord
{
    protected static string $resource = TransportBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
