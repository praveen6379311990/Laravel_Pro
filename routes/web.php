<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[ProductController::class, 'index']);

Route::get('/create',[ProductController::class,'create']);

Route::post('/product/store',[ProductController::class, 'store']);

Route::get('products/{id}/show',[ProductController::class,'show']);

Route::get('products/{id}/edit',[ProductController::class,'edit']);

Route::put('products/{id}/update',[ProductController::class,'update']);

Route::get('products/{id}/destroy',[ProductController::class,'destroy']);



