<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::post('/products', [ProductController::class, 'create'])->name('products-create');
Route::delete('/products/delete', [ProductController::class, 'delete'])->name('products-delete');
Route::get('products/{id}/edit', [ProductController::class, 'show'])->name('products-edit');
Route::put('products/{id}/update', [ProductController::class, 'update'])->name('products-update');
