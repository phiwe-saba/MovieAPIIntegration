<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
</head>
<body>
    @if (isset($error))
        <h1>Error</h1>
        <p>{{ $error }}</p>
    @else
        <h1>{{ $movie['Title'] }}</h1>
        <p><strong>Release Date:</strong> {{ $movie['Released'] }}</p>
        <p><strong>Rating:</strong> {{ $movie['imdbRating'] }}/10</p>
        <p><strong>Plot Summary:</strong> {{ $movie['Plot'] }}</p>
        <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
        <p><strong>Director:</strong> {{ $movie['Director'] }}</p>

        <img src="{{ $movie['Poster'] }}" alt="Poster of {{ $movie['Title'] }}" style="width:200px;">
    @endif

    <a href="{{ route('movies.search') }}">Back to Search</a>
</body>
</html>
