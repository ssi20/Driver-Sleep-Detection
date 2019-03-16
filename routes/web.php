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


Route::get('/home','SessionController@index');

Route::get('/session','SessionController@create');

Route::get('/start','SessionController@store');


Route::group(['prefix'=>'manager', 'middleware' => 'admin'], function() {

    Route::get('/', function () {
            return view('manager.layouts.home');
         })->name("m_home");

    Route::get('/schedule','ManagerController@plList' )->name("m_schedule");

    
    Route::get("/create&d_id={d_id}", function () {
        return view('manager.layouts.createSch');
        })->name("m_schedule");
    
    Route::get("/monitor&d_id={d_id}", function () {
        return view('manager.layouts.monitor');
        })->name("m_schedule");

    Route::post('/createSchedule','ManagerController@createSchedule' )->name("m_schedule");

    Route::get('/status/','ManagerController@dstatus' )->name('status');

         //Route::post("/fitness",'ManagerController@fitness' )->name("fit_sub");

         
         
});
