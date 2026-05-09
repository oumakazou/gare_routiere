<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $shouldAddPrice = ! Schema::hasColumn('voyages', 'price');
        $shouldAddAvailableSeats = ! Schema::hasColumn('voyages', 'available_seats');

        if ($shouldAddPrice || $shouldAddAvailableSeats) {
            Schema::table('voyages', function (Blueprint $table) use ($shouldAddPrice, $shouldAddAvailableSeats) {
                if ($shouldAddPrice) {
                    $table->decimal('price', 10, 2)->nullable()->after('base_price');
                }

                if ($shouldAddAvailableSeats) {
                    $table->unsignedInteger('available_seats')->nullable()->after('price');
                }
            });
        }

        $autocarCapacities = DB::table('autocars')
            ->pluck('capacite', 'id');

        DB::table('voyages')
            ->select(['id', 'autocar_id', 'base_price', 'is_special', 'price', 'available_seats'])
            ->orderBy('id')
            ->get()
            ->each(function ($voyage) use ($autocarCapacities) {
                $updates = [];

                if ($voyage->price === null) {
                    $basePrice = (float) ($voyage->base_price ?? 0);
                    $updates['price'] = $voyage->is_special
                        ? round($basePrice * 1.3, 2)
                        : $basePrice;
                }

                if ($voyage->available_seats === null) {
                    $updates['available_seats'] = (int) ($autocarCapacities[$voyage->autocar_id] ?? 0);
                }

                if ($updates !== []) {
                    DB::table('voyages')
                        ->where('id', $voyage->id)
                        ->update($updates);
                }
            });
    }

    public function down(): void
    {
        $shouldDropPrice = Schema::hasColumn('voyages', 'price');
        $shouldDropAvailableSeats = Schema::hasColumn('voyages', 'available_seats');

        if ($shouldDropPrice || $shouldDropAvailableSeats) {
            Schema::table('voyages', function (Blueprint $table) use ($shouldDropPrice, $shouldDropAvailableSeats) {
                if ($shouldDropAvailableSeats) {
                    $table->dropColumn('available_seats');
                }

                if ($shouldDropPrice) {
                    $table->dropColumn('price');
                }
            });
        }
    }
};
