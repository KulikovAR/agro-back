<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(
            [
                'name' => 'admin',
                'slug' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        Role::create(
            [
                'name' => 'logistician',
                'slug' => 'logistician',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        Role::create(
            [
                'name' => 'client',
                'slug' => 'client',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        Role::create(
            [
                'name'       => 'Менеджер',
                'slug'       => 'manager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        Role::create(
            [
                'name' => '1c',
                'slug' => '1c',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
