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
                "Authorization" => "Basic " . base64_encode (config('sms.login').':'.config('sms.passwd')),
                "Content-Type"  => "application/json; charset=utf-8",
            ]
        );
    }
}