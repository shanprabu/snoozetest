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

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::get('/', 'MainController@indexPage');
Route::get('/', 'MainController@viewRecords')->name('view');
Route::get('/upload', 'MainController@uploadFiles')->name('upload');
Route::post('formsubmit', 'MainController@formSubmit');

Route::get('/view','MainController@viewRecords');

Route::get('/getvue','MainController@getVue');
Route::get('/test','MainController@showVue');
