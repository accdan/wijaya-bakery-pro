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
            $table->boolean('is_weekend_only')->default(false)->after('apply_to_cart_total');
            $table->boolean('is_weekday_only')->default(false)->after('is_weekend_only');
            $table->json('active_days')->nullable()->after('is_weekday_only'); // Array of weekdays (1=Monday, 7=Sunday)
            $table->time('active_from')->nullable()->after('active_days'); // Time start
            $table->time('active_until')->nullable()->after('active_from'); // Time end
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->dropColumn([
                'is_weekend_only',
                'is_weekday_only',
                'active_days',
                'active_from',
                'active_until'
            ]);
        });
    }
};
