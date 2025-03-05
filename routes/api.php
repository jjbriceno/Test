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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('products')->group(function () {
    Route::get('/', 'App\Http\Controllers\ProductController@index');
    Route::post('/', 'App\Http\Controllers\ProductController@store');
    Route::get('/{id}', 'App\Http\Controllers\ProductController@show');
    Route::put('/{id}', 'App\Http\Controllers\ProductController@update');
    Route::delete('/{id}', 'App\Http\Controllers\ProductController@destroy');
    Route::get('/{id}/prices', 'App\Http\Controllers\ProductController@prices');
    Route::post('/{id}/prices', 'App\Http\Controllers\ProductController@createPrice');
});
