<?php

use App\Models\TakeOut;
use App\Enums\ModerationStatusEnum;
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
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->char('salt', 60)->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('moderation_status')->default(ModerationStatusEnum::PENDING->value);
            $table->string('code')->nullable();
            $table->string('code_hash')->nullable();
            $table->timestamp('code_expire_at')->nullable();
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
