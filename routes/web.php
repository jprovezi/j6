<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SiteController::class, "index"]);
Route::get('/sobre', [SiteController::class, "sobre"]);
Route::get('/solucoes/{id?}', [SiteController::class, "solucoes"]);
Route::get('/portfolio', [SiteController::class, "portfolio"]);
Route::get('/duvidas', [SiteController::class, "duvidas"]);
Route::get('/fale-conosco', [SiteController::class, "faleConosco"]);
