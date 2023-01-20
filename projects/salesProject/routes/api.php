<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\Auth\LoginController;


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/vendas', [SaleController::class, 'index'])->name('index.sales');
    Route::get('/venda/{sale}', [SaleController::class, 'show'])->name('show.sale');
    Route::post('/lancar-venda', [SaleController::class, 'store'])->name('store.sale');

});

