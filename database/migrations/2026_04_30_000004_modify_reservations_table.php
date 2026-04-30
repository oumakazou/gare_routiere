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
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['voyage_id']);
            $table->dropColumn(['voyage_id', 'seat_numbers', 'prix_total', 'status', 'date_reservation', 'heure_reservation', 'mode_reglement_id', 'notes']);
            $table->foreignId('trajet_id')->constrained()->cascadeOnDelete();
            $table->date('date_reservation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['trajet_id']);
            $table->dropColumn(['trajet_id', 'date_reservation']);
            $table->foreignId('voyage_id')->constrained()->cascadeOnDelete();
            $table->json('seat_numbers');
            $table->decimal('prix_total', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->date('date_reservation');
            $table->time('heure_reservation');
            $table->foreignId('mode_reglement_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
        });
    }
};