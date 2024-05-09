<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\movies_populars;

class ImportTMDBData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tmdb';

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
        $response = Http::get("https://api.themoviedb.org/3/movie/popular?api_key=410b1942b904a76040b5a2cc8597b339");
        $movies = $response->json()['results'];

        $genreMap = [
            28 => 'Action',
            12 => 'Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            99 => 'Documentary',
            18 => 'Drama',
            10751 => 'Family',
            14 => 'Fantasy',
            36 => 'History',
            27 => 'Horror',
            10402 => 'Music',
            9648 => 'Mystery',
            10749 => 'Romance',
            878 => 'Science Fiction',
            10770 => 'TV Movie',
            53 => 'Thriller',
            10752 => 'War',
            37 => 'Western'
        ];
        
        foreach ($movies as $movie) {

                // Check if genre_ids is an array
                if (is_array($movie['genre_ids'])) {
                    // If it's an array, map each genre ID to its corresponding name
                    $genres = array_map(function ($genreId) use ($genreMap) {
                        return $genreMap[$genreId] ?? null;
                    }, $movie['genre_ids']);

                    // Remove null values (IDs without corresponding names)
                    $genres = array_filter($genres);

                    // Convert the array of genre names to a comma-separated string
                    $genre = implode(', ', $genres);
                } else {
                    // If it's a single integer, look up the corresponding genre name
                    $genre = $genreMap[$movie['genre_ids']] ?? null;
                }

                $overview = substr($movie['overview'], 0, 255);

                movies_populars::create([
                    'tmdb_id' => $movie['id'],
                    'title' => $movie['title'],
                    'overview' => $overview,
                    'release_date' => $movie['release_date'],
                    'genre' => $genre,
                    'backdrop_path' => $movie['backdrop_path'],
                    'vote_average' => $movie['vote_average'],
                    'poster_path' => $movie['poster_path'],
                ]);
            
        }

        $this->info('Movies fetched and stored successfully!');
    
    }
}
