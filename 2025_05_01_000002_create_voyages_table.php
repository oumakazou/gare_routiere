<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->string('departure_city')->default('Casablanca'); // Fixed Departure City
            $table->string('destination');
            $table->decimal('price', 8, 2);
            $table->dateTime('departure_date');
            $table->string('transport_type')->default('Normal Car'); // Only Normal Car
            $table->foreignId('transport_company_id')->constrained('transport_companies')->onDelete('cascade');
            $table->integer('available_seats')->default(4);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('voyages'); }
};