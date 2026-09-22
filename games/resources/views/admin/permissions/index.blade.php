@extends('base')

@section('title', 'Permissies beheren')

@section('content')
    <p><a href="{{ route('games.index') }}">Terug naar Game Collection</a></p>
    <p><a href="{{ route('admin.permissions.create') }}" class="btn btn-success">Nieuwe permissie</a></p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Guard</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary btn-sm">Bewerken</a>
                        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Er zijn nog geen permissies.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
