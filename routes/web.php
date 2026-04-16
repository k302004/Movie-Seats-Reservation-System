<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('movies.index');
});

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/shows/{show}/seats', [ShowController::class, 'selectSeats'])->name('shows.seats');
Route::get('/api/shows/{show}/availability', [ReservationController::class, 'checkAvailability']);

Route::get('/reservations/lookup', [ReservationController::class, 'index'])->name('reservations.lookup');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{confirmationCode}', [ReservationController::class, 'show'])->name('reservations.show');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/movies', [AdminController::class, 'movies'])->name('movies');
    Route::get('/movies/create', [AdminController::class, 'createMovie'])->name('movies.create');
    Route::post('/movies', [AdminController::class, 'storeMovie'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [AdminController::class, 'editMovie'])->name('movies.edit');
    Route::put('/movies/{movie}', [AdminController::class, 'updateMovie'])->name('movies.update');
    Route::delete('/movies/{movie}', [AdminController::class, 'destroyMovie'])->name('movies.destroy');
    
    Route::get('/shows', [AdminController::class, 'shows'])->name('shows');
    Route::get('/shows/create', [AdminController::class, 'createShow'])->name('shows.create');
    Route::post('/shows', [AdminController::class, 'storeShow'])->name('shows.store');
    Route::delete('/shows/{show}', [AdminController::class, 'destroyShow'])->name('shows.destroy');
    
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations');
    Route::get('/reservations/{confirmationCode}', [AdminController::class, 'showReservation'])->name('reservations.show');
    Route::delete('/reservations/{reservation}', [AdminController::class, 'destroyReservation'])->name('reservations.destroy');
});
