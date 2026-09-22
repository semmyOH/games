<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ingelogde klanten en admins mogen het overzicht bekijken.
Route::get('games', [GameController::class, 'index'])->middleware('auth')->name('games.index');

// Alleen admins mogen games toevoegen, bekijken, bewerken en verwijderen.
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('games/create', [GameController::class, 'create']);
    Route::post('games/store', [GameController::class, 'store']);
    Route::get('games/show/{id}', [GameController::class, 'showGame']);
    Route::get('games/edit/{id}', [GameController::class, 'edit']);
    Route::post('games/update/{id}', [GameController::class, 'update']);
    Route::delete('games/delete/{id}', [GameController::class, 'destroy']);

    Route::resource('admin/permissions', PermissionController::class)
        ->names('admin.permissions')
        ->except('show');
    Route::resource('admin/roles', RoleController::class)
        ->names('admin.roles')
        ->except('show');
    Route::get('admin/role-permissions', [RolePermissionController::class, 'index'])
        ->name('admin.role-permissions.index');
    Route::post('admin/role-permissions', [RolePermissionController::class, 'store'])
        ->name('admin.role-permissions.store');
    Route::delete('admin/role-permissions/{role}/{permission}', [RolePermissionController::class, 'destroy'])
        ->name('admin.role-permissions.destroy');
    Route::get('admin/user-roles', [UserRoleController::class, 'index'])
        ->name('admin.user-roles.index');
    Route::post('admin/user-roles', [UserRoleController::class, 'store'])
        ->name('admin.user-roles.store');
    Route::delete('admin/user-roles/{user}/{role}', [UserRoleController::class, 'destroy'])
        ->name('admin.user-roles.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');

require __DIR__.'/auth.php';
