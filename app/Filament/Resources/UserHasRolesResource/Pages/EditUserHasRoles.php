<?php

namespace App\Filament\Resources\UserHasRolesResource\Pages;

use App\Filament\Resources\UserHasRolesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserHasRoles extends EditRecord
{
    protected static string $resource = UserHasRolesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
