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
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->date('event_date');
            $table->string('theme')->default('Explosion des couleurs');
            $table->text('program')->nullable();
            $table->foreignId('user_id')->constrained(); // Lien vers le compte du Marié
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
