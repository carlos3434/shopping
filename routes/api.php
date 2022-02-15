<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;


Route::prefix('v1')->group(function(){
    Route::get('/unauthorized', [AuthController::class, 'unauthorized']);
    Route::post('/login', [AuthController::class, 'login']);


    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('logout', [AuthController::class, 'logout']);
        Route::resource('cars', CarController::class);
    });
});