<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'title',
        'overview',
        'release_date',
        'popularity',
        'vote_average',
        'vote_count',
        'original_language',
        'poster_path',
        'backdrop_path',
        'adult',
        'video',
        'user_id',
    ];
}
