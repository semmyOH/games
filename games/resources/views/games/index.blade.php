<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Game Collection</title>
</head>
<body>
    <div class="container" style="margin:40px;">
        @extends('base')
        @section('title', '🎮 Game Collection')
        @section('content')
            <a href="/games/create" class="btn btn-success mb-3">Add Game</a>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>Platform</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game) {{-- in deze loop worden alle rijen (records) gemaakt die in de database zijn gevonden. --}}
                        <tr>
                            <td>{{ $game->id }}</td>
                            <td>{{ $game->game_name }}</td>
                            <td>{{ $game->platform }}</td>
                            <td>{{ $game->genre }}</td>
                            <td>{{ $game->rating }}/10</td> 
                            <td><a href="/games/show/{{ $game->id }}" class="btn btn-info btn-sm">Show</a></td>
                            <td><a href="/games/edit/{{ $game->id }}" class="btn btn-primary btn-sm">Edit</a></td>
                            <td>
                                <form action="/games/delete/{{ $game->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('weet je zeker?')" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @php( $sum = 0)
                @foreach($games as $game)
                    @php( $sum += $game->rating)
                @endforeach
                <tfoot>
                    <tr>
                        <th colspan="4" style="text-align: right;">gemiddelde rating:</th>
                        <th>{{ number_format($sum / max(count($games), 1), 1) }}/10</th>
                    </tr>
                </tfoot>
            </table>
        @endsection
        </div>
    </body>
</html>