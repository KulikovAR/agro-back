<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;

class IcClient
{
    public $worker;
    public function __construct()
    {
        $this->worker = Http::withHeaders(
            [
                "Authorization" => "Basic " . base64_encode (config('sms.login').':'.config('sms.passwd')),
            ]
        );
    }
}
