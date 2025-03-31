<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MovimientoController;

// Modelos
use App\Models\Producto;
use App\Models\Movimiento;

// Rutas principales
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios/guardar', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::post('/usuarios/actualizar/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::get('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('products.index');
Route::post('/productos/store', [ProductoController::class, 'store'])->name('products.store');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('products.edit');
Route::put('/productos/{id}/update', [ProductoController::class, 'update'])->name('products.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

// Proveedores
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('providers.index');
Route::post('/proveedores/store', [ProveedorController::class, 'store'])->name('providers.store');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('providers.edit');
Route::put('/proveedores/{id}/update', [ProveedorController::class, 'update'])->name('providers.update');
Route::delete('/proveedores/{id}/delete', [ProveedorController::class, 'destroy'])->name('providers.destroy');

// Categorías
Route::post('categorias/store', [CategoriaController::class, 'store'])->name('categories.store');
Route::get('categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categories.edit');
Route::put('categorias/{id}/update', [CategoriaController::class, 'update'])->name('categories.update');
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('categories.destroy');

// Inventario y movimientos
Route::get('/inventario', [MovimientoController::class, 'index'])->name('inventario.index');
Route::post('/inventario/actualizar', [MovimientoController::class, 'store'])->name('inventario.actualizar');
 