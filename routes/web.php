<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagenTesteMail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');
*/

Route::get('tarefa/exportacao/{extensao}', 'App\Http\Controllers\TarefaController@exportacao')
    ->name('tarefa.exportacao');

Route::get('tarefa/export', 'App\Http\Controllers\TarefaController@export')
    ->name('tarefa.export');
    
Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');