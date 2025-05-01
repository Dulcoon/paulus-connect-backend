<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KalenderLiturgi extends Model
{
    use HasFactory;
    protected $table = 'kalender_liturgis';

    protected $fillable = [
        'date',
        'title',
        'warna_liturgi',
        'bacaan1',
        'mazmur',
        'bacaan2',
        'bait_pengantar',
        'bacaan_injil',
    ];
}