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
        Schema::table('users', function (Blueprint $table) {
            // Drop is_admin if it exists
            if (Schema::hasColumn('users', 'is_admin')) {
                $table->dropColumn('is_admin');
            }
            // Add role column
            $table->string('role')->default('user')->after('mot_de_passe'); // Changed 'password' to 'mot_de_passe'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            // If you want to revert to is_admin, you might add it back here:
            // $table->boolean('is_admin')->default(false)->after('password');
        });
    }
};