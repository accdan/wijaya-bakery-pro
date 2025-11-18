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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->decimal('discount_amount', 10, 2)->default(0)->after('total_harga');
            $table->string('discount_type')->nullable()->after('discount_amount'); // 'fixed' or 'percentage'
            $table->uuid('promo_id')->nullable()->after('discount_type');
            $table->decimal('final_price', 10, 2)->default(0)->after('promo_id'); // total_harga - discount_amount

            $table->foreign('promo_id')->references('id')->on('promo')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            //
        });
    }
};
