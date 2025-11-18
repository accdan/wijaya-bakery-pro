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
        Schema::table('promo', function (Blueprint $table) {
            $table->uuid('menu_id')->nullable()->after('gambar_promo');
            $table->integer('min_quantity')->default(1)->after('menu_id');
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed')->after('min_quantity');
            $table->decimal('discount_value', 10, 2)->default(0)->after('discount_type');
            $table->boolean('is_discount_active')->default(true)->after('discount_value');

            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            //
        });
    }
};
