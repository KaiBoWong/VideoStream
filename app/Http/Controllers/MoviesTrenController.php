<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;
use App\Models\WatchHistory;

class MoviesTrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        $genresArraytv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list')
            ->json()['genres'];

        $genrestv = collect($genresArraytv)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });


        //dump($filterFantasy);


        return view('trending\index', [
            'genres' => $genres,
            'genrestv' => $genrestv,
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
        $Trendmovie = Http::withToken(config('services.tmdb.token'))
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


        //dump($Trendmovie );
        if (Auth::check()) {
            $user = Auth::user();
            $existingHistory = WatchHistory::where('username', $user->username)
                ->where('title', $Trendmovie['title'])
                ->first();
            // Assuming you handle genre information as a comma-separated string
            $genreNames = implode(', ', array_column($Trendmovie['genres'], 'name'));
            if ($existingHistory) {
                // Handle existing record
                $existingHistory->updated_at = now();
                $existingHistory->save();
            } else {
                WatchHistory::create([
                    'username' => $user->username,
                    'title' => $Trendmovie['title'],
                    'genre' => $genreNames,
                    'poster_path' => $Trendmovie['poster_path'],
                    'tmdb_id' => $id,
                    'media_type' => 'MOVIE',
                ]);
            }
        }

        return view('trending\show', [
            'Trendmovie' => $Trendmovie,
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
