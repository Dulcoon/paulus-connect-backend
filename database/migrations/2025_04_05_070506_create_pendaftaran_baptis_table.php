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
        Schema::create('baptis_events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pendaftaran'); // contoh: "Pendaftaran Baptis April 2025"
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_pelaksanaan');
            $table->string('tempat_pelaksanaan'); 
            $table->string('nama_romo_pembaptis'); 
            $table->date('tanggal_pendaftaran_dibuka');
            $table->date('tanggal_pendaftaran_ditutup');
            $table->integer('kuota_pendaftar')->default(0); // jumlah maksimal pendaftar

            $table->enum('status', ['opened', 'closed'])->default('opened'); // status pendaftaran
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptis_event');
    }
};
