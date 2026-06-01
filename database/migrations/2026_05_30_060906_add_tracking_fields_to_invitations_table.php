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
        Schema::table('invitations', function (Blueprint $table) {
            // Ajoute les deux colonnes de suivi avec une valeur par défaut à "faux" (0)
            $table->boolean('is_seated')->default(false)->after('is_checked_in');
            $table->boolean('is_served')->default(false)->after('is_seated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['is_seated', 'is_served']);
        });
    }
};