<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MovieControllerUnitTest extends TestCase
{
    // Ensure you don't need to refresh the database if no database is involved
    use RefreshDatabase;

    /**
     * Test successful movie search response.
     *
     * @return void
     */
    public function test_movie_search_success()
    {
        // Mock a successful response from OMDB API
        Http::fake([
            'http://www.omdbapi.com/*' => Http::response([
                'Search' => [
                    [
                        'Title' => 'Inception',
                        'Year' => '2010',
                        'imdbID' => 'tt1375666',
                        'Poster' => 'https://example.com/poster.jpg',
                    ]
                ],
                'Response' => 'True'
            ], 200)
        ]);

        // Simulate a search request
        $response = $this->post('/movies/search', ['title' => 'Inception']);

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the movie title is displayed on the page
        $response->assertSee('Inception');
        $response->assertSee('2010');
    }

    /**
     * Test movie search failure (e.g., no results).
     *
     * @return void
     */
    public function test_movie_search_failure()
    {
        // Mock a failed response from OMDB API (no results found)
        Http::fake([
            'http://www.omdbapi.com/*' => Http::response([
                'Error' => 'Movie not found!',
                'Response' => 'False'
            ], 200)
        ]);

        // Simulate a search request
        $response = $this->post('/movies/search', ['title' => 'NonExistentMovie']);

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the error message is displayed
        $response->assertSee('No results found.');
    }

    /**
     * Test successful movie details response.
     *
     * @return void
     */
    public function test_movie_details_success()
    {
        // Mock a successful response for movie details from OMDB API
        Http::fake([
            'http://www.omdbapi.com/*' => Http::response([
                'Title' => 'Inception',
                'Released' => '16 Jul 2010',
                'imdbRating' => '8.8',
                'Plot' => 'A thief who steals corporate secrets...',
                'Genre' => 'Action, Sci-Fi',
                'Director' => 'Christopher Nolan',
                'Poster' => 'https://example.com/poster.jpg',
                'Response' => 'True'
            ], 200)
        ]);

        // Simulate a details request
        $response = $this->get('/movies/details/tt1375666');

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the movie details are displayed
        $response->assertSee('Inception');
        $response->assertSee('8.8');
        $response->assertSee('Christopher Nolan');
    }

    /**
     * Test movie details failure (e.g., invalid IMDb ID).
     *
     * @return void
     */
    public function test_movie_details_failure()
    {
        // Mock a failed response for movie details from OMDB API (invalid IMDb ID)
        Http::fake([
            'http://www.omdbapi.com/*' => Http::response([
                'Error' => 'Incorrect IMDb ID.',
                'Response' => 'False'
            ], 200)
        ]);

        // Simulate a details request
        $response = $this->get('/movies/details/invalidId');

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the error message is displayed
        $response->assertSee('Error');
        $response->assertSee('Incorrect IMDb ID.');
    }
}
