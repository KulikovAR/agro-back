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
            $table->uuid('creator_id')->nullable();
            $table->foreign('creator_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('inn')->unique()->nullable();
            $table->string('region')->nullable();
            $table->string('kpp')->unique()->nullable();
            $table->string('ogrn')->unique()->nullable();
            $table->string('short_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('juridical_address')->nullable();
            $table->string('office_address')->nullable();
            $table->string('tax_system')->nullable();
            $table->string('okved')->nullable();
            $table->string('type')->nullable();
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->timestamp('issue_date_at')->nullable();
            $table->timestamp('bdate')->nullable();
            $table->text('department')->nullable();
            $table->string('gender')->nullable();
            $table->string('department_code')->nullable();
            $table->string('snils')->nullable();
            $table->string('accountant_phone')->nullable();
            $table->string('director_name')->nullable();
            $table->string('director_surname')->nullable();
            $table->unsignedInteger('sign_me_id')->nullable();
            $table->boolean('is_signer')->default(false);
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
