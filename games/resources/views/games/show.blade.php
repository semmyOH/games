@extends('base')

@section('title', 'Show Game Details')

@section('content')
    <h1>{{ $game->game_name }}</h1>
    <p><strong>Platform:</strong> {{ $game->platform }}</p>
    <p><strong>Genre:</strong> {{ $game->genre }}</p>
    <p><strong>Rating:</strong> {{ $game->rating }}/10</p>
    <a href="/games" class="btn btn-secondary">Back to Game Collection</a>
@endsection
