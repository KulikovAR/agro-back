<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $role = Role::where('slug', 'manager')->first();

        $user->assignRole($role);

        $response = $this->json('get', route('managers.list'), headers: $this->getHeadersForUser());

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                [
                    'id',
                    'name',
                    'phone',
                ],
            ],
        ]);

        $response->assertStatus(200);
    }
}
