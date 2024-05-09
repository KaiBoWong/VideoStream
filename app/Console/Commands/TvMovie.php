<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\tv_movies;

class TvMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tv:movie';

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
        $response = Http::get("https://api.themoviedb.org/3/trending/all/week?api_key=410b1942b904a76040b5a2cc8597b339");
        $totalpages = $response->json()['total_pages'];

        for ($page = 1; $page <= $totalpages; $page++) {

            $response = Http::get("https://api.themoviedb.org/3/trending/all/week?api_key=410b1942b904a76040b5a2cc8597b339&page=" . $page);
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

            foreach ($movies as $movie) {
                if ($movie['media_type'] === 'person') {
                    continue;
                } else {
                    // Determine which genre map to use based on media_type
                    $genreMapToUse = ($movie['media_type'] === 'tv') ? $genreMapTv : $genreMap;

                    // Check if genre_ids is an array
                    if (is_array($movie['genre_ids'])) {
                        // If it's an array, map each genre ID to its corresponding name
                        $genres = array_map(function ($genreId) use ($genreMapToUse) {
                            return $genreMapToUse[$genreId] ?? null;
                        }, $movie['genre_ids']);

                        // Remove null values (IDs without corresponding names)
                        $genres = array_filter($genres);

                        // Convert the array of genre names to a comma-separated string
                        $genre = implode(', ', $genres);
                    } else {
                        // If it's a single integer, look up the corresponding genre name
                        $genre = $genreMapToUse[$movie['genre_ids']] ?? null;
                    }

                    $titleOrName = $movie['media_type'] === 'tv' ? $movie['name'] : $movie['title'];
                    $firstOrrelease = $movie['media_type'] === 'tv' ? $movie['first_air_date'] : $movie['release_date'];
                    $overview = $movie['overview']; // No need to truncate
                    $releaseDate = $firstOrrelease ? $firstOrrelease : null;

                    tv_movies::create([
                        'tmdb_id' => $movie['id'],
                        'title' => $titleOrName,
                        'overview' => $overview,
                        'release_date' => $releaseDate,
                        'genre' => $genre,
                        'backdrop_path' => $movie['backdrop_path'],
                        'vote_average' => $movie['vote_average'],
                        'poster_path' => $movie['poster_path'],
                        'media_type' => $movie['media_type'],
                    ]);
                }
            }

            $totalMovies = tv_movies::count();
            $this->info("Movies fetched and stored successfully! Total movies: $totalMovies");
        }
    }
}
