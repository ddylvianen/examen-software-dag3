<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VoorraadController;
use Illuminate\Support\Facades\Route;

// Role-based dashboards
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});

Route::get('/voorraad', [VoorraadController::class, 'index'])->name('voorraad.index');
Route::get('/voorraad/filter', [VoorraadController::class, 'ProductenPerCategorie'])->name('voorraad.ProductenPerCategorie');
Route::get('/voorraad/{id}/show', [VoorraadController::class, 'show'])->name('voorraad.show');
Route::get('/voorraad/{id}/edit', [VoorraadController::class, 'edit'])->name('voorraad.edit');
Route::put('/voorraad/{id}/update', [VoorraadController::class, 'update'])->name('voorraad.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'role:Manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
