<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SakramenEvent extends Model
{
    protected $table = 'sakramen_events';
    protected $fillable = [
        'nama_event',
        'jenis_sakramen',
        'deskripsi',
        'tanggal_pelaksanaan',
        'tempat_pelaksanaan',
        'nama_romo',
        'tanggal_pendaftaran_dibuka',
        'tanggal_pendaftaran_ditutup',
        'kuota_pendaftar',
        'status',
    ];

    public function pendaftar()
    {
        return $this->hasMany(Pendaftars::class);
    }
}
