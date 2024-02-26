<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Counteragent extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'id',
        'inn',
        'type',
        'name',
        'surname',
        'patronymic',
        'kpp',
        'ogrn',
        'phone_number',
        'short_name',
        'full_name',
        'juridicatl_address',
        'office_address',
        'tax_system',
        'okved',
        'updated_at',
        'created_at',
        'password',
    ];
}
