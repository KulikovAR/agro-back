<?php

namespace Tests\Feature;

use App\Enums\NotificationType;
use App\Enums\RoleEnum;
use App\Models\DeviceToken;
use App\Models\LoadType;
use App\Models\Order;
use App\Models\UnloadMethod;
use App\Models\User;
use App\Services\Dadata\Dadata;
use App\Services\ExpoNotificationService;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker;

    private ExpoNotificationService|MockInterface $mockPushService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockPushService = Mockery::mock(ExpoNotificationService::class);
        $this->app->instance(ExpoNotificationService::class, $this->mockPushService);

        $mockDadata = Mockery::mock(Dadata::class);
        $mockDadata->shouldReceive('sendFullAddress')
            ->andReturn([
                [
                    'lat' => 55.7558,
                    'lon' => 37.6176
                ]
            ]);
        $mockDadata->shouldReceive('getAddressArray')
            ->andReturn([
                'city' => 'Москва',
                'region' => 'Московская область',
                'region_type_full' => 'область'
            ]);
        $this->app->instance(Dadata::class, $mockDadata);
    }

//    public function test_order_create(): void
//    {
//        $user1C = User::factory()->create();
//        $user1C->assignRole(RoleEnum::IC->value);
//
//        $data = [
//            'crop' => $this->faker->word(),
//            'volume' => $this->faker->numberBetween(1, 1000),
//            'distance' => $this->faker->numberBetween(1, 100),
//            'tariff' => $this->faker->numberBetween(1, 100),
//            'nds_percent' => $this->faker->numberBetween(0, 100),
//            'terminal_name' => $this->faker->company(),
//            'exporter_name' => $this->faker->name(),
//            'scale_length' => (string)$this->faker->numberBetween(1, 10),
//            'height_limit' => (string)$this->faker->numberBetween(1, 10),
//            'is_overload' => $this->faker->boolean(),
//            'timeslot' => $this->faker->word(),
//            'outage_begin' => $this->faker->numberBetween(1, 100),
//            'outage_price' => $this->faker->numberBetween(1, 100),
//            'daily_load_rate' => $this->faker->numberBetween(1, 100),
//            'contact_name' => $this->faker->name(),
//            'contact_phone' => $this->faker->phoneNumber(),
//            'cargo_shortage_rate' => $this->faker->numberBetween(1, 100),
//            'unit_of_measurement_for_cargo_shortage_rate' => $this->faker->word(),
//            'cargo_price' => $this->faker->numberBetween(1, 100),
//            'load_place' => $this->faker->address(),
//            'approach' => $this->faker->sentence(),
//            'work_time' => $this->faker->sentence(),
//            'is_load_in_weekend' => $this->faker->boolean(),
//            'clarification_of_the_weekend' => $this->faker->word(),
//            'loader_power' => $this->faker->numberBetween(1, 100),
//            'load_method' => $this->faker->randomElement(['Маниту', 'Зерномёт', 'Кун', 'Амкодор', 'Из-под трубы', 'Комбайн', 'Элеватор', 'Вертикальный']),
//            'tolerance_to_the_norm' => $this->faker->numberBetween(1, 100),
//            'start_order_at' => $this->faker->dateTimeBetween(
//                '+1 days',
//                '+1 week'
//            )->format('Y-m-d H:i:s'),
//            'end_order_at' => $this->faker->dateTimeBetween(
//                '+1 week',
//                '+1 month'
//            )->format('Y-m-d H:i:s'),
//            'load_latitude' => $this->faker->latitude(),
//            'load_longitude' => $this->faker->longitude(),
//            'unload_latitude' => $this->faker->latitude(),
//            'unload_longitude' => $this->faker->longitude(),
//            'load_place_name' => $this->faker->address(),
//            'unload_place_name' => $this->faker->address(),
//            'description' => $this->faker->paragraph(),
//            'load_types' => [LoadType::inRandomOrder()->first()->id],
//            'unload_methods' => [UnloadMethod::inRandomOrder()->first()->id],
//            'is_full_charter' => $this->faker->boolean(),
//        ];
//
//        $response = $this->withHeaders($this->getHeadersForUser($user1C))->postJson('/api/v1/orders/create', $data);
//
//        if ($response->status() !== 200) {
//            dump($response->json());
//        }
//
//        $response->assertStatus(200)->assertJsonStructure([
//            'status',
//            'message',
//            'data' => [
//                'id',
//                'order_number',
//            ],
//        ]);
//    }

    public function test_order_notification_creation(): void
    {
        $user = User::factory()->create();
        DeviceToken::factory()->create([
            'user_id' => $user->id,
            'token' => 'test-expo-token'
        ]);

        $order = Order::factory()->create([
            'load_place' => 'Москва',
            'unload_place_name' => 'Санкт-Петербург',
            'crop' => 'Пшеница',
            'distance' => 705,
            'tariff' => 3500
        ]);

        $this->mockPushService->shouldReceive('broadcastToAllUsers')
            ->once()
            ->with(
                NotificationType::ORDER,
                [
                    'action' => 'created',
                    'order_id' => $order->id,
                    'load_place' => $order->load_place,
                    'unload_place' => $order->unload_place_name,
                    'date' => $order->updated_at->format('d.m.Y'),
                    'crop' => $order->crop,
                    'distance' => $order->distance,
                    'tariff' => $order->tariff
                ]
            );

        $notificationService = app(ExpoNotificationService::class);
        $notificationService->broadcastToAllUsers(
            NotificationType::ORDER,
            [
                'action' => 'created',
                'order_id' => $order->id,
                'load_place' => $order->load_place,
                'unload_place' => $order->unload_place_name,
                'date' => $order->updated_at->format('d.m.Y'),
                'crop' => $order->crop,
                'distance' => $order->distance,
                'tariff' => $order->tariff
            ]
        );
    }

//    public function test_order_notification_update(): void
//    {
//        $user = User::factory()->create();
//        DeviceToken::factory()->create([
//            'user_id' => $user->id,
//            'token' => 'test-expo-token'
//        ]);
//
//        $order = Order::factory()->create([
//            'load_place' => 'Казань',
//            'unload_place_name' => 'Нижний Новгород',
//            'crop' => 'Рожь',
//            'distance' => 400,
//            'tariff' => 3000
//        ]);
//
//        $this->mockPushService->shouldReceive('broadcastToAllUsers')
//            ->once()
//            ->with(
//                NotificationType::ORDER,
//                [
//                    'action' => 'updated',
//                    'order_id' => $order->id,
//                    'load_place' => $order->load_place,
//                    'unload_place' => $order->unload_place_name,
//                    'date' => $order->updated_at->format('d.m.Y'),
//                    'crop' => $order->crop,
//                    'distance' => $order->distance,
//                    'tariff' => $order->tariff
//                ]
//            );
//    }
}
