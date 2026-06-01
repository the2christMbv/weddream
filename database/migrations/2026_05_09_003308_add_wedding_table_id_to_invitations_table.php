<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            // Ajout de la clé étrangère vers la table wedding_tables
            // nullable() est crucial car un invité n'a pas de table au début
            $table->foreignId('wedding_table_id')
                  ->nullable()
                  ->constrained('wedding_tables')
                  ->onDelete('set null'); 
            
            // On en profite pour ajouter le numéro de siège et le statut de check-in
            $table->integer('seat_number')->nullable();
            $table->boolean('is_checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign(['wedding_table_id']);
            $table->dropColumn(['wedding_table_id', 'seat_number', 'is_checked_in', 'checked_in_at']);
        });
    }
};