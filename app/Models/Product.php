<?php

namespace App\Models;

use App\Traits\DistinctValueTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory,DistinctValueTrait;

}
