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
        // Add soft deletes to menu table
        Schema::table('menu', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to kategori table
        Schema::table('kategori', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to sponsor table
        Schema::table('sponsor', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to pesanan table
        Schema::table('pesanan', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('kategori', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('sponsor', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
