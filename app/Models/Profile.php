<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'sejarah',
        'gambar_sejarah',
        'tahun_berdiri',
        'visi',
        'misi',
        'fasilitas',
        'pimpinan',
    ];

    protected $casts = [
        'misi' => 'array',
        'fasilitas' => 'array',
        'pimpinan' => 'array',
    ];
}
