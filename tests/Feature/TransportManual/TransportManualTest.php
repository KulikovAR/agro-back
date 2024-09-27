<?php

namespace Tests\Feature\TransportManual;

use Tests\TestCase;

class TransportManualTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_transport_manual_types_get()
    {
        $response = $this->json('GET', '/api/v1/transport/manual/types');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'type',
                    ],
                ],
            ]);
    }

    public function test_transport_manual_brands_get()
    {
        $response = $this->json('GET', '/api/v1/transport/manual/brands');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'image',
                    ],
                ],
            ]);
    }
}
