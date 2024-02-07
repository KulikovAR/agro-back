<?php

namespace App\Services\Dadata;

use Illuminate\Support\Facades\Http;

class DadataTokenResetClient
{
    public $client;
    public function __construct()
    {   
        $this->client = Http::withHeaders(
            [
                "Authorization" => "Token " . config('dadata.token'),
                "Content-Type"  => "application/json",
                "X-Secret"  => config('dadata.secret'),
            ]
        );
    }

}
