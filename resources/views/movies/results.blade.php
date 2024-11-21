<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
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
        <h1 class="text-center mb-4">Search Results for "{{ $title ?? '' }}"</h1>
        
        @if (isset($error))
            <div class="alert alert-danger">
                <p>{{ $error }}</p>
            </div>
        @elseif (isset($movies) && count($movies) > 0)
            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ $movie['Poster'] }}" class="card-img-top" alt="Movie Poster" width="20">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('movies.details', ['id' => $movie['imdbID']]) }}">
                                        {{ $movie['Title'] }} ({{ $movie['Year'] }})
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination justify-content-center">
                
            </div>
        @else
            <p>No results found.</p>
        @endif

        <a href="{{ route('movies.search') }}" class="btn btn-secondary mt-4">Back to Search</a>
    </div>

    <!-- Optional: Add Bootstrap JS and Popper.js for further interactivity -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
