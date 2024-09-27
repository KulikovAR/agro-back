<?php

namespace App\Services;

use App\Models\TransportBrand;
use App\Models\TransportType;
use Illuminate\Database\Eloquent\Collection;

class TransportManualService
{
    public function getType(): Collection
    {
        return TransportType::all();
    }

    public function getBrand(): Collection
    {
        return TransportBrand::all();
    }
}
