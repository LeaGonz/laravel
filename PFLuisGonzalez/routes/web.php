<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandaController;

// Retorna a view home.blade.php
Route::get('/home', [BandaController::class, 'home'])->name('home');

// Retorna o fallback.blade.php
Route::fallback(function () {
    return view('fallback');
});

/*************** USERS ***************/
// Retorna a view userHome.blade.php
Route::get('/user', [UserController::class, 'userHome'])->name('user.home')->middleware('admin');
// Retorna a view userAdd.blade.php
Route::get('/user-add', [UserController::class, 'userAddShow'])->name('user.add.show');
// Retorna a view userView.blade.php
Route::get('/user/{id}', [UserController::class,'userView'])->name('user.view');
// Retorna a view home.blade.php
Route::get('/user/delete/{id}', [UserController::class,'userDelete'])->name('user.delete')->middleware('admin');


// POST: Adiciona um utilizador à base de dados
Route::post('/user-add', [userController::class, 'userAdd'])->name('user.add');


/*************** BANDAS ***************/
// Retorna a view bandAdd.blade.php
Route::get('/band-add', [BandaController::class,'bandAddShow'])->name('band.add.show')->middleware('auth');
// Retorna a view bandView.blade.php
Route::get('/band/{id}', [BandaController::class,'bandView'])->name('band.view');
// Retorna a view home.blade.php
Route::get('/band/delete/{id}', [BandaController::class,'bandDelete'])->name('band.delete')->middleware('admin');

// POST: Adiciona/Atualiza uma banda à base de dados
Route::post('/band-add', [BandaController::class, 'bandAdd'])->name('band.add');


/*************** ALBUNS ***************/
// Retorna a view albumAdd.blade.php
Route::get('/album-add', [AlbumController::class,'albumAddShow'])->name('album.add.show')->middleware('auth');
// Retorna a view albumView.blade.php
Route::get('/album/{id}', [AlbumController::class,'albumView'])->name('album.view');
// Retorna a view home.blade.php
Route::get('/album/delete/{id}', [AlbumController::class,'albumDelete'])->name('album.delete')->middleware('admin');

// POST: Adiciona/Atualiza uma banda à base de dados
Route::post('/album-add', [AlbumController::class, 'albumAdd'])->name('album.add');
