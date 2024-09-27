<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Transport extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'driver_id',
        'is_active',
        'type',
        'number',
        'model',
        'description',
        'free',
        'volume_cm',
        'capacity',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Driver::class, 'id', 'id', 'driver_id', 'user_id');
    }
}
