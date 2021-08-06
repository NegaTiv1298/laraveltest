<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/error/', function () {
    return view('error404');
});
Route::get('/page/', 'ShortLinkController@show')
    ->name('short.link');
Route::post('/page/', 'ShortLinkController@save')
    ->name('short.link.post');
Route::get('{token}', 'ShortLinkController@redirect')
    ->name('short.link.token');
