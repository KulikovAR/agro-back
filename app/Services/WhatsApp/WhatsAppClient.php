<?php

namespace App\Services\WhatsApp;

use Illuminate\Support\Facades\Http;

class WhatsAppClient
{
    const SEND_MESSAGE = '/api/sync/message/send';

    protected $token;
    protected $profile_id;

    public function __construct(string $token, string $profile_id)
    {
        $this->token      = $token;
        $this->profile_id = $profile_id;
    }

    protected function makeRequest(array $requestData, string $url): array
    {
        $response = Http::withOptions(['verify' => false, 'allow_redirects' => true])
            ->withHeaders([
                'Authorization' => $this->token,
            ])
            ->withQueryParameters(['profile_id' => $this->profile_id])
            ->withBody(json_encode($requestData), 'application/json')
            ->post(config('whatsapp.host') . $url);

        $responseJson = $response->json();

        return $responseJson;
    }

    public function sendMessage(string $body, string $phoneNumber): array
    {
        return $this->makeRequest([
            'body'      => $body,
            'recipient' => $phoneNumber,
        ], self::SEND_MESSAGE);
    }
}
