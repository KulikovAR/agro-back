<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserLoginHistory extends Model
{
    protected $table = 'user_login_history';

    protected $fillable = [
        'user_id',
        'login_at',
        'login_ip'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
