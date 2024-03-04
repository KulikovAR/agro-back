<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Counteragent extends Model
{

    use HasFactory, HasUuids;
    protected $table = 'userinfos';
    protected $fillable = [
        'id',
        'inn',
        'type',
        'name',
        'surname',
        'patronymic',
        'kpp',
        'ogrn',
        'user_id',
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


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
