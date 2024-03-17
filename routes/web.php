<?php

use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\InicioController;
use App\Http\Controllers\Web\ProductoController;
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

/* INICIO RUTAS WEB - PUBLICAS SIN PROTECCIÓN */

Route::get('/', [InicioController::class,"index"]);
Route::get('blog', [BlogController::class,"index"]);
Route::get('producto', [ProductoController::class,"index"]);

/* FIN RUTAS WEB - PUBLICAS SIN PROTECCIÓN */


