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
        // On ajoute la colonne wedding_id qui peut être nulle (pour le SuperAdmin par exemple)
        $table->foreignId('wedding_id')->nullable()->constrained('weddings')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['wedding_id']);
        $table->dropColumn('wedding_id');
    });
}
};
