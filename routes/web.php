<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserRoleController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/books', [BookController::class, 'index'])
        ->middleware('can:buku.view')
        ->name('books.index');

    Route::get('/books/create', [BookController::class, 'create'])
        ->middleware('can:buku.create')
        ->name('books.create');

    Route::post('/books', [BookController::class, 'store'])
        ->middleware('can:buku.create')
        ->name('books.store');

    Route::get('/books/{book}/edit', [BookController::class, 'edit'])
        ->middleware('can:buku.update')
        ->name('books.edit');

    Route::put('/books/{book}', [BookController::class, 'update'])
        ->middleware('can:buku.update')
        ->name('books.update');

    Route::delete('/books/{book}', [BookController::class, 'destroy'])
        ->middleware('can:buku.delete')
        ->name('books.destroy');

    Route::get('/users/roles', [UserRoleController::class, 'index'])
        ->middleware('can:role.manage')
        ->name('users.roles');

    Route::put('/users/{user}/role', [UserRoleController::class, 'update'])
        ->middleware('can:role.manage')
        ->name('users.roles.update');
});

require __DIR__.'/auth.php';
