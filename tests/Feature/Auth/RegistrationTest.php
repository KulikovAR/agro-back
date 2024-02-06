<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Services\Sms\SmsVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Generator as Faker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_registration(): void
    {

        $phone_number = '792021495' . $this->faker->numberBetween(0, 9) . $this->faker->numberBetween(0, 9);
        $response = $this->json('POST', '/api/registration/phone', ['phone_number' =>  $phone_number]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'phone_number',
                        'code',
                        'code_hash',
                        'phone_verified_at',
                    ],
                ],
            ]);

        $responseData = $response->json('data.user');
    }


    public function test_verify_phone_success()
    {

        $phone_number = '792021495' . $this->faker->numberBetween(0, 9) . $this->faker->numberBetween(0, 9);

        $response = $this->json('POST', '/api/registration/phone', ['phone_number' =>  $phone_number]);

       

        // Получаем пользователя из базы данных
        $user = User::where('phone_number', $phone_number)->first();
        
        // Подтверждаем телефон с правильным кодом
        $responseVerify = $this->json('POST', 'api/registration/verification', [
            'phone_number' => $user->phone_number,
            'code'         => $user->code,
        ]);
        $responseVerify->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'phone_number',
                        'code',
                        'code_hash',
                        'phone_verified_at',
                    ],
                    'token',
                ],
            ]);
       
    }

    public function test_verify_phone_invalid_code()
    {

        $phone_number = '792021495' . $this->faker->numberBetween(0, 9) . $this->faker->numberBetween(0, 9);

        $response = $this->json('POST', '/api/registration/phone', ['phone_number' =>  $phone_number]);

     
        // Создаем пользователя и отправляем запрос на регистрацию

        // Подтверждаем телефон с неверным кодом
        $responseVerify = $this->json('POST', 'api/registration/verification', [
            'phone_number' => $phone_number,
            'code'         => '11111', // Неверный код
        ]);

        $responseVerify->assertStatus(400)
            ->assertJsonFragment(['message' => 'Неверный код']);
    }
}
