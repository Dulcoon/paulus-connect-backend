<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftars extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sakramen_event_id',
        'jenis_sakramen',
        'nama_baptis',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'lingkungan',
        'status',
        'alasan',
        'nama_wali_baptis',
        'berkas_kk',
        'berkas_akta_kelahiran',
        'berkas_surat_baptis',
        'berkas_surat_komuni',
    ];

    public function sakramenEvent()
    {
        return $this->belongsTo(SakramenEvent::class);
    }

    public static function checkUserRegistration($userId, $sakramenEventId)
    {
        return self::where('user_id', $userId)
            ->where('sakramen_event_id', $sakramenEventId)
            ->first(['id', 'status', 'alasan']);
    }
}
