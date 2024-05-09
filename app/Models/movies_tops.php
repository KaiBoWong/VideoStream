<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movies_tops extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'overview', 'release_date', 'genre', 'backdrop_path', 'vote_average', 'poster_path', 'tmdb_id', 'media_type' ];
}
