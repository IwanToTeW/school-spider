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
    return view('upload');
});

Route::get('newslist', 'NewsController@showAll');
Route::get('newslist/{item}', 'NewsController@showOne');

Route::resource('news', 'NewsController');

Route::post('videos', function (){

    request()->file('video')->store('videos');

    return back();
});
