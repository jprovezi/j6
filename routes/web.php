<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, "index"])->name('site.home');
Route::get('/sobre', [SiteController::class, "sobre"])->name('site.sobre');
Route::get('/solucoes/{id?}', [SiteController::class, "solucoes"])->name('site.solucoes');
Route::get('/portfolio', [SiteController::class, "portfolio"])->name('site.portfolio');
Route::get('/duvidas', [SiteController::class, "duvidas"])->name('site.duvidas');
Route::get('/fale-conosco', [SiteController::class, "faleConosco"])->name('site.faleconosco');
Route::post('/contato', [ContatoController::class, 'store'])->name('contato.store');

