<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. On supprime l'ancienne contrainte d'unicité globale sur l'email
            // Selon ton système, le nom de l'index est souvent 'users_email_unique'
            $table->dropUnique('users_email_unique');

            // 2. On crée une NOUVELLE contrainte unique combinée (email + wedding_id)
            $table->unique(['email', 'wedding_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On fait l'inverse en cas de rollback
            $table->dropUnique(['email', 'wedding_id']);
            $table->string('email')->unique()->change();
        });
    }
};