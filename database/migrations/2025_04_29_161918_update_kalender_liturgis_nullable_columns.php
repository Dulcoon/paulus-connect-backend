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
        Schema::table('kalender_liturgis', function (Blueprint $table) {
            $table->string('bacaan1')->nullable()->change(); // Ubah menjadi nullable
            $table->string('mazmur')->nullable()->change(); // Ubah menjadi nullable
            $table->string('bacaan_injil')->nullable()->change(); // Ubah menjadi nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kalender_liturgis', function (Blueprint $table) {
            $table->string('bacaan1')->nullable(false)->change(); // Kembalikan ke non-nullable
            $table->string('mazmur')->nullable(false)->change(); // Kembalikan ke non-nullable
            $table->string('bacaan_injil')->nullable(false)->change(); // Kembalikan ke non-nullable
        });
    }
};