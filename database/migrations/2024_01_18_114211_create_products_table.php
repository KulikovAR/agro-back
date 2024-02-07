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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class')->nullable();
            $table->string('attr')->nullable();
            $table->string('company');
            $table->float('price');
            $table->integer('type');
            $table->string('gluten')->nullable();
            $table->string('idk')->nullable();
            $table->string('chp')->nullable();
            $table->string('nature')->nullable();
            $table->string('humidity')->nullable();
            $table->string('weed_impurity')->nullable();
            $table->string('chinch')->nullable();
            $table->tinyInteger('parser')->default(1);
            $table->string('exporter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
