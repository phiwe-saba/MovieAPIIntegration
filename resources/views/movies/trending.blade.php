<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trending Movies</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('movies.search') }}">Blockbuster</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.trending') }}">Trending Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.search') }}">Search Movies</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container my-5">
        <h1 class="text-center mb-4">Trending Movies</h1>

        @if (isset($error))
            <div class="alert alert-danger">
                <p>{{ $error }}</p>
            </div>
        @elseif (isset($movies) && count($movies) > 0)
            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $movie['Poster'] }}" class="card-img-top" alt="Movie Poster">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie['Title'] }}</h5>
                                <p class="card-text"><strong>Year:</strong> {{ $movie['Year'] }}</p>
                                <p class="card-text"><strong>Rating:</strong> {{ $movie['imdbRating'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination justify-content-center">
                {{ $movies->links() }}
            </div>
        @else
            <p>No trending movies available.</p>
        @endif
    </div>

</body>
</html>
