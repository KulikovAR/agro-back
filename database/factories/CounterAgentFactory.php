<?php

namespace Database\Factories;

use App\Enums\OrganizationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CounteragentFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'inn'=> str_repeat($this->faker->numberBetween(0,9),10),
        //     'type' => OrganizationTypeEnum::randomCase(),
        //     'name' => $this->faker->name(),
        //     'surname' =>$this->faker->lastName(),
        //     'patronymic' => $this->faker->name(). 'ич',
        //     'kpp'        => str_repeat($this->faker->numberBetween(0,9),9),
        //     'ogrn'       => str_repeat($this->faker->numberBetween(0,9),15),
        //     'short_name' => $this->faker->name(),
        //     'full_name'  => $this->faker->name(),
        //     'juridical_address' => $this->faker->address(),
        //     'office_address' => $this->faker->address(),
        //     'tax_system' => $this->faker->word(),
        //     'okved' => $this->faker->word(),
        // ];
    }
}
