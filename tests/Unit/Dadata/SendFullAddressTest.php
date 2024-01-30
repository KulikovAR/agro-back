<?php

namespace Tests\Unit\Dadata;

use App\Services\Dadata\Dadata;
use Tests\TestCase;

class SendFullAddressTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        // $dadata = new Dadata;
        // $dadata->sendFullAddress('105568');
        // $this->assertTrue(true);
        // $this->assertSame();
        $dadata = new Dadata;
        $dadata->sendCoords(55.878,37.653 );
    }
}
