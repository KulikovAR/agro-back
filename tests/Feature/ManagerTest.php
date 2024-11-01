<?php

namespace Tests\Feature;

use Tests\TestCase;

class ManagerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->json('get', route('managers.list'), headers: $this->getHeadersForUser());

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                [
                    'id',
                    'name',
                    'phone',
                ],
            ],
        ]);

        $response->assertStatus(200);
    }
}
