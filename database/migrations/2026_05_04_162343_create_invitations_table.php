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
    Schema::create('invitations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
        $table->string('guest_name'); // Nom de l'invité ou du groupe
        $table->enum('type', ['singleton', 'couple', 'groupe'])->default('singleton');
        $table->integer('access_count')->default(1); // Nombre de personnes autorisées
        $table->string('phone')->nullable(); // Pour l'envoi WhatsApp
        $table->string('link_token')->unique(); // Jeton unique pour l'URL (ex: aB3k9z...)
        $table->boolean('is_opened')->default(false); // Pour savoir si l'invité a cliqué sur le lien
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
