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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/signup', 'AuthController@signup');
    Route::get('/logout', 'AuthController@logout')->middleware('auth:api');
    Route::get('/user', 'AuthController@user')->middleware('auth:api');
});

Route::group(['prefix' => 'food'], function () {
    Route::post('/store', 'FoodsController@store')->middleware('auth:api');
    Route::get('/index', 'FoodsController@index');
});

Route::group(['prefix' => 'order'], function () {
    Route::post('/store', 'OrdersController@store');
    Route::get('/orders', 'OrdersController@foodsShow')->middleware('auth:api');
});