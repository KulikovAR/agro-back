<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('whats_app_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('chat_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('type');
            $table->string('account');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whats_app_clients');
    }
};
