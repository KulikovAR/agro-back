<?php

namespace Database\Factories;

use App\Enums\LoadMethodEnum;
use App\Enums\OrderClarificationDayEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'crop'                                        => $this->faker->word,
            'volume'                                      => $this->faker->numberBetween(1, 100),
            'distance'                                    => $this->faker->numberBetween(1, 100),
            'tariff'                                      => $this->faker->numberBetween(1, 100),
            'nds_percent'                                 => $this->faker->numberBetween(0, 100),
            'terminal_name'                               => $this->faker->company,
            'exporter_name'                               => $this->faker->name,
            'height_limit'                                => $this->faker->numberBetween(1, 10),
            'is_overload'                                 => $this->faker->boolean,
            'timeslot'                                    => $this->faker->word,
            'load_city'                                   => $this->faker->city,
            'unload_city'                                 => $this->faker->city,
            'unload_region'                               => $this->faker->country(),
            'load_region'                                 => $this->faker->country(),
            'scale_length'                                => $this->faker->numberBetween(1, 10),
            'outage_begin'                                => $this->faker->numberBetween(1, 100),
            'outage_price'                                => $this->faker->numberBetween(1, 100),
            'daily_load_rate'                             => $this->faker->numberBetween(1, 100),
            'contact_name'                                => $this->faker->word,
            'contact_phone'                               => $this->faker->phoneNumber,
            'cargo_shortage_rate'                         => $this->faker->numberBetween(1, 100),
            'unit_of_measurement_for_cargo_shortage_rate' => $this->faker->word,
            'cargo_price'                                 => $this->faker->numberBetween(1, 100),
            'load_place'                                  => $this->faker->address,
            'approach'                                    => $this->faker->sentence,
            'work_time'                                   => $this->faker->sentence,
            'clarification_of_the_weekend'                => OrderClarificationDayEnum::SATURDAY_AND_SUNDAY->value,
            'loader_power'                                => $this->faker->numberBetween(1, 100),
            'load_method'                                 => LoadMethodEnum::BY_THE_TUBE->value,
            'tolerance_to_the_norm'                       => $this->faker->numberBetween(1, 100),
            'start_order_at'                              => $this->faker->dateTimeBetween('+1 days', '+1 week'),
            'end_order_at'                                => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'load_latitude'                               => $this->faker->latitude,
            'load_longitude'                              => $this->faker->longitude,
            'unload_latitude'                             => $this->faker->latitude,
            'unload_longitude'                            => $this->faker->longitude,
            'unload_place_name'                           => "Ростов",
            'load_place_name'                             => "Донецк",
//            'cargo_weight'                                => $this->faker->numberBetween(1, 100),
            'description'                                 => $this->faker->paragraph,
            'is_full_charter'                             => $this->faker->boolean,
            'status'                                      => OrderStatusEnum::ACTIVE->value,
        ];
    }
}
