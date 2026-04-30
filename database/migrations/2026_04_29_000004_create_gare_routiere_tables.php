<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::create('societes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('contact')->nullable();
            $table->timestamps();
        });

        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::create('type_voyages', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::create('mode_reglements', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->timestamps();
        });

        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('autocars', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->unsignedInteger('capacite');
            $table->enum('type', ['local', 'external'])->default('local');
            $table->foreignId('societe_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('autocar_equipements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('autocar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('equipement_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['autocar_id', 'equipement_id']);
        });

        Schema::create('autocar_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('autocar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('option_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['autocar_id', 'option_id']);
        });

        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ville_depart_id')->constrained('villes')->restrictOnDelete();
            $table->foreignId('ville_arrivee_id')->constrained('villes')->restrictOnDelete();
            $table->foreignId('autocar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_voyage_id')->constrained('type_voyages')->restrictOnDelete();
            $table->date('date_depart');
            $table->time('heure_depart');
            $table->time('heure_arrivee');
            $table->decimal('base_price', 10, 2);
            $table->boolean('is_special')->default(false);
            $table->timestamps();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('voyage_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('nombre_places');
            $table->json('seat_numbers');
            $table->foreignId('mode_reglement_id')->constrained('mode_reglements')->restrictOnDelete();
            $table->date('date_reservation');
            $table->enum('status', ['confirmee', 'en_attente', 'annulee'])->default('confirmee');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
            $table->index(['voyage_id', 'date_reservation']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('voyages');
        Schema::dropIfExists('autocar_options');
        Schema::dropIfExists('autocar_equipements');
        Schema::dropIfExists('autocars');
        Schema::dropIfExists('holidays');
        Schema::dropIfExists('mode_reglements');
        Schema::dropIfExists('type_voyages');
        Schema::dropIfExists('options');
        Schema::dropIfExists('equipements');
        Schema::dropIfExists('societes');
        Schema::dropIfExists('villes');
    }
};
