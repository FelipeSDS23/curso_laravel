<?php

use Illuminate\Support\Facades\Route;

//controllers
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;

//middlewares
use App\Http\Middleware\LogAcessoMiddleware;
use App\Http\Middleware\AutenticacaoMiddleware;

//public routes
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware(LogAcessoMiddleware::class);
Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos')->middleware(LogAcessoMiddleware::class);
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::get('/contato/confirmacao', [ContatoController::class, 'confirmacao'])->name('site.contato.confirmacao');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');
Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

//private routes
Route::prefix('/app')->middleware(AutenticacaoMiddleware::class.':padrao,visitante')->group(function() {
    //app routes
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');

    //fornecedores routes
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    //produtos routes
    Route::resource('produto', ProdutoController::class);

    //produtos detalhes
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    
    //Route::resource('pedido-produto', PedidoProdutoController::class);
    Route::get('pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    // Route::delete('pedido-produto/destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});

// Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('site.rota1');

//fallback route
Route::fallback(function() {
     echo "A rota acessada não existe. <a href=" . route('site.index') . ">clique aqui</a> para ir para a página inicial";
});

