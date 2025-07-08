<?php

namespace Tests\Feature\Transport;

use App\Models\Driver;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransportTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        if (User::count() === 0) {
            User::factory()->create();
        }

        if (Driver::count() === 0) {
            Driver::factory()->create([
                'user_id' => User::first()->id,
                'company_id' => $this->faker->uuid(),
                'is_active' => true,
            ]);
        }

        if (Transport::count() === 0) {
            Transport::factory()->create([
                'driver_id' => Driver::first()->id,
                'type' => 1,
                'number' => 'A123BC',
                'model' => 'Moskvich',
                'description' => 'Test transport',
                'free' => true,
                'is_active' => true,
                'volume_cm' => 1000000,
                'capacity' => 5000,
            ]);
        }
    }

    /**
     * A basic feature test example.
     */
    public function test_index_transport_api()
    {
        $response = $this->json(
            'GET',
            '/api/v1/transport',
            [],
            $this->getHeadersForUser($this->getTestUser())
        );

        $response->assertStatus(200);


        // TODO разобраться с структурой
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    '*' => [
                        'id',
                        'driver' => [
                            'id',
                            'user' => [
                                'id',
                                'phone_number',
                                'email',
                                'moderation_status',
                                'name',
                                'surname',
                                'patronymic',
                                'roles',
                                'files',
                            ],
                            'company_id',
                            'is_active',
                        ],
                        'type',
                        'number',
                        'model',
                        'description',
                        'free',
                        'is_active',
                        'volume_cm',
                        'capacity',
                        'created_at',
                    ],
                ],
            ],
        ]);
    }

    public function test_show_transport_api()
    {
        $transport = Transport::first();

        $response = $this->json(
            'GET',
            route('transport.show', ['id' => $transport->id]),
            [],
            $this->getHeadersForUser($this->getTestUser())
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'driver' => [
                        'id',
                        'user' => [
                            'id',
                            'phone_number',
                            'email',
                            'moderation_status',
                            'name',
                            'surname',
                            'patronymic',
                            'roles',
                            'files',
                        ],
                        'company_id',
                        'is_active',
                    ],
                    'type',
                    'number',
                    'model',
                    'description',
                    'free',
                    'is_active',
                    'volume_cm',
                    'capacity',
                    'created_at',
                ],
            ],
        ]);
    }

    public function test_create_transport_api()
    {
        $driver = Driver::first();
        $number = $this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomNumber() . $this->faker->randomNumber() . $this->faker->randomNumber() . $this->faker->randomLetter();
        $yourData = [
            'driver_id' => $driver->id,
            'is_active' => true,
            'type' => 1,
            'number' => $number,
            'model' => 'Moskvich',
            'description' => 'Deserunt.',
            'free' => true,
            'volume_cm' => '483649993',
            'capacity' => 5145,
        ];

        $response = $this->json(
            'POST',
            '/api/v1/transport/create',
            $yourData,
            $this->getHeadersForUser($this->getTestUser())
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'driver' => [
                        'id',
                        'user' => [
                            'id',
                            'phone_number',
                            'email',
                            'moderation_status',
                            'name',
                            'surname',
                            'patronymic',
                            'roles',
                            'files',
                        ],
                        'company_id',
                        'is_active',
                    ],
                    'type',
                    'number',
                    'model',
                    'description',
                    'free',
                    'is_active',
                    'volume_cm',
                    'capacity',
                    'created_at',
                ],
            ],
        ]);

        $this->assertDatabaseHas('transports', [
            'number' => $number,
        ]);
    }

    public function test_update_transport_api()
    {
        $driver = Driver::first();
        $transport = Transport::first();

        $yourData = [
            'driver_id' => $driver->id,
        ];

        $response = $this->json(
            'PUT',
            route('transport.update', ['transport' => $transport->id]),
            $yourData,
            $this->getHeadersForUser($this->getTestUser())
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'driver' => [
                        'id',
                        'user' => [
                            'id',
                            'phone_number',
                            'email',
                            'moderation_status',
                            'name',
                            'surname',
                            'patronymic',
                            'roles',
                            'files',
                        ],
                        'company_id',
                        'is_active',
                    ],
                    'type',
                    'number',
                    'model',
                    'description',
                    'free',
                    'is_active',
                    'volume_cm',
                    'capacity',
                    'created_at',
                ],
            ],
        ]);
    }

    public function test_delete_transport_api()
    {
        $driver = Driver::first();
        $number = $this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomNumber() . $this->faker->randomNumber() . $this->faker->randomNumber() . $this->faker->randomLetter();
        $model = Transport::create([
            'driver_id' => $driver->id,
            'is_active' => true,
            'type' => 1,
            'number' => $number,
            'model' => 'Moskvich',
            'description' => 'Deserunt.',
            'free' => true,
            'volume_cm' => '483649993',
            'capacity' => 5145,
        ]);

        $response = $this->json(
            'DELETE',
            route('transport.delete', ['transport' => $model->id]),
            [],
            $this->getHeadersForUser($this->getTestUser())
        );

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'OK',
                'message' => 'Транспорт удалён',
                'data' => [],
            ]);

        $this->assertDatabaseMissing('transports', ['id' => $model->id]);
    }
}
