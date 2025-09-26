<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'nama',
        'peran',
        'angkatan',
        'testimoni',
        'foto',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
