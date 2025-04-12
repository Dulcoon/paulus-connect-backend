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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('baptis_event_id'); // Relasi ke tabel baptis_events

            $table->string('nama_baptis');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('kecamatan');
            $table->text('kelurahan');
            $table->text('alamat_lengkap');
            $table->string('lingkungan');
            $table->string('nama_wali_baptis');
            $table->string('berkas_kk'); // Path file KK
            $table->string('berkas_akta_kelahiran'); // Path file Akta Kelahiran
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('baptis_event_id')->references('id')->on('baptis_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
