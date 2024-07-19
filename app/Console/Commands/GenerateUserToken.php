<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateUserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:token {role?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!is_null($this->argument('role'))) {
            $role = Role::where('name', $this->argument('role'))->first();
            echo User::role($role)->first()->createToken('')->plainTextToken . "\n";
            return;
        }
        echo User::first()->createToken('')->plainTextToken . "\n";
    }
}
