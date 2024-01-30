<?php

namespace Tests\Unit\Dadata;

use App\Services\Dadata\Dadata;
use PHPUnit\Framework\TestCase;

class SendCoords extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $dadata = new Dadata;
        $dadata->sendCoords(90,90);

    }
}
