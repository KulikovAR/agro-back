<?php

namespace Tests\Feature\ProductParser;

use Tests\TestCase;

class ProductParserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_parser_index(): void
    {
        $response = $this->json('get', route('product-parser.index'));
        // dd($response);
        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'status',
                    'message',
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'class',
                            'attr',
                            'company',
                            'price',
                            'type',
                            'gluten',
                            'idk',
                            'chp',
                            'nature',
                            'humidity',
                            'weed_impurity',
                            'chinch',
                            'exporter',
                            'parser',
                            'created_at',
                            'updated_at',
                            'logs',
                        ],
                    ],
                ]);
    }
}
