<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;

Route::get('/', [Home::class, 'index']);
Route::get('/deletar/{id}', [Home::class, 'deletar']);
Route::get('/adicionar', [Home::class, 'adicionar']);