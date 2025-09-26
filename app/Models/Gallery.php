<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'type',
        'video_url',
        'is_featured',
        'thumbnail',
    ];
}
