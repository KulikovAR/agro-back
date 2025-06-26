<?php

namespace Tests;

use App\Models\User;
use Database\Factories\UserProfileFactory;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public array $userBearerHeaders;

    const USER_PASSWORD = 'test@test.ru';

    const USER_EMAIL = 'test@test.ru';

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    protected function setup(): void
    {
        parent::setUp();
        Cache::flush();

        $this->userBearerHeaders = $this->getHeadersForUser();
    }

    protected function createTestUser(array $attributes = []): User
    {
        $user = User::factory()->create($attributes);

        $user->userProfile()->create((new UserProfileFactory)->definition());

        return $user;
    }

    protected function getTestUser(): User
    {
        return User::where(['email' => UserSeeder::USER_EMAIL])->firstOrFail();
    }

    protected function getHeadersForUser(?User $user = null): array
    {
        $token = ($user ?? $this->getTestUser())
            ->createToken('spa')
            ->plainTextToken;

        return ['Authorization' => "Bearer $token"];
    }

    protected function assertSameResource(JsonResource $resource, array $responseArray): void
    {
        $this->assertSame(json_decode($resource->toJson(), true), $responseArray);
    }

    protected function assertNotSameResource(JsonResource $resource, array $responseArray): void
    {
        $this->assertNotSame(json_decode($resource->toJson(), true), $responseArray);
    }

    protected function getPaginationResponse(array $data = [])
    {
        $data_with_pagination = [
            'data',
            'links' => [
                'first',
                'prev',
                'next',
                'last',
            ],
            'meta' => [
                'current_page',
                'last_page',
                'per_page',
                'total',
                'path',
            ],
        ];

        if (!empty($data)) {
            $data_with_pagination['data'] = $data;
        }

        return $data_with_pagination;
    }

    public function generateRandomPhoneNumber(): string
    {
        $prefix = '+7';

        $randomDigits = '';
        for ($i = 0; $i < 10; $i++) {
            $randomDigits .= rand(0, 9);
        }

        return $prefix . $randomDigits;
    }
}
