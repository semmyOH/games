@extends('base')

@section('title', 'Rol bewerken')

@section('content')
    <p><a href="{{ route('admin.roles.index') }}">Terug naar rollen</a></p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Naam</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
@endsection
