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
            $table->string('inn')->unique();
            $table->string('kpp')->unique();
            $table->string('ogrn')->unique();
            $table->string('short_name');
            $table->string('full_name');
            $table->string('juridical_address');
            $table->string('office_address');
            $table->string('tax_system');
            $table->string('okved');
            $table->string('bank_accounts');
            $table->string('phone_number')->unique();
            $table->string('password');
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
