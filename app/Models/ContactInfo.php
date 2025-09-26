<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'alamat',
        'telepon_kantor',
        'telepon_hp',
        'telepon_wa',
        'emails',
        'jam_kerja_senin_jumat',
        'jam_kerja_sabtu',
        'jam_kerja_minggu',
    ];

    protected $casts = [
        'emails' => 'array',
    ];
}
