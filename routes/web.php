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

Route::get('/users', 'AdminController@index')->name('users');

Route::patch('/users/{user}/block', 'AdminController@block')->name('users.block');
Route::patch('/users/{user}/unblock', 'AdminController@unblock')->name('users.unblock');
Route::patch('/users/{user}/promote', 'AdminController@promote')->name('users.promote');
Route::patch('/users/{user}/demote', 'AdminController@demote')->name('users.demote');

Route::patch('/me/password', 'UserController@updatePassword')->name('password.update');

