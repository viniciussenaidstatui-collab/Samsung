<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LojaController;
use App\Http\Middleware\auth_api;

Route::get('/testa-email/{id_usuario}', [UsuarioController::class, 'testa_email']);
// Adicione no final do arquivo, antes do fechamento
Route::post('/ativar_2fa', [UsuarioController::class, 'ativar_2fa']);
Route::post('/confirmar_ativar_2fa', [UsuarioController::class, 'confirmar_ativar_2fa']);
Route::post('/solicitar_recuperacao', [UsuarioController::class, 'solicitar_recuperacao']);
Route::post('/confirmar_recuperacao', [UsuarioController::class, 'confirmar_recuperacao']);

Route::get('/enviar_codigo', [UsuarioController::class, 'enviar_codigo']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas públicas (não precisam de token)
Route::post('/cadastra_usuario', [UsuarioController::class, 'cadastra_usuario']);
Route::post('/login_usuario', [UsuarioController::class, 'login_usuario']); 

// Rotas do TestController que não precisam de token
Route::get('/teste', [TestController::class, 'envia_teste']);
Route::get('/soma', [TestController::class, 'soma']);
Route::get('/exibe_samsung/{id}', [TestController::class, 'exibe_samsung']);
Route::post('/todos_samsung', [TestController::class, 'todos_samsung']);
Route::get('/carrinho/count', [LojaController::class, 'cartCount']);
Route::get('/carrinho/itens', [LojaController::class, 'cartItems']);
Route::post('/carrinho/adicionar', [LojaController::class, 'addToCart']);
Route::post('/carrinho/atualizar', [LojaController::class, 'updateCart']);
Route::delete('/carrinho/remover/{id}', [LojaController::class, 'removeFromCart']);
Route::post('/carrinho/checkout', [LojaController::class, 'checkout']);
Route::post('/carrinho/aplicar-cupom', [LojaController::class, 'applyCoupon']);
Route::delete('/carrinho/remover-cupom', [LojaController::class, 'removeCoupon']);
Route::get('/roleta/status', [LojaController::class, 'spinStatus']);
Route::post('/roleta/girar', [LojaController::class, 'spin']);

// Rotas que precisam de autenticação (token)
Route::middleware([auth_api::class])->group(function() {
    // Rotas do TestController
    Route::post('/salva_samsung', [TestController::class, 'salva_samsung']);
    Route::put('/altera_loja', [TestController::class, 'altera_loja']);
    Route::delete('/d_samsung', [TestController::class, 'deletar_samsung']);
    
    // Rotas do UsuarioController que precisam de autenticação
    Route::put('/altera_cadastro', [UsuarioController::class, 'altera_cadastro']);
    Route::get('/exibe_cadastro/{id}', [UsuarioController::class, 'exibe_cadastro']);
    Route::get('/todos_cadastros', [UsuarioController::class, 'todos_cadastros']);
    Route::delete('/apagar_cadastro', [UsuarioController::class, 'apagar_cadastro']);
    
    // Rotas para visualização (views) - se estiver usando views
    Route::get('/visualiza_cadastro/{id_cadastro}', [UsuarioController::class, 'visualiza_cadastro']);
    Route::get('/deleta_cadastro/{id_cadastro}', [UsuarioController::class, 'deleta_cadastro']);
    Route::get('/mostra_loja/{id_loja}', [TestController::class, 'mostra_loja']);
    Route::get('/deleta_samsung/{id_loja}', [TestController::class, 'deleta_samsung']);
});
