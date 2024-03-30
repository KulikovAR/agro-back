<?php

namespace Database\Factories;

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
            'volume'                                      => $this->faker->word,
            'distance'                                    => $this->faker->numberBetween(1, 100),
            'tariff'                                      => $this->faker->numberBetween(1, 100),
            'nds_percent'                                 => $this->faker->numberBetween(0, 100),
            'terminal_name'                               => $this->faker->company,
            'terminal_address'                            => $this->faker->address,
            'terminal_inn'                                => $this->faker->numerify('##########'),
            'exporter_name'                               => $this->faker->name,
            'exporter_inn'                                => $this->faker->numerify('##########'),
            'is_semi_truck'                               => $this->faker->boolean,
            'is_tonar'                                    => $this->faker->boolean,
            'height_limit'                                => $this->faker->numberBetween(1, 10),
            'is_overload'                                 => $this->faker->boolean,
            'timeslot'                                    => $this->faker->word,
            'scale_lenght'                                => $this->faker->numberBetween(1, 10),
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
            'is_load_in_weekend'                          => $this->faker->boolean,
            'clarification_of_the_weekend'                => $this->faker->word,
            'loader_power'                                => $this->faker->numberBetween(1, 100),
            'load_method'                                 => $this->faker->word,
            'tolerance_to_the_norm'                       => $this->faker->numberBetween(1, 100),
            'start_order_at'                              => $this->faker->dateTimeBetween('+1 days', '+1 week'),
            'end_order_at'                                => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'load_latitude'                               => $this->faker->latitude,
            'load_longitude'                              => $this->faker->longitude,
            'unload_latitude'                             => $this->faker->latitude,
            'unload_longitude'                            => $this->faker->longitude,
            'unload_place_name'                           => $this->faker->word(),
            'load_place_name'                             => $this->faker->word(),
            'cargo_weight'                                => $this->faker->numberBetween(1,100),
            'description'                                 => $this->faker->paragraph,
        ];
    }
}
