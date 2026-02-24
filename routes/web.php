<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('/index', function () {
    return view('index'); 
});

Route::get('/inicio', function () {
    return view('pagina_inicial'); 
});

Route::get('/visualiza_loja/{id_loja}',[TestController::class,'visualiza_samsung']);
Route::get('/altera_loja/{id_loja}',[TestController::class,'mostra_loja']);
Route::get('/deleta_samsung/{id_loja}',[TestController::class,'deleta_samsung']);
