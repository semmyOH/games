@extends('base')

@section('title', '🎮 Game Collection')

@section('content')
            @can('product invoeren')
                <a href="/games/create" class="btn btn-success mb-3">Add Game</a>
            @endcan

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Game</th>
                        <th>Platform</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Show</th>
                        @can('product aanpassen')
                            <th>Edit</th>
                        @endcan
                        @can('product verwijderen')
                            <th>Delete</th>
                        @endcan
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
                            <td>
                                @can('product aanpassen')
                                    <a href="/games/edit/{{ $game->id }}" class="btn btn-primary btn-sm">Edit</a>
                                @endcan
                            </td>
                            <td>
                                @can('product verwijderen')
                                    <form action="/games/delete/{{ $game->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('weet je zeker?')" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
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