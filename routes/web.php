<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SamsungPdf;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\LojaController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/roleta', [LojaController::class, 'spinPage'])->name('spin.index');

Route::get('/digita_codigo', function () {
    return view('digita_codigo');
})->name('digita_codigo');

require __DIR__.'/auth.php';

Route::get('/index', function () {
    return view('RegistraProduto'); 
});

Route::get('/inicio', function () {
    return view('pagina_inicial'); 
});

Route::get('/cadastro', function () {
    return view('cadastro_usuario');
});

Route::get('/login_admin', function () {
    return view('login_admin');
});

Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

Route::get('/login', function () {
    return view('login');
});

Route::get("/processar-pdf", [SamsungPdf::class, "generate"])->name("processar-pdf");

Route::get('/visualiza_loja/{id_loja}',[TestController::class,'visualiza_samsung']);
Route::get('/altera_loja/{id_loja}',[TestController::class,'mostra_loja']);
Route::get('/deleta_samsung/{id_loja}',[TestController::class,'deleta_samsung']);
Route::get('/loja', [LojaController::class, 'index'])->name('loja.index');
Route::get('/loja/produto/{id}', [LojaController::class, 'show'])->name('loja.show');
Route::get('/carrinho', [LojaController::class, 'cart'])->name('loja.cart');
Route::post('/loja/add-to-cart', [LojaController::class, 'addToCart'])->name('loja.addToCart');
Route::post('/loja/update-cart', [LojaController::class, 'updateCart'])->name('loja.updateCart');
Route::delete('/loja/remove-from-cart/{id}', [LojaController::class, 'removeFromCart'])->name('loja.removeFromCart');
Route::post('/loja/apply-coupon', [LojaController::class, 'applyCoupon'])->name('loja.applyCoupon');
Route::delete('/loja/remove-coupon', [LojaController::class, 'removeCoupon'])->name('loja.removeCoupon');
Route::post('/loja/checkout', [LojaController::class, 'checkout'])->name('loja.checkout');
// Rota da nova vitrine
Route::get('/vitrine', [LojaController::class, 'vitrine'])->name('loja.vitrine');
