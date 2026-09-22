@extends('base')

@section('title', 'Rollen aan gebruikers koppelen')

@section('content')
    <p><a href="{{ route('games.index') }}">Terug naar Game Collection</a></p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user-roles.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="user_id">Gebruiker</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="">Kies een gebruiker</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="role_id">Rol</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    <option value="">Kies een rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success">Koppelen</button>
            </div>
        </div>
    </form>

    <h2>Huidige koppelingen</h2>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Gebruiker</th>
                <th>E-mail</th>
                <th>Rollen</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->join(', ') ?: 'Geen' }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <form action="{{ route('admin.user-roles.destroy', [$user, $role]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ $role->name }} verwijderen</button>
                            </form>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Er zijn nog geen gebruikers.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
