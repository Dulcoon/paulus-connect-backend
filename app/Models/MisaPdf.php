<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisaPdf extends Model
{
    use HasFactory;

    protected $table = 'misa_pdfs';

    protected $fillable = [
        'judul',
        'tanggal',
        'file_path',
    ];
}