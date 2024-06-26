<?php

namespace Database\Factories;

use App\Models\TakeOut;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
            'email'                   => fake()->unique()->safeEmail(),
            'email_verified_at'       => now(),
            'phone_number'            => $this->faker->numerify('+7#########'),
            'phone_verified_at'        => now(),
            'salt'                    => Hash::make(Str::random(10)),
            'password'                => Hash::make('test'),
            'code'                    => $this->faker->randomNumber(),
            'code_hash'               => Hash::make('stroka'),
            'code_expire_at'          => now(),
            'remember_token'          => Str::random(10)
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}