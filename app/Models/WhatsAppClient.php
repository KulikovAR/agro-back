<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'chat_id',
        'phone',
        'type',
        'account'
    ];
}
