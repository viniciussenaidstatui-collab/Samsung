<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste', [TestController::class,'envia_teste']);
Route::get('/soma', [TestController::class,'soma']);
Route::post('/salva_samsung', [TestController::class,'salva_samsung']);
Route::get('/exibe_samsung/{id}',[TestController::Class,'exibe_samsung']);
Route::get('/todos_samsung',[TestController::Class,'todos_samsung']);
