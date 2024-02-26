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
        Schema::create('counteragents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('kpp')->nullable();
            $table->string('inn');
            $table->string('ogrn');
            $table->string('short_name');
            $table->string('full_name');
            $table->string('juridical_address');
            $table->string('office_address');
            $table->string('tax_system');
            $table->string('okved');
            // $table->string('bank_accounts');
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counteragents');
    }
};
