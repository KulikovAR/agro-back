<?php

namespace App\Services\SignMe;

use Illuminate\Support\Facades\Http;

class SignMeClient
{


    public $client;
    public function __construct()
    {
        $this->client = Http::withHeaders(
            [
                "Content-Type"  => "application/json",
                "Accept"        => "application/json",
            ]
        );
    }
}
