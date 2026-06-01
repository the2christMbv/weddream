<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // 1. Création sécurisée de la table des tables
    if (!Schema::hasTable('wedding_tables')) {
        Schema::create('wedding_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('capacity')->default(10);
            $table->timestamps();
        });
    }

    // 2. Mise à jour sécurisée de la table guests
    Schema::table('guests', function (Blueprint $table) {
        if (!Schema::hasColumn('guests', 'table_id')) {
            $table->foreignId('table_id')->nullable()->constrained('wedding_tables')->onDelete('set null');
        }
        if (!Schema::hasColumn('guests', 'first_drink')) {
            $table->string('first_drink')->nullable();
        }
        if (!Schema::hasColumn('guests', 'is_checked_in')) {
            $table->boolean('is_checked_in')->default(false);
        }
        if (!Schema::hasColumn('guests', 'checked_in_at')) {
            $table->timestamp('checked_in_at')->nullable();
        }
        if (!Schema::hasColumn('guests', 'qr_token')) {
            $table->string('qr_token')->unique()->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reception_tables_and_update_guests');
    }
};
