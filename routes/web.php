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

Auth::routes();
Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/update/{id}','DashboardController@pord');
Route::resource('dashboard','DashboardController');
Route::get('/post', 'PostController@index');
Route::get('/post/{id}', 'PostController@view');
