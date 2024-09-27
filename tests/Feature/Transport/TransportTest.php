<?php

namespace Tests\Feature\Transport;

use App\Models\Driver;
use App\Models\Transport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransportTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_index_transport_api()
    {
        // Отправляем GET-запрос на /api/v1/transport
        $response = $this->json('GET', '/api/v1/transport');

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем структуру JSON-ответа
        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                '*' => [
                    [
                        'id',
                        'driver' => [
                            'id',
                            'user' => [
                                'id',
                                'phone_number',
                                'code',
                                'code_hash',
                                'phone_verified_at',
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
        // Отправляем GET-запрос на /api/v1/transport
        $response = $this->json('GET', route('transport.show', ['id' => Transport::first()->id]));

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем структуру JSON-ответа
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
                            'code',
                            'code_hash',
                            'phone_verified_at',
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
        // Создаем тестовые данные (замените на ваш способ создания данных)
        $driver = Driver::inRandomOrder('id')->first();
        $number = $this->faker->randomLetter().$this->faker->randomLetter().$this->faker->randomNumber().$this->faker->randomNumber().$this->faker->randomNumber().$this->faker->randomLetter();
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

        // Отправляем POST-запрос на создание экземпляра модели
        $response = $this->json('POST', '/api/v1/transport/create', $yourData);

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем структуру JSON-ответа
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
                            'code',
                            'code_hash',
                            'phone_verified_at',
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

        // Проверяем, что модель была успешно создана в базе данных
        $this->assertDatabaseHas('transports', [
            'number' => '23s723c',
        ]);
    }

    public function test_update_transport_api()
    {
        // Создаем тестовые данные (замените на ваш способ создания данных)
        $driver = Driver::inRandomOrder('id')->first();
        $yourData = [
            'driver_id' => $driver->id,
        ];

        // Отправляем POST-запрос на создание экземпляра модели
        $response = $this->json('PUT', route('transport.update', ['transport' => Transport::first()->id]), $yourData);

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем структуру JSON-ответа
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
                            'code',
                            'code_hash',
                            'phone_verified_at',
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
        // Создаем тестовую запись в базе данных
        $driver = Driver::inRandomOrder('id')->first();
        $number = $this->faker->randomLetter().$this->faker->randomLetter().$this->faker->randomNumber().$this->faker->randomNumber().$this->faker->randomNumber().$this->faker->randomLetter();
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

        // Отправляем DELETE-запрос на endpoint, который обрабатывает удаление ресурса
        $response = $this->delete(route('transport.delete', ['transport' => $model->id])); // Замените на ваш реальный маршрут

        // Проверяем, что удаление прошло успешно
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'OK',
                'message' => 'Транспорт удалён',
                'data' => [],
            ]);

        // Проверяем, что запись действительно удалена из базы данных
        $this->assertDatabaseMissing('transports', ['id' => $model->id]); // Замените на вашу таблицу
    }
}
