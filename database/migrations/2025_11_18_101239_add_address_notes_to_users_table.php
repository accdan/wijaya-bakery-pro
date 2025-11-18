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
        Schema::table('users', function (Blueprint $table) {
            $table->string('province')->nullable()->after('no_telepon');
            $table->string('regency')->nullable()->after('province');
            $table->string('street')->nullable()->after('regency');
            $table->string('hamlet')->nullable()->after('street');
            $table->text('address_notes')->nullable()->after('hamlet'); // For additional delivery notes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
