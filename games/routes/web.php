<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
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
        ->names('admin.permissions');
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
