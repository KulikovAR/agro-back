<?php

namespace Tests\Feature\Auth;

use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeviceTokenTest extends TestCase
{
    use WithFaker;

    public function test_device_token_storage_during_verification()
    {
        $phone_number = $this->generateRandomPhoneNumber();

        $user = User::factory()->create(['phone_number' => $phone_number, 'code' => '11111']);
        $deviceToken = $this->faker->uuid();

        $response = $this->postJson(route('login.verification'), [
            'phone_number' => $user->phone_number,
            'code' => '11111',
            'device_token' => $deviceToken
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('device_tokens', [
            'user_id' => $user->id,
            'token' => $deviceToken
        ]);
    }

    public function test_device_token_removal_during_logout()
    {
        $phone_number = $this->generateRandomPhoneNumber();

        $user = User::factory()->create(compact('phone_number'));

        $deviceToken = $this->faker->uuid();

        DeviceToken::create([
            'user_id' => $user->id,
            'token' => $deviceToken
        ]);

        $this->actingAs($user);

        $response = $this->json('DELETE', route('logout.stateless', [
            'device_token' => $deviceToken
        ]));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('device_tokens', [
            'user_id' => $user->id,
            'token' => $deviceToken
        ]);
    }

    public function test_multiple_device_tokens_support()
    {
        $phone_number =  $this->generateRandomPhoneNumber();
        $user = User::factory()->create(['phone_number' => $phone_number, 'code' => '11111']);
        $token1 = $this->faker->uuid();
        $token2 = $this->faker->uuid();

        $this->postJson(route('login.verification'), [
            'phone_number' => $user->phone_number,
            'code' => '11111',
            'device_token' => $token1
        ]);


        $this->postJson(route('login.verification'), [
            'phone_number' => $user->phone_number,
            'code' => '11111',
            'device_token' => $token2
        ]);


        $this->assertCount(2, $user->fresh()->deviceTokens);
        $this->assertDatabaseHas('device_tokens', ['token' => $token1]);
        $this->assertDatabaseHas('device_tokens', ['token' => $token2]);
    }
}
