<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/visualiza_loja/{id_loja}',[TestController::class,'visualiza_samsung']);
Route::get('/altera_loja/{id_loja}',[TestController::class,'mostra_loja']);
Route::get('/deleta_samsung/{id_loja}',[TestController::class,'deleta_samsung']);


