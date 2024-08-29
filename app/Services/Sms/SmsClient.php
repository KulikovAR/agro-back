<?php
namespace App\Services\Sms;
use Illuminate\Support\Facades\Http;

class SmsClient
{

    public $client;
    public function __construct()
    {
        $this->client = Http::withHeaders(
            [
                "Authorization" => "Basic " . base64_encode (config('1c.login').':'.config('1c.password')),
            ]
        );
    }
}
