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
        <h1 class="display-4">@yield('title')</h1>
        @auth
            @role('admin')
                <nav class="mb-4">
                    <a href="{{ route('admin.permissions.index') }}" class="mr-3">Permissies</a>
                    <a href="{{ route('admin.roles.index') }}" class="mr-3">Rollen</a>
                    <a href="{{ route('admin.role-permissions.index') }}" class="mr-3">Rol-permissies</a>
                    <a href="{{ route('admin.user-roles.index') }}">Gebruiker-rollen</a>
                </nav>
            @endrole
        @endauth
        @yield('content')
    </div>
</body>
</html>