<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginApiController;
use App\Http\Controllers\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginApiController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user/me', [UserApiController::class, 'me']);

    Route::get('/user/details', [UserApiController::class, 'details']);
    Route::post('/user/create-details', [UserApiController::class, 'createDetails']);
});
