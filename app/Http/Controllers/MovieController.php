<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $response = Http::get('http://www.omdbapi.com/', [
            'apiKey' => $apiKey,
            's' => $title, 's'
        ]);

        //dd($title, $apiKey, $response);

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

        return back()->withErrors('Failed to connect to the OMDB API.');
    }
}
