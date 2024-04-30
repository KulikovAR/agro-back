<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\File;
use App\Models\FileType;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserAppNotification;
use App\Services\NotificationService;
use Carbon\Carbon;
use Database\Factories\CounteragentFactory;
use Database\Factories\DriverFactory;
use Database\Factories\GoodFactory;
use Database\Factories\UserinfoFactory;
use Database\Factories\UserProfileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    const ADMIN_PASSWORD = 'admin@admin';
    const ADMIN_EMAIL = 'admin@admin';

    const USER_PASSWORD = 'test@test.ru';
    const USER_EMAIL = 'test@test.ru';

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        $clientRole = Role::where('name', 'client')->first();

        $admin = User::create([
            'email'             => 'admin@admin.ru',
            'phone_number'      => '79202149563',
            'password'          => '12345678',
            'phone_verified_at' => Carbon::now()
        ]);

        $admin_role = Role::where('name', 'admin')->first();
        $admin->assignRole($admin_role);


        $user = User::factory()->create(
            [
                'password' => Hash::make(self::USER_PASSWORD),
                'email'    => self::USER_EMAIL,
            ],
        );
        $users = User::factory(10)->create();
        foreach ($users as $item) {
            $item->driver()->create((new DriverFactory())->definition());
            $item->files()->attach(File::inRandomOrder()->first()->id,['file_type_id'=>FileType::inRandomOrder()->first()->id, 'id'=>uuid_create()]);
            $item->userProfile()->create((new UserinfoFactory())->definition());
            $item->assignRole($clientRole);
        }
        // $user->assignRole(Role::ROLE_USER);

        // $user->userProfile()->create((new UserProfileFactory())->definition());

        // $user->notify(new UserAppNotification('Тестовое уведомление'));
    }
}
