<?php


use Illuminate\Support\Facades\Route;

Route::post('/generate', 'RandomNumberController@generate');
Route::get('/retrieve/{id}', 'RandomNumberController@retrieve');