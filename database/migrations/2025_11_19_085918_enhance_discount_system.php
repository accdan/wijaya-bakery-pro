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
            // Change discount_type to include more options
            $table->enum('discount_type', ['fixed', 'percentage', 'buy_one_get_one', 'free_shipping'])
                ->default('fixed')
                ->change();

            // Add category-based discounts
            $table->uuid('kategori_id')->nullable()->after('menu_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');

            // Add price range discounts
            $table->decimal('price_min', 10, 2)->nullable()->after('kategori_id');
            $table->decimal('price_max', 10, 2)->nullable()->after('price_min');

            // Add discount rule types for advanced logic
            $table->enum('discount_rule', [
                'single_menu',      // One specific menu
                'multiple_menus',   // Multiple specific menus (via pivot table)
                'category_only',    // All items in a category
                'price_range',      // Items within price range
                'all_items'         // All items in store
            ])->default('all_items')->after('price_max');

            // Add additional discount conditions
            $table->integer('max_discount_uses')->nullable()->after('discount_rule'); // Limit uses per customer
            $table->timestamp('valid_until')->nullable()->after('max_discount_uses'); // Expiration date
            $table->boolean('apply_to_cart_total')->default(false)->after('valid_until'); // Apply to whole cart
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn([
                'kategori_id',
                'price_min',
                'price_max',
                'discount_rule',
                'max_discount_uses',
                'valid_until',
                'apply_to_cart_total'
            ]);

            // Revert discount_type back to original
            $table->enum('discount_type', ['fixed', 'percentage'])->default('fixed')->change();
        });
    }
};
