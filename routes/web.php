<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios/guardar', [UsuarioController::class, 'store']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios/actualizar/{id}', [UsuarioController::class, 'update']);
Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy']);


Route::get('/products/show', [ProductosController::class, 'create']);
Route::get('/products/store', [ProductosController::class, 'store']);

Route::get('products', [ProductosController::class, 'index']);
Route::post('products/store', [ProductosController::class, 'store']);
Route::delete('products/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
Route::get('products/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');

// Rutas para las categorías
Route::get('categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::post('categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::delete('categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
Route::get('categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');

