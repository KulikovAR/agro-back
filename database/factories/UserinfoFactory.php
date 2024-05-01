<?php

namespace Database\Factories;

use App\Enums\OrganizationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserinfoFactory extends Factory
{

    private $number_arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inn' => random_int(1000000000,9999999999),
            'type' => OrganizationTypeEnum::randomCase(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'patronymic' => $this->faker->name() . 'ич',
            'kpp'        => random_int(100000000,999999999),
            'ogrn'       => random_int(1000000000,9999999999) . random_int(100000,999999),
            'short_name' => $this->faker->name(),
            'full_name'  => $this->faker->name(),
            'juridical_address' => $this->faker->address(),
            'office_address' => $this->faker->address(),
            'tax_system' => $this->faker->word(),
            'okved' => $this->faker->word(),

        ];
    }
}
