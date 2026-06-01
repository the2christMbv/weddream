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
    Schema::create('wedding_drinks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
        $table->string('name'); // ex: Coupe de Champagne Moët & Chandon
        $table->string('category')->nullable(); // ex: Alcoolisé, Soft, Cocktail
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_drinks');
    }
};
