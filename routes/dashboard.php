<?php

use App\Http\Controllers\Dashboard\CategoriaController;
use App\Http\Controllers\Dashboard\InicioController;
use App\Http\Controllers\Dashboard\UsuarioController;
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

/* INICIO RUTAS DASHBOARD - PROTEGIDAS */

Route::prefix("dashboard")->group(function (){

    Route::get('inicio', [InicioController::class,"index"]);

    Route::resource('usuarios', UsuarioController::class);

    Route::get('categorias/listado', [CategoriaController::class,"listado"]);
    Route::post('categorias/habilitar/{id}', [CategoriaController::class,"habilitar"]);
    Route::post('categorias/inhabilitar/{id}', [CategoriaController::class,"inhabilitar"]);
    Route::resource('categorias', CategoriaController::class);
});

/* FIN RUTAS DASHBOARD - PROTEGIDAS */
