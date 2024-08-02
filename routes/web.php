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
Route::post('/urls', 'UrlController@store')->name('url-store');
Route::post('/ur/editUrl', 'UrlController@editUrl')->name('url.editUrl');
Route::get('{code}',  'UrlController@shortenLink')->name('shorten.link');
Route::post('url.deleteUrl', 'UrlController@deleteUrl')->name('url.deleteUrl');
