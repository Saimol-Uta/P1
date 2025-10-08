<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Models\DetalleCompra;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas de recursos le decimos que cree las rutas basicas para un CRUD
//index, create, store, show, edit, update, destroy
//php artisan route:list para ver las rutas creadas
Route::resource('cliente',ClienteController::class);
Route::resource('producto',ProductoController::class);
Route::resource('compra',CompraController::class);
Route::resource('DetalleCompra',DetalleCompra::class);
