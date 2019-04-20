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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/message', 'HomeController@message');
Route::post('/send', 'HomeController@send');
Route::resource('questions', 'QuestionController')->only([
    'index', 'store'
    ]);
Route::get('/', 'PageController@list');
Route::get('/question/{id}', 'PageController@show');
Route::resource('subscribes', 'SubscribeController')->only(['index','show','store']);