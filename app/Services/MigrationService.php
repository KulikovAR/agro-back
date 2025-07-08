<?php

namespace App\Services;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MigrationService extends Migration
{
    public function registerDoctrineEnumType(): void
    {
        $platform = DB::getDoctrineConnection()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
    }
}
