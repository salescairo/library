<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::middleware('auth')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::get('/', [App\Http\Controllers\AppController::class, 'home'])->name('home');
            Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
            Route::resource('/editoras', \App\Http\Controllers\BrandController::class)->names('brand');
            Route::resource('/generos', \App\Http\Controllers\GenderController::class)->names('gender');
            Route::resource('/livros', \App\Http\Controllers\BookController::class)->names('book');
            Route::get('/livros/{id}/alugar', [\App\Http\Controllers\BookController::class, 'rentCreate'])->name('book.rent.create');
            Route::post('/livros/{id}/alugar', [\App\Http\Controllers\BookController::class, 'rentStore'])->name('book.rent.store');
            Route::put('/livros/{id}/devolver', [\App\Http\Controllers\BookController::class, 'return'])->name('book.return');

            Route::get('/livros/{id}/reservar', [\App\Http\Controllers\BookController::class, 'reserveCreate'])->name('book.reserve.create');
            Route::put('/livros/{id}/reservar', [\App\Http\Controllers\BookController::class, 'reserve'])->name('book.reserve');
            Route::put('/livros/{id}/remover-reserva', [\App\Http\Controllers\BookController::class, 'unreserve'])->name('book.unreserve');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
