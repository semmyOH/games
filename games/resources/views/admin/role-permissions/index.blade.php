@extends('base')

@section('title', 'Permissies aan rollen koppelen')

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

    <form action="{{ route('admin.role-permissions.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="role_id">Rol</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    <option value="">Kies een rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="permission_id">Permissie</label>
                <select id="permission_id" name="permission_id" class="form-control" required>
                    <option value="">Kies een permissie</option>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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
                <th>Rol</th>
                <th>Permissie</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                @forelse ($role->permissions as $permission)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <form action="{{ route('admin.role-permissions.destroy', [$role, $permission]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Ontkoppelen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
            @empty
                <tr>
                    <td colspan="3">Er zijn nog geen rollen.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
