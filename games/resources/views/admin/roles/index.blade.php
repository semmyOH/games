@extends('base')

@section('title', 'Rollen beheren')

@section('content')
    <p><a href="{{ route('games.index') }}">Terug naar Game Collection</a></p>
    <p><a href="{{ route('admin.roles.create') }}" class="btn btn-success">Nieuwe rol</a></p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Guard</th>
                <th>Permissies</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>{{ $role->permissions->pluck('name')->join(', ') ?: 'Geen' }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">Bewerken</a>
                        <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Er zijn nog geen rollen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
