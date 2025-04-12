<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model {
    use HasFactory;

    protected $table = 'wilayahs';
    protected $fillable = ['nama_wilayah', 'lingkungan'];

    public function userProfiles() {
        return $this->hasMany(UserProfile::class, 'kelurahan_id');
    }
}
