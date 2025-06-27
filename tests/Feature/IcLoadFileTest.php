<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class IcLoadFileTest extends TestCase
{
    public function test_load_file_from_1C(): void
    {
        $user1C = User::factory()->create();
        $user1C->assignRole(RoleEnum::IC->value);

        $clientUser = User::role('client')->whereNotNull('cinn')->first();
        if (!$clientUser) {
            $clientUser = User::factory()->create([
                'cinn' => '1234567890',
                'type' => 'company'
            ]);
            $clientUser->assignRole('client');
        }
        $inn = $clientUser->cinn;

        Storage::fake('local');
        $file = UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');

        $data = [
            'type' => 'Акт',
            'id_1c' => uuid_create(),
            'file' => $file,
        ];

        $response = $this->json(
            'POST',
            'api/v1/files/from-1c/' . $inn,
            $data,
            $this->getHeadersForUser($user1C)
        );

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'path_url',
                'path',
                'type',
                'id_1c',
            ],
        ]);
    }
}
