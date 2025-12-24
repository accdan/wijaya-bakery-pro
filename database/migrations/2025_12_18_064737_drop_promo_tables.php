<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop promo_id column from pesanan table if exists
        if (Schema::hasColumn('pesanan', 'promo_id')) {
            Schema::table('pesanan', function (Blueprint $table) {
                $table->dropColumn('promo_id');
            });
        }

        // Drop promo_menu pivot table
        Schema::dropIfExists('promo_menu');

        // Drop promos table
        Schema::dropIfExists('promos');

        // Drop promo table (old naming convention)
        Schema::dropIfExists('promo');

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse - promo feature is being permanently removed
    }
};
