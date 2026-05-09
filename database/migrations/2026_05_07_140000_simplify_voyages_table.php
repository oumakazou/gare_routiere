<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('voyages')) {
            Schema::create('voyages', function (Blueprint $table) {
                $table->id();
                $table->string('ville_depart')->default('Taza');
                $table->string('ville_arrivee');
                $table->date('date_voyage')->nullable();
                $table->decimal('prix', 8, 2)->nullable();
                $table->unsignedInteger('places_disponibles')->default(0);
                $table->timestamps();
            });

            return;
        }

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                  AND TABLE_NAME = 'voyages'
                  AND REFERENCED_TABLE_NAME IS NOT NULL
                  AND COLUMN_NAME IN ('ville_depart_id','ville_arrivee_id','autocar_id','type_voyage_id')
            ");
            foreach ($foreignKeys as $foreignKey) {
                $constraint = $foreignKey->CONSTRAINT_NAME ?? null;
                if ($constraint) {
                    DB::statement("ALTER TABLE voyages DROP FOREIGN KEY `{$constraint}`");
                }
            }
        }

        $columnsToDrop = array_values(array_filter([
            Schema::hasColumn('voyages', 'ville_depart_id') ? 'ville_depart_id' : null,
            Schema::hasColumn('voyages', 'ville_arrivee_id') ? 'ville_arrivee_id' : null,
            Schema::hasColumn('voyages', 'autocar_id') ? 'autocar_id' : null,
            Schema::hasColumn('voyages', 'type_voyage_id') ? 'type_voyage_id' : null,
            Schema::hasColumn('voyages', 'date_depart') ? 'date_depart' : null,
            Schema::hasColumn('voyages', 'heure_depart') ? 'heure_depart' : null,
            Schema::hasColumn('voyages', 'heure_arrivee') ? 'heure_arrivee' : null,
            Schema::hasColumn('voyages', 'base_price') ? 'base_price' : null,
            Schema::hasColumn('voyages', 'price') ? 'price' : null,
            Schema::hasColumn('voyages', 'available_seats') ? 'available_seats' : null,
            Schema::hasColumn('voyages', 'is_special') ? 'is_special' : null,
            Schema::hasColumn('voyages', 'image') ? 'image' : null,
            Schema::hasColumn('voyages', 'description') ? 'description' : null,
        ]));

        if ($columnsToDrop !== []) {
            Schema::table('voyages', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }

        Schema::table('voyages', function (Blueprint $table) {
            if (! Schema::hasColumn('voyages', 'ville_depart')) {
                $table->string('ville_depart')->default('Taza')->after('id');
            }

            if (! Schema::hasColumn('voyages', 'ville_arrivee')) {
                $table->string('ville_arrivee')->after('ville_depart');
            }

            if (! Schema::hasColumn('voyages', 'date_voyage')) {
                $table->date('date_voyage')->nullable()->after('ville_arrivee');
            }

            if (! Schema::hasColumn('voyages', 'prix')) {
                $table->decimal('prix', 8, 2)->nullable()->after('date_voyage');
            }

            if (! Schema::hasColumn('voyages', 'places_disponibles')) {
                $table->unsignedInteger('places_disponibles')->after('prix');
            }
        });

        if (Schema::getConnection()->getDriverName() !== 'sqlite') {
            Schema::table('voyages', function (Blueprint $table) {
                $table->string('ville_depart')->default('Taza')->change();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
