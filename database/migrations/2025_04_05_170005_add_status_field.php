<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftars', function () {
            DB::statement("ALTER TABLE pendaftars ADD COLUMN status ENUM('diproses', 'ditolak', 'diterima', 'selesai') AFTER berkas_surat_komuni");
        });
    }
    
    public function down()
    {
        Schema::table('pendaftars', function () {
            DB::statement("ALTER TABLE pendaftars DROP COLUMN status");
        });
    }
};