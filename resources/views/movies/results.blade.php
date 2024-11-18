<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results for "{{ $title ?? '' }}"</h1>
    
    @if (isset($error))
        <p>{{ $error }}</p>
    @elseif (isset($movies) && count($movies) > 0)
        <ul>
            @foreach ($movies as $movie)
                <li>
                    <strong>{{ $movie['Title'] }}</strong> ({{ $movie['Year'] }})
                    <br>
                    <img src="{{ $movie['Poster'] }}" alt="Poster" width="100">
                </li>
            @endforeach
        </ul>
    @else
        <p>No results found.</p>
    @endif

    <a href="{{ route('movies.search') }}">Back to Search</a>
</body>
</html>
