<?php

namespace App\Http\Controllers;

use App\Models\tv_movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\movies_populars;
use App\Models\movies_tops;
use App\Models\pop_tvs;
use App\Models\top_tvs;
use Illuminate\Support\Facades\Auth;
use App\Models\WatchHistory;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve popular movies from the database
        $popularvideo = tv_movies::all();
        $Movies = tv_movies::where('media_type', 'movie')->get();
        $topmovies = tv_movies::where('media_type', 'movie')
            ->where('release_date', '<', '2019-01-01')
            ->orderBy('vote_average', 'desc')
            ->get();
        $poptv = tv_movies::where('media_type', 'tv')->get();
        $toptv = tv_movies::where('media_type', 'tv')
            ->whereBetween('release_date', ['1990-01-01', '2019-01-01'])
            ->where('vote_average', 8.5) // Make sure to use a number, not a string
            ->get();

        //dump($movie);

        // Pass the retrieved data to the view
        return view('movies.index', [
            'popularvideo' => $popularvideo,
            'Movies' => $Movies,
            'topmovies' => $topmovies,
            'poptv' => $poptv,
            'toptv' => $toptv,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=credits,videos,images')
            ->json();

        $similar = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=similar')
            ->json();

        $recommendations = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=recommendations')
            ->json();

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        //dump($similar);
        if (Auth::check()) {
            $user = Auth::user();
            $existingHistory = WatchHistory::where('username', $user->username)
                ->where('title', $movie['title'])
                ->first();
            // Assuming you handle genre information as a comma-separated string
            $genreNames = implode(', ', array_column($movie['genres'], 'name'));
            if ($existingHistory) {
                // Handle existing record
                $existingHistory->updated_at = now();
                $existingHistory->save();
            } else {
                WatchHistory::create([
                    'username' => $user->username,
                    'title' => $movie['title'],
                    'genre' => $genreNames,
                    'poster_path' => $movie['poster_path'],
                    'tmdb_id' => $id,
                    'media_type' => 'MOVIE',
                ]);
            }
        }

        return view('movies.show', [
            'movie' => $movie,
            'similar' => $similar,
            'recommendations' => $recommendations,
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
