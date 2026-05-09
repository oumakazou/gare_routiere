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
            return;
        }

        Schema::table('voyages', function (Blueprint $table) {
            if (! Schema::hasColumn('voyages', 'transport_company_id')) {
                $table->foreignId('transport_company_id')->nullable()->after('id')->constrained('transport_companies')->nullOnDelete();
            }
            if (! Schema::hasColumn('voyages', 'line_name')) {
                $table->string('line_name')->nullable()->after('transport_company_id');
            }
            if (! Schema::hasColumn('voyages', 'destination')) {
                $table->string('destination')->nullable()->after('line_name');
            }
            if (! Schema::hasColumn('voyages', 'travel_date')) {
                $table->date('travel_date')->nullable()->after('destination');
            }
            if (! Schema::hasColumn('voyages', 'departure_time')) {
                $table->time('departure_time')->nullable()->after('travel_date');
            }
            if (! Schema::hasColumn('voyages', 'tickets')) {
                $table->unsignedInteger('tickets')->default(0)->after('departure_time');
            }
            if (! Schema::hasColumn('voyages', 'total_ttc')) {
                $table->decimal('total_ttc', 12, 2)->default(0)->after('tickets');
            }
            if (! Schema::hasColumn('voyages', 'observations')) {
                $table->text('observations')->nullable()->after('total_ttc');
            }
            if (! Schema::hasColumn('voyages', 'is_blocked')) {
                $table->boolean('is_blocked')->default(false)->after('observations');
            }
            if (! Schema::hasColumn('voyages', 'blocked_by')) {
                $table->string('blocked_by')->nullable()->after('is_blocked');
            }
            if (! Schema::hasColumn('voyages', 'created_by_name')) {
                $table->string('created_by_name')->nullable()->after('blocked_by');
            }
        });

        if (Schema::hasColumn('voyages', 'ville_arrivee')) {
            DB::table('voyages')
                ->whereNull('destination')
                ->whereNotNull('ville_arrivee')
                ->update(['destination' => DB::raw('ville_arrivee')]);
        }

        if (Schema::hasColumn('voyages', 'date_voyage')) {
            DB::table('voyages')
                ->whereNull('travel_date')
                ->whereNotNull('date_voyage')
                ->update(['travel_date' => DB::raw('date_voyage')]);
        }

        if (Schema::hasColumn('voyages', 'date_depart')) {
            DB::table('voyages')
                ->whereNull('travel_date')
                ->whereNotNull('date_depart')
                ->update(['travel_date' => DB::raw('date_depart')]);
        }

        if (Schema::hasColumn('voyages', 'heure_depart')) {
            DB::table('voyages')
                ->whereNull('departure_time')
                ->whereNotNull('heure_depart')
                ->update(['departure_time' => DB::raw('heure_depart')]);
        }

        if (Schema::hasColumn('voyages', 'places_disponibles')) {
            DB::table('voyages')
                ->where('tickets', 0)
                ->update(['tickets' => DB::raw('places_disponibles')]);
        }

        if (Schema::hasColumn('voyages', 'available_seats')) {
            DB::table('voyages')
                ->where('tickets', 0)
                ->update(['tickets' => DB::raw('available_seats')]);
        }

        if (Schema::hasColumn('voyages', 'prix')) {
            DB::table('voyages')
                ->where('total_ttc', 0)
                ->whereNotNull('prix')
                ->update(['total_ttc' => DB::raw('prix')]);
        }

        if (Schema::hasColumn('voyages', 'price')) {
            DB::table('voyages')
                ->where('total_ttc', 0)
                ->whereNotNull('price')
                ->update(['total_ttc' => DB::raw('price')]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('voyages')) {
            return;
        }

        Schema::table('voyages', function (Blueprint $table) {
            if (Schema::hasColumn('voyages', 'transport_company_id')) {
                $table->dropConstrainedForeignId('transport_company_id');
            }
            foreach (['line_name', 'destination', 'travel_date', 'departure_time', 'tickets', 'total_ttc', 'observations', 'is_blocked', 'blocked_by', 'created_by_name'] as $column) {
                if (Schema::hasColumn('voyages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
