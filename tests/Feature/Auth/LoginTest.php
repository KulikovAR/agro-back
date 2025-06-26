<?php

namespace Tests\Feature\Auth;

use App\Enums\ModerationStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_login_creates_new_user_with_client_role()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();

        $response = $this->postJson('/api/v1/login', [
            'phone_number' => $phoneNumber
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'phone_number',
                    ]
                ]
            ]);

        $user = User::where('phone_number', $phoneNumber)->first();
        $this->assertNotNull($user);
        $this->assertEquals(ModerationStatusEnum::APPROVED->value, $user->moderation_status);
        $this->assertEquals('11111', $user->code);

        $this->assertTrue($user->hasRole('client'));
    }

    public function test_login_finds_existing_user_and_preserves_logistician_role()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();

        $user = User::factory()->create([
            'phone_number' => $phoneNumber,
            'moderation_status' => ModerationStatusEnum::APPROVED->value
        ]);
        $user->assignRole('logistician');

        $response = $this->postJson('/api/v1/login', [
            'phone_number' => $phoneNumber
        ]);

        $response->assertStatus(200);

        $user->refresh();
        $this->assertTrue($user->hasRole('logistician'));
        $this->assertFalse($user->hasRole('client'));
    }

    public function test_login_clears_profile_for_new_users()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();

        $this->postJson('/api/v1/login', [
            'phone_number' => $phoneNumber
        ]);

        $user = User::where('phone_number', $phoneNumber)->first();

        $this->assertNull($user->name);
        $this->assertNull($user->surname);
        $this->assertNull($user->email);
        $this->assertNull($user->inn);
    }

    public function test_login_validation_requires_valid_phone_number()
    {
        $response = $this->postJson('/api/v1/login', [
            'phone_number' => 'invalid-phone'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_login_validation_requires_phone_number()
    {
        $response = $this->postJson('/api/v1/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_verification_check_success_with_valid_code()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();
        $code = '11111';

        $user = User::factory()->create([
            'phone_number' => $phoneNumber,
            'code' => $code
        ]);

        $response = $this->postJson('/api/v1/login/verification', [
            'phone_number' => $phoneNumber,
            'code' => $code,
            'device_token' => 'device-token-123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user' => [
                        'id',
                        'phone_number'
                    ],
                    'token'
                ]
            ]);

        $this->assertDatabaseHas('device_tokens', [
            'user_id' => $user->id,
            'token' => 'device-token-123'
        ]);
    }

    public function test_verification_check_fails_with_invalid_code()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();

        User::factory()->create([
            'phone_number' => $phoneNumber,
            'code' => '11112'
        ]);

        $response = $this->postJson('/api/v1/login/verification', [
            'phone_number' => $phoneNumber,
            'code' => 'wrong-code'
        ]);

        $response->assertStatus(500);
    }

    public function test_verification_check_without_device_token()
    {
        $phoneNumber = $this->generateRandomPhoneNumber();
        $code = '11111';

        User::factory()->create([
            'phone_number' => $phoneNumber,
            'code' => $code
        ]);

        $response = $this->postJson('/api/v1/login/verification', [
            'phone_number' => $phoneNumber,
            'code' => $code
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'user',
                    'token'
                ]
            ]);
    }

    public function test_verification_check_validation_requires_phone_number()
    {
        $response = $this->postJson('/api/v1/login/verification', [
            'code' => '11111'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone_number']);
    }

    public function test_verification_check_validation_requires_code()
    {
        $response = $this->postJson('/api/v1/login/verification', [
            'phone_number' => '+79202149578'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
