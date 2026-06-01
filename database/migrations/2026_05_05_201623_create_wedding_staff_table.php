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
        Schema::create('wedding_staff', function (Blueprint $table) {
    $table->id();
    $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('phone');
    $table->string('email');
    $table->string('role');
    $table->string('access_token')->unique();
    $table->string('password'); // Ajout du mot de passe simple
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_staff');
    }
};
