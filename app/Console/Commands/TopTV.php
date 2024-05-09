<?php

namespace App\Console\Commands;

use App\Models\top_tvs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TopTV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top:tv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get("https://api.themoviedb.org/3/tv/top_rated?api_key=410b1942b904a76040b5a2cc8597b339");
        $tvshows = $response->json()['results'];

        $genreMapTv = [
            10759 => 'Action & Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            99 => 'Documentary',
            18 => 'Drama',
            10751 => 'Family',
            10762 => 'Kids',
            9648 => 'Mystery',
            10763 => 'News',
            10764 => 'Reality',
            10765 => 'Sci-Fi & Fantasy',
            10766 => 'Soap',
            10767 => 'Talk',
            10768 => 'War & Politics',
            37 => 'Western',
        ];

        foreach ($tvshows as $tvshows) {
            // Check if genre_ids is an array
            if (is_array($tvshows['genre_ids'])) {
                // If it's an array, map each genre ID to its corresponding name
                $genres = array_map(function ($genreId) use ($genreMapTv) {
                    return $genreMapTv[$genreId] ?? null;
                }, $tvshows['genre_ids']);

                // Remove null values (IDs without corresponding names)
                $genres = array_filter($genres);

                // Convert the array of genre names to a comma-separated string
                $genre = implode(', ', $genres);
            } else {
                // If it's a single integer, look up the corresponding genre name
                $genre = $genreMapTv[$tvshows['genre_ids']] ?? null;
            }

            $overview = substr($tvshows['overview'], 0, 255);

            top_tvs::create([
                'tmdb_id' => $tvshows['id'],
                'title' => $tvshows['name'],
                'overview' => $overview,
                'release_date' => $tvshows['first_air_date'],
                'genre' => $genre,
                'backdrop_path' => $tvshows['backdrop_path'],
                'vote_average' => $tvshows['vote_average'],
                'poster_path' => $tvshows['poster_path'],
            ]);
        }

        $this->info('Movies fetched and stored successfully!');
    }
}
