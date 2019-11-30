<?php

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

Route::domain('titan.pbbg.io')->group(function() {
    Route::get('/', 'TitanController@index');
});

Route::get('/titan', 'TitanController@index');

Route::get('/', function () {
    return view('welcome');
});


