<?php

namespace Tests\Unit;

use App\Models\Offer;
use App\Models\Order;
use App\Services\OrderService;
use Tests\TestCase;
class TgBotTest extends TestCase
{

    /*
     * @test
     */
    public function test_tg_text(): void
    {
        $offer = Offer::factory()->create();
        $service = new OrderService();
        $text = $service->textToBot($offer);
        $this->assertTrue($text!=null);
    }
}
