<?php

namespace App\Models;

use App\Models\Order\ObservedBy;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasUuids, HasFactory;

    public function loadTypes(): BelongsToMany
    {
        return $this->belongsToMany(LoadType::class,'order_load_types','order_id','load_type_id');
    }
}
