<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Enums\RoleEnum;
use App\Models\File;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserAppNotification;
use Carbon\Carbon;
use Database\Factories\UserinfoFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    const USER_PASSWORD = 'test@test.ru';

    const USER_EMAIL = 'test@test.ru';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            $admin = User::create([
                'email' => 'oooagrologistika@admin.ru',
                'phone_number' => '79202149563',
                'password' => 'dima12345',
                'phone_verified_at' => Carbon::now(),
            ]);

            $admin_role = Role::where('name', 'admin')->first();
            $admin->assignRole($admin_role);

            $Ic = User::create([]);
            $Ic->assignRole(RoleEnum::IC->value);
        }
        $clientRole = Role::where('slug', 'client')->first();

        $admin = User::create([
            'email' => 'admin@admin.ru',
            'phone_number' => '79202149563',
            'password' => '12345678',
            'phone_verified_at' => Carbon::now(),
        ]);

        $admin_role = Role::where('name', 'admin')->first();
        $admin->assignRole($admin_role);

        $client = User::create([
            'email' => 'cleint@cleint.ru',
            'phone_number' => '+7 (889) 999-99-99',
            'password' => '12345678',
            'phone_verified_at' => Carbon::now(),
        ]);
        $client->assignRole($clientRole);
        $client->files()->attach(File::inRandomOrder()->first()->id);
        $client->userProfile()->create((new UserinfoFactory)->definition());

        $managerRole = Role::where('slug', 'client')->first();

        $manager = User::create([
            'email' => 'manager@manager.ru',
            'phone_number' => '+7 (889) 999-99-91',
            'password' => '12345678',
            'phone_verified_at' => Carbon::now(),
        ]);
        $manager->assignRole($managerRole);
        $manager->userProfile()->create((new UserinfoFactory)->definition());

        $Ic = User::create([]);
        $Ic->assignRole(RoleEnum::IC->value);

        User::factory()->create(
            [
                'password' => Hash::make(self::USER_PASSWORD),
                'email' => self::USER_EMAIL,
            ]
        );

        $users = User::factory(10)->create();

        foreach ($users as $item) {
            $item->files()->attach(File::inRandomOrder()->first()->id);
            $item->userProfile()->create((new UserinfoFactory)->definition());
            $item->assignRole($clientRole);
        }
    }
}
