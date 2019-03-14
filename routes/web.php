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
*/Route::get('/','SessionController@index');


<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});
Route::get('/manager', function () {
    return view('manager.layouts.schedule');
});
=======
Route::get('/home','SessionController@index');

Route::get('/session','SessionController@create');

Route::get('/start','SessionController@store');



>>>>>>> c173cdd1f7d8e7bd9940d1820e21075172addae6
