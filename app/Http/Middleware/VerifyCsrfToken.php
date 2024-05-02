<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/6463765571:AAFmZ_Ty-3r7Vq7HTIFYCnkjt_-Qqmtw2GY/https://agro-back.pisateli-studio.ru/api/v1/bot/send-message'
    ];
}
