<?php

namespace Tests\Unit;

use App\Services\Dadata\Dadata;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_example(): void
    {
        $dadata = new Dadata;
        $dadata->sendAddress(['Москва хабар']);
        $this->assertTrue(true);
    }
}
