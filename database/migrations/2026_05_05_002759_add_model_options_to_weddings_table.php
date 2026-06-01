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
            // On vérifie chaque colonne individuellement
            if (!Schema::hasColumn('weddings', 'model_premium')) {
                $table->string('model_premium')->nullable();
            }
            
            if (!Schema::hasColumn('weddings', 'model_vip')) {
                $table->string('model_vip')->nullable();
            }
            
            if (!Schema::hasColumn('weddings', 'model_group')) {
                $table->string('model_group')->nullable();
            }
            
            if (!Schema::hasColumn('weddings', 'cover_photo')) {
                $table->string('cover_photo')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weddings', function (Blueprint $table) {
            $table->dropColumn(['model_premium', 'model_vip', 'model_group', 'cover_photo']);
        });
    }
};