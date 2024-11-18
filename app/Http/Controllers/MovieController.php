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

        //return back()->withErrors('Failed to connect to the OMDB API.');
    }

    //Movie details
    public function details($id)
    {
        //dd("reach details");
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
}
