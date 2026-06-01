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
        Schema::table('weddings', function (Blueprint $table) {
            // --- Infos de base ---
            if (!Schema::hasColumn('weddings', 'contact_phone')) {
                $table->string('contact_phone')->after('user_id');
            }
            
            if (!Schema::hasColumn('weddings', 'guest_count_estimated')) {
                $table->integer('guest_count_estimated')->default(0)->after('contact_phone');
            }

            // --- 1. Mariage Coutumier (La Dot) ---
            if (!Schema::hasColumn('weddings', 'date_customary')) {
                $table->date('date_customary')->nullable();
            }
            if (!Schema::hasColumn('weddings', 'time_customary')) {
                $table->time('time_customary')->nullable();
            }

            // --- 2. Mariage Civil (La Commune) ---
            if (!Schema::hasColumn('weddings', 'date_civil')) {
                $table->date('date_civil')->nullable();
            }
            if (!Schema::hasColumn('weddings', 'time_civil')) {
                $table->time('time_civil')->nullable();
            }

            // --- 3. Mariage Religieux (L'Église) ---
            if (!Schema::hasColumn('weddings', 'date_religious')) {
                $table->date('date_religious')->nullable();
            }
            if (!Schema::hasColumn('weddings', 'time_religious')) {
                $table->time('time_religious')->nullable();
            }

            // --- 4. Soirée Dansante ---
            if (!Schema::hasColumn('weddings', 'reception_date')) {
                $table->date('reception_date')->nullable();
            }
            if (!Schema::hasColumn('weddings', 'reception_time')) {
                $table->time('reception_time')->nullable();
            }
            if (!Schema::hasColumn('weddings', 'reception_location')) {
                $table->string('reception_location')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_phone',
                'guest_count_estimated',
                'date_customary',
                'time_customary',
                'date_civil',
                'time_civil',
                'date_religious',
                'time_religious',
                'reception_date',
                'reception_time',
                'reception_location'
            ]);
        });
    }
};