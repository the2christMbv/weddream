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
    Schema::table('weddings', function (Blueprint $table) {
        // On l'ajoute juste après guest_count_estimated pour que ce soit propre
        $table->integer('max_invitations')->nullable()->after('guest_count_estimated');
    });
}

public function down(): void
{
    Schema::table('weddings', function (Blueprint $table) {
        $table->dropColumn('max_invitations');
    });
}

    /**
     * Reverse the migrations.
     */
};
