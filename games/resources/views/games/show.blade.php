<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Game Details</title>
</head>
<body>
    <div class="container" style="margin:40px;">
        @extends('base')
        @section('title', 'Show Game Details')
        @section('content')
            <h1>{{ $game->game_name }}</h1>
            <p><strong>Platform:</strong> {{ $game->platform }}</p>
            <p><strong>Genre:</strong> {{ $game->genre }}</p>
            <p><strong>Rating:</strong> {{ $game->rating }}/10</p>
            <a href="/games" class="btn btn-secondary">Back to Game Collection</a>
        @endsection
    </div>
</body>
</html>
