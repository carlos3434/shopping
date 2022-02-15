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
use App\Http\Controllers\ElasticSearchController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarController;


/**
 * cars
 */
/*
Route::get('/', [IndexController::class,'readItems']);
Route::post('addItem', [IndexController::class,'addItem']);
Route::post('editItem', [IndexController::class,'editItem']);
Route::post('deleteItem', [IndexController::class,'deleteItem']);

elastic search
heroku

*/

Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class,'index']);

Auth::routes();

Route::get('car/{car}', [HomeController::class,'show']);
Route::get('order', [OrderController::class,'index']);
Route::post('order', [OrderController::class,'store']);
Route::delete('order/{order}', [OrderController::class,'destroy']);
Route::get('checkout', [OrderController::class,'checkout']);

Route::get('files/image/{path}', function ($path) {
    $pathToFile = storage_path('app/uploads/files/image/'.$path);
    return response()->file($pathToFile);
});

Route::group(['prefix' => 'admin'], function() {

    Route::group(['middleware' => 'check.user.role'], function(){
        Route::get('/', function() {
            return view('admin.home');
        });
        Route::resource('user',UserController::class);
        Route::resource('car',CarController::class);
    });
});


