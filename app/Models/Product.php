<?php

namespace App\Models;

use App\Traits\DistinctValueTrait;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use DistinctValueTrait,Filterable, HasFactory;

    protected $fillable = [
        'name',
        'idk',
        'attr',
        'chp',
        'gluten',
        'class',
        'nature',
        'type',
        'humidity',
        'weed_impurity',
        'company',
        'exporter',
        'price',
        'company',
        'exporter',
        'chinch',
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(ProductLog::class);
    }
}
