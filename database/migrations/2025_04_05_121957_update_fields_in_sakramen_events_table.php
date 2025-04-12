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
    Schema::table('sakramen_events', function (Blueprint $table) {
        // Mengubah nama field
        $table->renameColumn('nama_pendaftaran', 'nama_event');
        $table->renameColumn('nama_romo_pembaptis', 'nama_romo');

        // Menambahkan field baru
        $table->string('jenis_sakramen')->after('nama_event');
    });
}

public function down()
{
    Schema::table('sakramen_events', function (Blueprint $table) {
        // Mengembalikan perubahan
        $table->renameColumn('nama_event', 'nama_pendaftaran');
        $table->renameColumn('nama_romo', 'nama_romo_pembaptis');

        // Menghapus field baru
        $table->dropColumn('jenis_sakramen');
    });
}
};
