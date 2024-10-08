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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('crop');
            $table->integer('volume');
            $table->integer('distance')->nullable();
            $table->integer('tariff');
            $table->integer('nds_percent')->nullable();
            $table->string('terminal_name')->nullable();
            $table->string('exporter_name')->nullable();
            $table->float('scale_length');
            $table->string('load_city');
            $table->string('unload_city');
            $table->string('load_region');
            $table->string('unload_region');
            $table->float('height_limit');
            $table->boolean('is_overload')->nullable();
            $table->string('timeslot')->nullable();
            $table->string('status')->nullable();
            $table->integer('outage_begin')->nullable();
            $table->integer('outage_price')->nullable();
            $table->integer('daily_load_rate')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->integer('cargo_shortage_rate')->nullable();
            $table->string('unit_of_measurement_for_cargo_shortage_rate')->nullable();
            $table->integer('cargo_price')->nullable();
            $table->string('load_place')->nullable();
            $table->string('approach')->nullable();
            $table->text('work_time')->nullable();
            $table->string('clarification_of_the_weekend')->nullable();
            $table->integer('loader_power')->nullable();
            $table->integer('order_number')->default(0);
            $table->string('load_method');
            $table->string('unload_type')->nullable();
            $table->integer('tolerance_to_the_norm')->nullable();
            $table->timestamp('start_order_at')->useCurrent();
            $table->timestamp('end_order_at')->useCurrent();
            $table->string('load_latitude')->nullable();
            $table->string('load_longitude')->nullable();
            $table->string('unload_latitude')->nullable();
            $table->string('unload_longitude')->nullable();
            $table->string('load_place_name');
            $table->string('unload_place_name');
            //            $table->integer('cargo_weight');
            $table->boolean('is_full_charter')->nullable();
            $table->text('description')->nullable();
            $table->uuid('creator_id');
            $table->foreign('creator_id')->on('users')->references('id')->onDelete('cascade');
            $table->boolean('is_moderated')->default(false);
            $table->integer('view_counter')->default(0);
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
