<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userinfos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('inn')->unique();
            $table->string('kpp')->unique()->nullable();
            $table->string('ogrn')->unique()->nullable();
            $table->string('short_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('juridical_address')->nullable();
            $table->string('office_address')->nullable();
            $table->string('tax_system')->nullable();
            $table->string('okved')->nullable();
            // $table->string('bank_accounts');
            $table->string('type')->nullable();
            $table->string('series')->nullable();
            $table->string('number')->nullable();
            $table->timestamp('issue_date_at')->nullable();
            $table->text('department')->nullable();
            $table->string('department_code')->nullable();
            $table->string('snils')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userinfos');
    }
};
