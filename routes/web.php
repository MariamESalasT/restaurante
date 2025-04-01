<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.register.store');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/crear', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/guardar', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/actualizar/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');


Route::get('/productos', [ProductoController::class, 'index'])->name('products.index');
Route::post('/productos/store', [ProductoController::class, 'store'])->name('products.store');
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('products.edit');
Route::put('/productos/{id}/update', [ProductoController::class, 'update'])->name('products.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('providers.index');
Route::post('/proveedores/store', [ProveedorController::class, 'store'])->name('providers.store');
Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('providers.edit');
Route::put('/proveedores/{id}/update', [ProveedorController::class, 'update'])->name('providers.update');
Route::delete('/proveedores/{id}/delete', [ProveedorController::class, 'destroy'])->name('providers.destroy');


Route::post('categorias/store', [CategoriaController::class, 'store'])->name('categories.store');
Route::get('categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categories.edit');
Route::put('categorias/{id}/update', [CategoriaController::class, 'update'])->name('categories.update');
Route::delete('categorias/{id}', [CategoriaController::class, 'destroy'])->name('categories.destroy');

