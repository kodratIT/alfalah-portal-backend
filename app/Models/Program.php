<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori_usia',
        'jumlah_santri',
        'kategori',
        'gambar',
        'keunggulan',
        'jadwal',
    ];

    protected $casts = [
        'keunggulan' => 'array',
        'jadwal' => 'array',
    ];
}