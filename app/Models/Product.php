<?php

namespace App\Models;

use App\Traits\DistinctValueTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory,DistinctValueTrait;

    public function logs():HasMany
    {
        return $this->hasMany(ProductLog::class);
    }   
}
