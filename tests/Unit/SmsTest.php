<?php

namespace Tests\Unit\Sms;

use App\Services\Sms\SmsVerification;
use Tests\TestCase;

class SmsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $cock = new SmsVerification;
        $cock->send('79202149572', 'Тест');

    }
}
