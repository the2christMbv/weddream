<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('wedding_programs', function (Blueprint $table) {
            $table->id();
            // Lien avec le mariage (ID du marié/projet)
            $table->foreignId('wedding_id')->constrained()->onDelete('cascade');
            
            // Détails de l'étape
            $table->string('type'); // coutumier, civil, religieux, soiree
            $table->date('event_date');
            $table->time('event_time');
            $table->string('venue_name');
            $table->string('venue_address')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('wedding_programs');
    }
};