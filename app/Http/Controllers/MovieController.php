<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;


class MovieController extends Controller
{
    //Search form
    public function index()
    {
        return view('movies.search');
    }

    //Search request
    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $title = $request->input('title');
        $apiKey = env('OMDB_API_KEY');

        try{
            $response = Http::get('http://www.omdbapi.com/', [
                'apiKey' => $apiKey,
                's' => $title, 's'
            ]);
    
            if ($response->successful()){
                $movies = $response->json();
    
                if (isset($movies['Search'])) 
                {
                    return view('movies.results', ['movies' => $movies['Search'], 'title' => $title]);
                } else
                {
                    return view('movies.results', ['error' => $movies['Error'] ?? 'No results found.']);
                }
            } 
        } catch (\Exception $e){
            return back()->withErrors("Error: " . $e->getMessage());
        }
    }

    //Movie details
    public function details($id)
    {
        $apiKey = env('OMDB_API_KEY');

        try{
            $response = Http::get('http://www.omdbapi.com/', [
                'apiKey' => $apiKey,
                'i' => $id
            ]);

            if ($response->successful()) 
            {
                $movie = $response->json();
                if ($movie['Response'] === 'True'){
                    return view('movies.details', ['movie' => $movie]);
                }else
                {
                    return view('movies.details', ['error' => $movie['Error'] ?? 'Movie details not found']);
                }
            }

            return back()->withErrors('Failed to connect to the OMDB API.');
        } catch (\Exception $e) {
            return back()->withErrors("Error: " . $e->getMessage());
        }
    }

    public function trending()
    {
        $apiKey = env('OMDB_API_KEY');

        if (!$apiKey) {
            return back()->withErrors('OMDB API Key is missing. Please check your .env configuration.');
        }

        try {
            // Cache the trending movies for 60 minutes
            $trendingMovies = Cache::remember('trending_movies', 60, function () use ($apiKey) {
                $moviesWithRatings = [];

                // Fetch multiple pages of results to avoid "Too many results"
                for ($page = 1; $page <= 5; $page++) { // Limit to 2 pages for demonstration
                    $response = Http::get('http://www.omdbapi.com/', [
                        'apikey' => $apiKey,
                        's' => 'movie', // Replace with a more specific keyword
                        'type' => 'movie',
                        'page' => $page,
                    ]);

                    //dd($response->json());
                    $movies = $response->json();

                    if (!isset($movies['Search'])) {
                        break; // Exit the loop if no results
                    }

                    foreach ($movies['Search'] as $movie) {
                        $movieDetails = Http::get('http://www.omdbapi.com/', [
                            'apikey' => $apiKey,
                            'i' => $movie['imdbID'],
                        ])->json();

                        if (isset($movieDetails['imdbRating']) && is_numeric($movieDetails['imdbRating'])) {
                            $movieDetails['imdbRating'] = (float) $movieDetails['imdbRating'];
                            $moviesWithRatings[] = $movieDetails;
                        }
                    }
                }

                // Sort movies by IMDb rating in descending order
                usort($moviesWithRatings, function ($a, $b) {
                    return $b['imdbRating'] <=> $a['imdbRating'];
                });

                return $moviesWithRatings;
            });

            if (empty($trendingMovies)) {
                return view('movies.trending', [
                    'error' => 'No trending movies available.',
                ]);
            }

            // Paginate results
            $perPage = 10;
            $currentPage = request()->input('page', 1);
            $offset = ($currentPage - 1) * $perPage;

            $paginatedMovies = new LengthAwarePaginator(
                array_slice($trendingMovies, $offset, $perPage),
                count($trendingMovies),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('movies.trending', [
                'movies' => $paginatedMovies,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors('Error connecting to OMDB API: ' . $e->getMessage());
        }
    }
}
