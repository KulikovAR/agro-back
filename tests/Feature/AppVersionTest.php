<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppVersionTest extends TestCase
{
    use WithFaker;

    protected function getHeadersForUser(?User $user = null): array
    {
        $token = ($user ?? $this->createTestUser())
            ->createToken('test-token')
            ->plainTextToken;

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function test_get_latest_version_success(): void
    {
        $user = User::factory()->create();

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->getJson('/api/v1/app-version/latest');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'version',
                    'needs_update'
                ]
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'Версия получена успешно'
            ]);
    }

    public function test_get_latest_version_with_update_needed(): void
    {
        $user = User::factory()->create(['app_version' => '0.9.0']);

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->getJson('/api/v1/app-version/latest');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'needs_update' => true
                ]
            ]);
    }

    public function test_get_latest_version_unauthorized(): void
    {
        $response = $this->getJson('/api/v1/app-version/latest');

        $response->assertStatus(401);
    }

    public function test_save_version_success(): void
    {
        $user = User::factory()->create();
        $version = '1.5.2';

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->postJson('/api/v1/app-version/save', [
                'version' => $version
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'version'
                ]
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'Версия сохранена успешно',
                'data' => [
                    'version' => $version
                ]
            ]);

        // Проверяем, что версия действительно сохранилась в БД
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'app_version' => $version
        ]);
    }

    public function test_save_version_validation_error(): void
    {
        $user = User::factory()->create();

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->postJson('/api/v1/app-version/save', [
                'version' => '' // Пустая версия
            ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
                'errors'
            ])
            ->assertJson([
                'status' => 'error',
                'message' => 'Ошибка валидации'
            ]);
    }

    public function test_save_version_too_long(): void
    {
        $user = User::factory()->create();
        $longVersion = str_repeat('1', 51); // Версия длиннее 50 символов

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->postJson('/api/v1/app-version/save', [
                'version' => $longVersion
            ]);

        $response->assertStatus(422);
    }

    public function test_save_version_unauthorized(): void
    {
        $response = $this->postJson('/api/v1/app-version/save', [
            'version' => '1.0.0'
        ]);

        $response->assertStatus(401);
    }

    public function test_save_version_missing_version(): void
    {
        $user = User::factory()->create();

        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->postJson('/api/v1/app-version/save', []);

        $response->assertStatus(422);
    }

    public function test_version_comparison_logic(): void
    {
        $user = User::factory()->create(['app_version' => '1.0.0']);

        // Тестируем логику сравнения версий
        $response = $this->withHeaders($this->getHeadersForUser($user))
            ->getJson('/api/v1/app-version/latest');

        $response->assertStatus(200);
        
        $data = $response->json('data');
        $this->assertArrayHasKey('needs_update', $data);
        $this->assertArrayHasKey('version', $data);
    }
}
