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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('crop');
            $table->integer('volume');
            $table->integer('distance');
            $table->integer('tariff');
            $table->integer('nds_percent')->nullable();
            $table->string('terminal_name');
            $table->string('terminal_address');
            $table->string('terminal_inn');
            $table->string('exporter_name');
            $table->string('exporter_inn');
            $table->integer('scale_length');
            $table->integer('height_limit');
            $table->boolean('is_overload');
            $table->string('timeslot');
            $table->integer('outage_begin')->nullable();
            $table->integer('outage_price')->nullable();
            $table->integer('daily_load_rate')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->integer('cargo_shortage_rate')->nullable();
            $table->string('unit_of_measurement_for_cargo_shortage_rate')->nullable();
            $table->integer('cargo_price')->nullable();
            $table->string('load_place');
            $table->string('approach')->nullable();
            $table->text('work_time')->nullable();
            $table->boolean('is_load_in_weekend')->nullable();
            $table->string('clarification_of_the_weekend')->nullable();
            $table->integer('loader_power')->nullable();
            $table->integer('order_number')->default(0);
            $table->string('unload_method');
            $table->string('load_method');
            $table->string('unload_type')->nullable();
            $table->integer('tolerance_to_the_norm')->nullable();
            $table->timestamp('start_order_at')->useCurrent();
            $table->timestamp('end_order_at')->useCurrent();
            $table->string('load_latitude');
            $table->string('load_longitude');
            $table->string('unload_latitude');
            $table->string('unload_longitude');
            $table->string('load_place_name');
            $table->string('unload_place_name');
            $table->integer('cargo_weight');
            $table->boolean('is_full_charter')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_moderated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
