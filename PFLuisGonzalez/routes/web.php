<?php

use App\Http\Controllers\BandaController;
use Illuminate\Support\Facades\Route;

// Retorna a view home.blade.php
Route::get('/', [BandaController::class, 'home'])->name('home');

// Retorna o fallback.blade.php
Route::fallback(function () {
    return view('fallback');
});

/******************* Rutas Principais *******************/
// Retorna a view bandAdd.blade.php
Route::get('/band-add', [BandaController::class,'bandAddShow'])->name('band.add.show');
Route::get('/band/{id}', [BandaController::class,'bandView'])->name('band.view');

// POST: Adiciona/Atualiza uma banda à base de dados
Route::post('/band-add', [BandaController::class, 'bandAdd'])->name('band.add');
