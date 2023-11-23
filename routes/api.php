<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatalogController;
use App\Http\Controllers\APICatalogController;

Route::middleware('auth:sanctum')->group(function () {

    // Rutas de usuario
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog.show');
    Route::post('/catalog', [CatalogController::class, 'store'])->name('catalog.store');
    Route::put('/catalog/{id}', [CatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{id}', [CatalogController::class, 'destroy'])->name('catalog.delete');
    Route::put('/catalog/{id}/rent', [CatalogController::class, 'putRent'])->name('catalog.rent');
    Route::put('/catalog/{id}/return', [CatalogController::class, 'putReturn'])->name('catalog.return');

    Route::get('/catalog', [APICatalogController::class, 'index']);
    Route::get('/catalog/{id}', [APICatalogController::class, 'show']);
    Route::post('/catalog', [APICatalogController::class, 'store'])->middleware('auth.basic.once');
    Route::put('/catalog/{id}', [APICatalogController::class, 'update'])->middleware('auth.basic.once');
    Route::delete('/catalog/{id}', [APICatalogController::class, 'destroy'])->middleware('auth.basic.once');
    Route::delete('/catalog/{id}/rent', [APICatalogController::class, 'putRent'])->middleware('auth.basic.once');
    Route::delete('/catalog/{id}/return', [APICatalogController::class, 'putReturn'])->middleware('auth.basic.once');
});


