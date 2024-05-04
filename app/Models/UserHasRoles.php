<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserHasRoles extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'model_has_roles';

    public function model():BelongsTo
    {
        return $this->belongsTo(User::class, 'model_id', 'id');
    }

    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
