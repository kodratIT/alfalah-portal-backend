<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $fillable = [
        'nama_donatur',
        'nomor_hp',
        'email',
        'tanggal',
        'jenis_donasi',
        'jumlah',
        'metode_pembayaran',
        'keterangan',
    ];
}
