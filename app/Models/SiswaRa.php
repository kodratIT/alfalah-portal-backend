<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaRa extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'anak_ke',
        'jumlah_saudara',
        'alamat',
        'nama_ayah',
        'pekerjaan_ayah',
        'pendidikan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'pendidikan_ibu',
        'no_hp_wali',
        'foto',
    ];
}
