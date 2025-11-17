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
    Schema::table('menu', function (Blueprint $table) {
        if (!Schema::hasColumn('menu', 'harga')) {
            $table->decimal('harga')->default(0)->after('gambar_menu');
        }
        if (!Schema::hasColumn('menu', 'stok')) {
            $table->integer('stok')->default(0)->after('harga');
        }
    });
}

public function down(): void
{
    Schema::table('menu', function (Blueprint $table) {
        $table->dropColumn(['harga', 'stok']);
    });
}

};
