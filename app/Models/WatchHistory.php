<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchHistory extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'username', 'title', 'overview', 'release_date', 'genre', 'backdrop_path', 'vote_average', 'poster_path', 'media_type', 'tmdb_id', 'watched_at' ];

    public function watchHistory()
    {
        return $this->hasMany(WatchHistory::class);
    }
}
