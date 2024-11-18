<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search</title>
</head>
<body>
    <h1>Search for a Movie</h1>
    <form action="{{ route('movies.search.results') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Movie Title:</label>
        <input type="text" id="title" name="title" required>
        <button type="submit">Search</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
