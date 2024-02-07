<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'class' => $this->faker->word(),
            'attr' => $this->faker->word(),
            'company' => $this->faker->word(),
            'price' => 6.9,
            'type' => $this->faker->randomNumber(),
            'gluten' => $this->faker->word(),
            'idk' => $this->faker->word(),
            'chp' => $this->faker->word(),
            'nature' => $this->faker->word(),
            'humidity' => $this->faker->word(),
            'weed_impurity' => $this->faker->word(),
            'chinch' => $this->faker->word(),
            'exporter' => $this->faker->word(),

            
            
        ];
    }
}
