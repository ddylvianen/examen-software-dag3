<?php

use App\Http\Controllers\Voedselpakket\VoedselpakketController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:Vrijwilliger'])
    ->prefix('voedselpakketten')
    ->name('voedselpakketten.')
    ->group(function () {
        // Wireframe-02: Overzicht gezinnen met voedselpakketten (met eetwens filter)
        Route::get('/', [VoedselpakketController::class, 'gezinnenIndex'])
            ->name('gezinnen.index');

        // Wireframe-03: Overzicht Voedselpakketten (details per gezin)
        Route::get('/gezinnen/{gezinId}', [VoedselpakketController::class, 'pakkettenIndex'])
            ->whereNumber('gezinId')
            ->name('gezinnen.pakketten.index');

        // Wireframe-04/05/06: Wijzig voedselpakket status
        Route::get('/pakketten/{voedselpakketId}/edit', [VoedselpakketController::class, 'edit'])
            ->whereNumber('voedselpakketId')
            ->name('pakketten.edit');

        Route::patch('/pakketten/{voedselpakketId}', [VoedselpakketController::class, 'update'])
            ->whereNumber('voedselpakketId')
            ->name('pakketten.update');
    });

