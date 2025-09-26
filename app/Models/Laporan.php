<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
        protected $fillable = [
        'judul',
        'tanggal',
        'kategori',
        'deskripsi',
        'file_lampiran',
    ];
}
