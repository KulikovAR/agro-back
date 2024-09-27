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
        $admin_role = Role::create(
            [
                'name' => 'admin',
                'slug' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $logistician_role = Role::create(
            [
                'name' => 'logistician',
                'slug' => 'logistician',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $client_role = Role::create(
            [
                'name' => 'client',
                'slug' => 'client',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $IC_role = Role::create(
            [
                'name' => '1C',
                'slug' => '1C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
