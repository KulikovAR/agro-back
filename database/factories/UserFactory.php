<?php

namespace Database\Factories;

use App\Enums\ModerationStatusEnum;
use App\Enums\OrganizationTypeEnum;
use App\Enums\TaxSystemEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(OrganizationTypeEnum::class),
            'inn' => function (array $attributes) {
                return $attributes['type'] === OrganizationTypeEnum::IP->value
                    ? $this->faker->regexify('/^\d{12}$/')
                    : $this->faker->regexify('/^\d{10}$/');
            },
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'patronymic' => $this->faker->lastName,
            'kpp' => function (array $attributes) {
                return $attributes['type'] === OrganizationTypeEnum::COMPANY->value
                    ? $this->faker->regexify('/^\d{9}$/')
                    : null;
            },
            'ogrn' => function (array $attributes) {
                return $attributes['type'] === OrganizationTypeEnum::IP->value
                    ? $this->faker->regexify('/^\d{15}$/')
                    : $this->faker->regexify('/^\d{13}$/');
            },
            'short_name' => $this->faker->companySuffix,
            'full_name' => $this->faker->company,
            'juridical_address' => $this->faker->address,
            'office_address' => $this->faker->address,
            'tax_system' => $this->faker->randomElement(TaxSystemEnum::class),
            'okved' => $this->faker->numerify('####'),
            'number' => $this->faker->numerify('########'),
            'series' => $this->faker->numerify('####'),
            'department' => $this->faker->company,
            'department_code' => $this->faker->numerify('####'),
            'snils' => $this->faker->numerify('###########'),
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'salt' => Str::random(60),
            'moderation_status' => ModerationStatusEnum::APPROVED->value,
            'code' => Str::random(10),
            'code_hash' => bcrypt(Str::random(10)),
            'code_expire_at' => now()->addHours(1),
            'region' => $this->faker->state,
            'accountant_phone' => $this->faker->phoneNumber,
            'director_name' => $this->faker->firstName,
            'director_surname' => $this->faker->lastName,
            'bdate' => Carbon::now(),
            'gender' => 'М',
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
