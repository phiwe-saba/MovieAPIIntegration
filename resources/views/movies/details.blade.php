<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
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
    <div class="container py-5">
        @if (isset($error))
            <div class="alert alert-danger" role="alert">
                <h1 class="display-6">Error</h1>
                <p>{{ $error }}</p>
            </div>
        @else
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="card-title">{{ $movie['Title'] }}</h1>
                    <p><strong>Release Date:</strong> {{ $movie['Released'] }}</p>
                    <p><strong>Rating:</strong> {{ $movie['imdbRating'] }}/10</p>
                    <p><strong>Plot Summary:</strong> {{ $movie['Plot'] }}</p>
                </div>
            </div>
        @endif
        <div class="mt-4">
            <a href="{{ route('movies.search') }}" class="btn btn-primary">Back to Search</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
