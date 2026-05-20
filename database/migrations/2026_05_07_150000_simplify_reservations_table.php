<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('reservations');
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('voyage_id')->constrained('voyages')->cascadeOnDelete();
                $table->string('client_name');
                $table->string('client_phone', 30);
                $table->timestamp('created_at')->useCurrent();
            });
            Schema::enableForeignKeyConstraints();
            return;
        }

        if (! Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('voyage_id')->constrained('voyages')->cascadeOnDelete();
                $table->string('client_name');
                $table->string('client_phone', 30);
                $table->timestamp('created_at')->useCurrent();
            });

            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                  AND TABLE_NAME = 'reservations'
                  AND REFERENCED_TABLE_NAME IS NOT NULL
            ");
            foreach ($foreignKeys as $foreignKey) {
                $constraint = $foreignKey->CONSTRAINT_NAME ?? null;
                if ($constraint) {
                    DB::statement("ALTER TABLE reservations DROP FOREIGN KEY `{$constraint}`");
                }
            }
        }

        $columnsToDrop = array_values(array_filter([
            Schema::hasColumn('reservations', 'user_id') ? 'user_id' : null,
            Schema::hasColumn('reservations', 'trajet_id') ? 'trajet_id' : null,
            Schema::hasColumn('reservations', 'nombre_places') ? 'nombre_places' : null,
            Schema::hasColumn('reservations', 'seat_numbers') ? 'seat_numbers' : null,
            Schema::hasColumn('reservations', 'mode_reglement_id') ? 'mode_reglement_id' : null,
            Schema::hasColumn('reservations', 'date_reservation') ? 'date_reservation' : null,
            Schema::hasColumn('reservations', 'status') ? 'status' : null,
            Schema::hasColumn('reservations', 'total_price') ? 'total_price' : null,
            Schema::hasColumn('reservations', 'payment_status') ? 'payment_status' : null,
            Schema::hasColumn('reservations', 'heure_reservation') ? 'heure_reservation' : null,
            Schema::hasColumn('reservations', 'notes') ? 'notes' : null,
            Schema::hasColumn('reservations', 'updated_at') ? 'updated_at' : null,
        ]));

        if ($columnsToDrop !== []) {
            Schema::table('reservations', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }

        Schema::table('reservations', function (Blueprint $table) {
            if (! Schema::hasColumn('reservations', 'voyage_id')) {
                $table->foreignId('voyage_id')->after('id');
            }
            if (! Schema::hasColumn('reservations', 'client_name')) {
                $table->string('client_name')->after('voyage_id');
            }
            if (! Schema::hasColumn('reservations', 'client_phone')) {
                $table->string('client_phone', 30)->after('client_name');
            }
            if (! Schema::hasColumn('reservations', 'created_at')) {
                $table->timestamp('created_at')->useCurrent()->after('client_phone');
            }
        });

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            Schema::table('reservations', function (Blueprint $table) {
                $table->foreign('voyage_id')->references('id')->on('voyages')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
