<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transport>
 */
class TransportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'type' => 1,
            'number' => $this->faker->unique()->word(),
            'model' => 'Moskvich',
            'description' => $this->faker->text(10),
            'free' => true,
            'is_active' => true,
            'volume_cm' => $this->faker->randomNumber(),
            'capacity' => $this->faker->randomNumber(),

        ];
    }
}
