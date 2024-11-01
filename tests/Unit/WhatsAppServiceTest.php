<?php

namespace Tests\Unit;

use App\Services\WhatsApp\WhatsAppService;
use Tests\TestCase;

class WhatsAppServiceTest extends TestCase
{
    private function testData(): array
    {
        return json_decode('{"messages":[{"wh_type":"incoming_message","profile_id":"971cdfd1-28ef","id":"B3F9C6CF1FB05101444DEE390A357949","body":"\u0411\u043e\u0442","type":"chat","from":"79202149572@c.us","to":"79885355703@c.us","senderName":"\u0420\u0443\u0441\u043b\u0430\u043d","chatId":"79202149572@c.us","timestamp":"2024-05-14T00:02:52+03:00","time":1715634172,"caption":null,"from_where":"phone","contact_name":"\u0420\u0443\u0441\u043b\u0430\u043d","is_forwarded":false,"isReply":false,"is_edited":false,"stanza_id":null,"is_me":false,"chat_type":"dialog","thumbnail":"https:\/\/s3.wappi.pro\/wapi-uploads30\/971cdfd1-28ef\/tumb_79202149572.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=bUoykt3TtXyYMOBeVt26%2F20240513%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240513T201025Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=b5f5f793dce4e7c18f60cc6574666a57f0605cd5151473013cfe6f9ab72b7ede","picture":"https:\/\/s3.wappi.pro\/wapi-uploads30\/971cdfd1-28ef\/pic_79202149572.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=bUoykt3TtXyYMOBeVt26%2F20240513%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240513T201025Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=040063f1a0e9b6121551fbd5975df804e4384059f73d914359b14670e45a2d2d","wappi_bot_id":null}]}', true);
    }

    /**
     * A basic unit test example.
     */
    public function test_handler(): void
    {
        $whatsAppService = new WhatsAppService;

        $whatsAppService->handler($this->testData());

        $this->assertTrue(true);
    }
}
