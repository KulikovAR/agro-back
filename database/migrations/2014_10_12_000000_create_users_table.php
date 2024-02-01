<?php

use App\Models\TakeOut;
use App\Services\MigrationService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends MigrationService
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->registerDoctrineEnumType();

        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->char('salt', 60)->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->unique();
            $table->string('code');
            $table->string('code_hash');
            $table->timestamp('code_expire_at');
            $table->softDeletes();
            $table->timestamps();
            $table->rememberToken();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['credential_id']);
        });

        Schema::dropIfExists('users');
    }
};
