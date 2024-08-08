<?php

namespace App\Models;

use App\Traits\FileTrait;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class File extends Model
{
    use HasFactory,FileTrait,HasUuids,Filterable;

    protected $fillable = [
        'path',
        'id_1c',
        'is_signed',
        'type',
        'md5_hash',
        'name',
    ];


    const SORT = [
        'created_at',
        'is_signed',
    ];
    public function fileType(): HasOneThrough
    {
        return $this->hasOneThrough(FileType::class, UserFile::class, 'file_id', 'id', 'id', 'file_type_id');
    }

    public function userFiles(): HasMany
    {
        return $this->hasMany(UserFile::class);
    }

    public function userFile(): HasOne
    {
        return $this->hasOne(UserFile::class);
    }
}
