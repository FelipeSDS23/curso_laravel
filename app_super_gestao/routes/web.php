<?php

use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;

//public routes
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index');
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/login',  function() { return 'Login';})->name('site.login');

//private routes
Route::prefix('/app')->group(function() {
    Route::get('/clientes', function() { return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', function() { return 'Fornecedores';})->name('app.fornecedores');
    Route::get('/produtos', function() { return 'Produtos';})->name('app.produtos');
});


Route::get('/rota1', function() {
    echo 'Rota 1';
})->name('site.rota1');

Route::get('/rota2', function() {
    return redirect()->route('site.rota1');
})->name('site.rota2');

// Route::redirect('/rota2', '/rota1');

//fallback route
Route::fallback(function() {
     echo "A rota acessada não existe. <a href=" . route('site.index') . ">clique aqui</a> para ir para a página inicial";
});

