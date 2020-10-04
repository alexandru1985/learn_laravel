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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/book', 'BookController@index');
//Route::get('{path}', 'BookController@index')->where('path', '([A-z\d-\/_.]+)?');

Auth::routes(['verify' => true]);
Auth::routes();
Route::get('profile', function () {
    return '<h1>This is profile page</h1>';
})->middleware('verified');



Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
Auth::routes();


