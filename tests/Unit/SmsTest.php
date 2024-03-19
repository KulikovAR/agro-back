<?php

namespace Tests\Unit\Sms;

use Tests\TestCase;
use App\Services\Sms\SmsVerification;

class SmsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $cock = new SmsVerification;
        $cock->send('79202149572','Тест');

    }
}
