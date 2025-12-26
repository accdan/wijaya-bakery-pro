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
        Schema::table('sponsor', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('logo_sponsor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sponsor', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
