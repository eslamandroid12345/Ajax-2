<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('products/create', [\App\Http\Controllers\ProductController::class,'create'])->name('products.create');
Route::get('products/all', [\App\Http\Controllers\ProductController::class,'products'])->name('products.all');
Route::post('products/store', [\App\Http\Controllers\ProductController::class,'store'])->name('products.store');
Route::post('products/delete', [\App\Http\Controllers\ProductController::class,'delete'])->name('products.delete');
Route::get('products/edit/{id}', [\App\Http\Controllers\ProductController::class,'edit'])->name('products.edit');
Route::post('products/update', [\App\Http\Controllers\ProductController::class,'update'])->name('products.update');