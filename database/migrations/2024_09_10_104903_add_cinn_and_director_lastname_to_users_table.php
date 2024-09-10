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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cinn')->unique()->nullable();
            $table->string('sign_me_cid')->nullable();
            $table->boolean('company_activate')->nullable();
            $table->string('director_lastname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cinn');
            $table->dropColumn('sign_me_cid');
            $table->dropColumn('company_activate');
            $table->dropColumn('director_lastname');
        });
    }
};
