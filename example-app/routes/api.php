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

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::group(['prefix' => 'auth'], function(){
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
    });

    Route::group(['prefix' => 'loans'], function(){
        Route::post('create', 'LoanController@postCreate');
        Route::get('read/{id}', 'LoanController@getRead');
        Route::get('list', 'LoanController@getList');
    });

    Route::group(['prefix' => 'payments'], function(){
        Route::post('create', 'PaymentController@postCreate');
        Route::get('read/{id}', 'PaymentController@getRead');
        Route::get('list', 'PaymentController@getList');
    });
});
