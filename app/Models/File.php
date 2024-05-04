<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class File extends Model
{
    use HasFactory, HasUuids,FileTrait;

    protected $fillable = [
        'path'
    ];

    public function fileType(): HasOneThrough
    {
        return $this->hasOneThrough(FileType::class, UserFile::class, 'file_id', 'id', 'id', 'file_type_id');
    }

    public function userFiles(): HasMany
    {
        return $this->hasMany(UserFile::class);
    }
}
