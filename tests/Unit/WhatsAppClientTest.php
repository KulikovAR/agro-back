<?php

namespace Tests\Unit;

use App\Services\WhatsApp\WhatsAppClient;
use Tests\TestCase;

class WhatsAppClientTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_send_message(): void
    {
        $client = new WhatsAppClient();

        $client->sendMessage('test', '79202149572');

        $this->assertTrue(true);
    }
}
