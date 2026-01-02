<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Add database indexes to improve query performance
     */
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            // Index for date filtering and sorting
            $table->index('created_at', 'pesanan_created_at_index');

            // Index for customer search
            $table->index('nama_pemesan', 'pesanan_nama_pemesan_index');
            $table->index('no_hp', 'pesanan_no_hp_index');

            // Index for menu relationship (foreign key already indexed, but explicit for clarity)
            // $table->index('menu_id'); // Usually already indexed as FK
        });

        Schema::table('carts', function (Blueprint $table) {
            // Composite index for user cart queries
            $table->index(['user_id', 'menu_id'], 'carts_user_menu_index');
        });

        Schema::table('menu', function (Blueprint $table) {
            // Index for category filtering
            // $table->index('kategori_id'); // Usually already indexed as FK

            // Index for stock availability checks
            $table->index('stok', 'menu_stok_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropIndex('pesanan_created_at_index');
            $table->dropIndex('pesanan_nama_pemesan_index');
            $table->dropIndex('pesanan_no_hp_index');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex('carts_user_menu_index');
        });

        Schema::table('menu', function (Blueprint $table) {
            $table->dropIndex('menu_stok_index');
        });
    }
};
