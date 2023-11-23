<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->action([CatalogController::class, 'getIndex']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/catalog', [CatalogController::class, 'getIndex'])->name('catalog.index');
    Route::get('/catalog/show/{id}',[CatalogController::class, 'getShow'])->name('catalog.show');
    Route::get('/catalog/create',[CatalogController::class, 'getCreate'])->name('catalog.create');
    Route::get('/catalog/edit/{id}',[CatalogController::class, 'getEdit'])->name('catalog.edit');
    Route::post('/catalog/create', [CatalogController::class, 'postCreate'])->name('catalog.store');
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit'])->name('catalog.update');

     // Rutas para alquilar, devolver y eliminar películas
     Route::put('/catalog/rent/{id}', [CatalogController::class, 'putRent'])->name('catalog.rent');
     Route::put('/catalog/return/{id}', [CatalogController::class, 'putReturn'])->name('catalog.return');
     Route::delete('/catalog/delete/{id}', [CatalogController::class, 'deleteMovie'])->name('catalog.delete');
});

require __DIR__.'/auth.php';
