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

Route::get('/', 'HomeController@index')->name('home');;

Auth::routes();

Route::get('/users', 'UserController@index')->name('users');

Route::get('/account', 'AccountController@create')->name('accounts.create');
Route::post('/account', 'AccountController@store')->name('accounts.store');

Route::get('/account/{account}', 'AccountController@edit')->name('accounts.edit');
Route::put('/account/{account}', 'AccountController@update')->name('accounts.update');