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
    Schema::create('drinks', function (Blueprint $table) {
        $table->id();
        // Clé étrangère pour lier la boisson à un mariage spécifique
        $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('category')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinks');
    }
};
