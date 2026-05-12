<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SamsungPdf;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

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


