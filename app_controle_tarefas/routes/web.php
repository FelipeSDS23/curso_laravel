<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');

Route::resource('tarefa', TarefaController::class)
    ->middleware('verified');

Route::get('mensagem-teste', function() {
    return new MensagemTesteMail();
    // Mail::to('marsh0304@outlook.com.br')->send(new MensagemTesteMail());
    // return "E-mail enviado com sucesso!";
});