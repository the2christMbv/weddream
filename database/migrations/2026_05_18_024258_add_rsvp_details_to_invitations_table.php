<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            // Status : en_attente, confirme, decline
            $table->string('rsvp_status')->default('en_attente');
            $table->text('decline_reason')->nullable();
            $table->string('preorder_drink')->nullable();
            $table->text('wedding_wish')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['rsvp_status', 'decline_reason', 'preorder_drink', 'wedding_wish']);
        });
    }
};