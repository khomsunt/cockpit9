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

Route::get('/test', function () {
    return view('welcome');
});

Route::get('/tester', function () {
    return view('main.detail');
});
Route::get('/template', function () {
    return view('khomsun.template');
});

Route::get('/kpi','KpiController@index');

Route::get('/about','SiteController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/typebooks','TypeBooksController@index')->name('typebooks');
Route::get('/typebooks/destroy/{id}','TypeBooksController@destroy');