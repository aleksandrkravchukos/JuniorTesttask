<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'Controller@home')->name('home');

Route::group(['prefix' => 'users'], function () {
    Route::get('/',['as'=>'users.index','uses'=>'UserController@index']);
    Route::post('/index',['as'=>'users.get','uses'=>'UserController@getUsers']);
    Route::post('/create',['as'=>'users.store','uses'=>'UserController@store']);
    Route::patch('/{id}',['as'=>'users.update','uses'=>'UserController@update']);
    Route::delete('/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy']);
    Route::get('/{id}',['as'=>'users.data','uses'=>'UserController@data']);
});
