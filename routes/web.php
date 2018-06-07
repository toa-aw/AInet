<?php

Route::get('/', 'HomeController@index')->name('home');;

Auth::routes();

Route::get('/account', 'AccountController@create')->name('accounts.create');
Route::post('/account', 'AccountController@store')->name('accounts.store');
Route::delete('/account/{account}', 'AccountController@delete')->name('accounts.delete');
Route::patch('/account/{account}/close', 'AccountController@softDelete')->name('accounts.soft');
Route::patch('/account/{account}/reopen', 'AccountController@reOpen')->name('accounts.reopen');

Route::get('/accounts/{user}', 'AccountController@listAccounts')->name('user.accounts');
Route::get('/accounts/{user}/opened', 'AccountController@listOpenAccounts')->name('user.opened.accounts');
Route::get('/accounts/{user}/closed', 'AccountController@listClosedAccounts')->name('user.closed.accounts');

Route::get('/account/{account}', 'AccountController@edit')->name('accounts.edit');
Route::put('/account/{account}', 'AccountController@update')->name('accounts.update');

Route::get('/users', 'AdminController@index')->name('users');

Route::patch('/users/{user}/block', 'AdminController@block')->name('users.block');
Route::patch('/users/{user}/unblock', 'AdminController@unblock')->name('users.unblock');
Route::patch('/users/{user}/promote', 'AdminController@promote')->name('users.promote');
Route::patch('/users/{user}/demote', 'AdminController@demote')->name('users.demote');

Route::get('/me/password', 'UserController@editPassword')->name('password.edit');
Route::patch('/me/password', 'UserController@updatePassword')->name('password.update');

Route::get('/me/profile', 'UserController@edit')->name('user.edit');
Route::put('/me/profile', 'UserController@update')->name('user.update');

Route::get('/profiles', 'UserController@profiles')->name('profiles');

Route::get('/me/associates', 'UserController@myAssociates')->name('user.associates');
Route::get('/me/associate-of', 'UserController@associatedTo')->name('user.associated');
Route::get('/me/associate', 'UserController@createAssociate')->name('user.add.associate');
Route::post('/me/associates', 'UserController@storeAssociate')->name('user.store.associate');
Route::delete('/me/associates/{user}', 'UserController@deleteAssociate')->name('user.delete.associate');

Route::get('/movements/{account}', 'MovementController@index')->name('movements');
Route::get('/movements/{account}/create', 'MovementController@create')->name('movements.create');
Route::post('/movements/{account}/create', 'MovementController@store')->name('movements.store');
Route::get('/movement/{movement}', 'MovementController@edit')->name('movements.edit');
Route::put('/movement/{movement}', 'MovementController@update')->name('movements.update');
Route::delete('/movement/{movement}', 'MovementController@delete')->name('movements.delete');

Route::post('/documents/{movement}', 'MovementController@associateDocumentToMovement')->name('movement.associateDocument');
Route::get('/documents/{movement}', 'MovementController@addDocument')->name('movement.addDocument');
Route::delete('/document/{document}', 'DocumentController@delete')->name('delete.document');
Route::get('/document/{document}', 'DocumentController@getDocument')->name('get.document');
