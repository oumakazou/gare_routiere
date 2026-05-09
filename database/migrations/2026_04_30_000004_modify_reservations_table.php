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
            if (Schema::hasColumn('reservations', 'trajet_id')) {
                $foreignKeys = \DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'reservations' AND COLUMN_NAME = 'trajet_id' AND REFERENCED_TABLE_NAME IS NOT NULL");
                if (!empty($foreignKeys)) {
                    $table->dropForeign(['trajet_id']);
                }
                $table->dropColumn('trajet_id');
            }

            if (!Schema::hasColumn('reservations', 'voyage_id')) {
                $table->foreignId('voyage_id')->constrained()->cascadeOnDelete();
            }

            if (!Schema::hasColumn('reservations', 'seat_numbers')) {
                $table->json('seat_numbers')->nullable();
            }

            if (!Schema::hasColumn('reservations', 'mode_reglement_id')) {
                $table->foreignId('mode_reglement_id')->nullable()->constrained('mode_reglements')->restrictOnDelete();
            }

            if (!Schema::hasColumn('reservations', 'status')) {
                $table->enum('status', ['confirmee', 'en_attente', 'annulee'])->default('confirmee');
            }

            if (!Schema::hasColumn('reservations', 'total_price')) {
                $table->decimal('total_price', 10, 2)->default(0);
            }

            if (!Schema::hasColumn('reservations', 'heure_reservation')) {
                $table->time('heure_reservation')->nullable();
            }

            if (!Schema::hasColumn('reservations', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'voyage_id')) {
                $table->dropForeign(['voyage_id']);
                $table->dropColumn('voyage_id');
            }

            if (Schema::hasColumn('reservations', 'mode_reglement_id')) {
                $table->dropForeign(['mode_reglement_id']);
                $table->dropColumn('mode_reglement_id');
            }

            foreach (['seat_numbers', 'status', 'total_price', 'heure_reservation', 'notes'] as $column) {
                if (Schema::hasColumn('reservations', $column)) {
                    $table->dropColumn($column);
                }
            }

            if (!Schema::hasColumn('reservations', 'trajet_id')) {
                $table->foreignId('trajet_id')->constrained()->cascadeOnDelete();
            }
        });
    }
};