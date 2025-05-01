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
        Schema::create('kalender_liturgis', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Tanggal liturgi
            $table->string('title'); // Judul liturgi
            $table->string('warna_liturgi'); // Warna liturgi
            $table->string('bacaan1'); // Bacaan pertama
            $table->string('mazmur'); // Mazmur
            $table->string('bacaan2')->nullable(); // Bacaan kedua (nullable jika tidak selalu ada)
            $table->string('bait_pengantar')->nullable(); // Bait pengantar (nullable jika tidak selalu ada)
            $table->string('bacaan_injil'); // Bacaan Injil
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalender_liturgis');
    }
};