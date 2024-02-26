<?php

namespace App\Filament\Resources\TransportBrandResource\Pages;

use App\Filament\Resources\TransportBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransportBrands extends ListRecords
{
    protected static string $resource = TransportBrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
