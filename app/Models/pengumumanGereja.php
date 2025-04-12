<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengumumanGereja extends Model
{
    protected $table = 'pengumuman_gerejas';
    protected $fillable = [
        'judul',
        'isi',
        'gambar', // Path file gambar
        'tanggal_pengumuman',
    ];
    protected $casts = [
        'tanggal_pengumuman' => 'date',
    ];
}
