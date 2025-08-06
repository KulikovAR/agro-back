<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Traits\SendsOrderNotifications;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    use SendsOrderNotifications;

    protected static string $resource = OrderResource::class;

    protected function afterCreate(): void
    {
        $this->sendOrderNotification($this->record, 'created');
    }
}
