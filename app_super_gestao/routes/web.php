<?php

use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;

//middlewares
use App\Http\Middleware\LogAcessoMiddleware;
use App\Http\Middleware\AutenticacaoMiddleware;

//public routes
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware(LogAcessoMiddleware::class);
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos')->middleware(LogAcessoMiddleware::class);
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/contato/confirmacao', [ContatoController::class, 'confirmacao'])->name('site.contato.confirmacao');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/login',  function() { return 'Login';})->name('site.login');

//private routes
Route::prefix('/app')->middleware(AutenticacaoMiddleware::class.':padrao,visitante')->group(function() {
    Route::get('/clientes', function() { return 'Clientes';})->name('app.clientes');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('app.fornecedores');
    Route::get('/produtos', function() { return 'Produtos';})->name('app.produtos');
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('site.rota1');

//fallback route
Route::fallback(function() {
     echo "A rota acessada não existe. <a href=" . route('site.index') . ">clique aqui</a> para ir para a página inicial";
});

