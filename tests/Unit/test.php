<?php

namespace Tests\Unit;

use App\Services\Dadata\Dadata;
use Tests\TestCase;

class test extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $dadata = new Dadata;
        $dadata->sendAddress(['Москва хабар']);
        $this->assertTrue(true);
    }
}
