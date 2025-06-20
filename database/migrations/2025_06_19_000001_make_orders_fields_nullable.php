<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('crop')->nullable()->change();
            $table->integer('volume')->nullable()->change();
            $table->integer('tariff')->nullable()->change();
            $table->float('scale_length')->nullable()->change();
            $table->float('height_limit')->nullable()->change();
            $table->string('load_method')->nullable()->change();
            $table->string('contact_name')->nullable()->change();
            $table->string('contact_phone')->nullable()->change();
            $table->string('load_place_name')->nullable()->change();
            $table->string('unload_place_name')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('crop')->nullable(false)->change();
            $table->integer('volume')->nullable(false)->change();
            $table->float('scale_length')->nullable(false)->change();
            $table->float('height_limit')->nullable(false)->change();
            $table->string('load_method')->nullable(false)->change();
            $table->string('contact_name')->nullable(false)->change();
            $table->string('contact_phone')->nullable(false)->change();
            $table->string('load_place_name')->nullable(false)->change();
            $table->string('unload_place_name')->nullable(false)->change();
        });
    }
};