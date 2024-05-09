<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class full_movies extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'title', 'overview', 'release_date', 'genre', 'backdrop_path', 'vote_average', 'poster_path', 'media_type', 'tmdb_id' ];
}
