<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('misa_pdfs', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul teks misa
            $table->string('file_path'); // Path file PDF
            $table->date('tanggal'); // Tanggal misa
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('misa_pdfs');
    }
};
