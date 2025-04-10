<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'nama_ayah',
        'nama_ibu',
        'tempat_lahir',
        'tanggal_lahir',
        'kelamin',
        'kecamatan_tempat_tinggal',
        'kelurahan_id',
        'lingkungan',
        'alamat_lengkap',
        'sudah_baptis', 'tanggal_baptis', 'tempat_baptis',
        'sudah_komuni', 'tanggal_komuni', 'tempat_komuni',
        'sudah_krisma', 'tanggal_krisma', 'tempat_krisma'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function wilayah() {
        return $this->belongsTo(Wilayah::class, 'kelurahan_id');
    }
}
