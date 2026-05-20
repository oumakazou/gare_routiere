<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ville_depart_id')->constrained('villes')->onDelete('cascade');
            $table->foreignId('ville_arrivee_id')->constrained('villes')->onDelete('cascade');
            $table->foreignId('societe_id')->constrained('societes')->onDelete('cascade');
            $table->foreignId('autocar_id')->constrained('autocars')->onDelete('cascade');
            $table->foreignId('type_voyage_id')->constrained('type_voyages')->onDelete('cascade');
            $table->decimal('price', 10, 2); // Price in MAD
            $table->dateTime('date_depart');
            $table->time('heure_depart');
            $table->time('heure_arrivee');
            $table->integer('available_seats');
            $table->boolean('is_special')->default(false);
            $table->decimal('base_price', 10, 2)->nullable();
            $table->string('departure_time')->nullable();
            $table->string('line_name')->nullable()->index();
            $table->text('observations')->nullable();
            $table->boolean('is_blocked')->default(false);
            $table->unsignedBigInteger('blocked_by')->nullable();
            $table->string('created_by_name')->nullable();
            $table->timestamps();

            $table->unique(['ville_depart_id', 'ville_arrivee_id', 'date_depart', 'heure_depart'], 'unique_voyage_route');
        });
    }
    public function down(): void { Schema::dropIfExists('voyages'); }
};