<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('kecamatan_tempat_tinggal');
            $table->foreignId('kelurahan_id')->constrained('wilayah')->onDelete('cascade');
            $table->string('lingkungan')->nullable(); // Akan otomatis diisi
            $table->text('alamat_lengkap');
            
            // Sakramen
            $table->enum('sudah_baptis', ['sudah', 'belum'])->default('belum');
            $table->date('tanggal_baptis')->nullable();
            $table->string('tempat_baptis')->nullable();

            $table->enum('sudah_komuni', ['sudah', 'belum'])->default('belum');
            $table->date('tanggal_komuni')->nullable();
            $table->string('tempat_komuni')->nullable();

            $table->enum('sudah_krisma', ['sudah', 'belum'])->default('belum');
            $table->date('tanggal_krisma')->nullable();
            $table->string('tempat_krisma')->nullable();

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('user_profiles');
    }
};
