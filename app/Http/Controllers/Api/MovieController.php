<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');
        $apiKey = env('OMDB_API_KEY');

        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => $apiKey,
            's' => $query,
            'type' => 'movie',
        ]);

        return $response->json();
    }

    public function details($imdbID)
    {
        $apiKey = env('OMDB_API_KEY');

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => $apiKey,
            'i' => $imdbID,
        ]);

        return $response->json();
    }

    public function trending()
    {
        $apiKey = env('OMDB_API_KEY');

        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => $apiKey,
            's' => 'top',
            'type' => 'movie',
        ]);

        $movies = $response->json();

        if (isset($movies['Search'])) {
            $filteredMovies = array_filter($movies['Search'], function ($movie) use ($apiKey) {
                $details = Http::get('http://www.omdbapi.com/', [
                    'apikey' => $apiKey,
                    'i' => $movie['imdbID'],
                ])->json();

                return isset($details['imdbRating']) && $details['imdbRating'] >= 7;
            });

            return response()->json(['trending' => $filteredMovies]);
        }

        return response()->json(['error' => 'No trending movies found'], 404);
    }
}

