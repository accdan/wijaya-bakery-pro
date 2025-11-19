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
        Schema::create('promo_menu', function (Blueprint $table) {
            $table->id();
            $table->uuid('promo_id');
            $table->uuid('menu_id');
            $table->timestamps();

            $table->foreign('promo_id')->references('id')->on('promo')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

            $table->unique(['promo_id', 'menu_id']); // Prevent duplicate associations
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_menu');
    }
};
