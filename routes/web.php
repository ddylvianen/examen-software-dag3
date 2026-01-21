<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VoorraadController;
use App\Http\Controllers\LeverancierController;
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

    // Leveranciers routes (toegankelijk voor Manager en Medewerker)
    Route::middleware(['role:Manager,Medewerker'])->group(function () {
        Route::get('/leveranciers', [LeverancierController::class, 'index'])->name('leveranciers.index');
        Route::get('/leveranciers/{id}', [LeverancierController::class, 'show'])->name('leveranciers.show');
    });

    // Leveranciers update routes (alleen Manager)
    Route::middleware(['role:Manager'])->group(function () {
        Route::get('/leveranciers/{id}/update-product', [LeverancierController::class, 'edit'])->name('leveranciers.update.form');
        Route::post('/leveranciers/update-product', [LeverancierController::class, 'updateProduct'])->name('leveranciers.update');
    });
});

// Admin routes
Route::middleware(['auth', 'role:Manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__ . '/voedselpakketten.php';
require __DIR__ . '/auth.php';
