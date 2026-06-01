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
        // On ajoute les colonnes manquantes
        if (!Schema::hasColumn('users', 'phone')) {
            $table->string('phone')->nullable();
        }
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('client'); 
        }
        if (!Schema::hasColumn('users', 'wedding_id')) {
            $table->foreignId('wedding_id')->nullable()->constrained()->onDelete('cascade');
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone', 'role', 'wedding_id']);
    });
}
    /**
     * Reverse the migrations.
     */
};
