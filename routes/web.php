<?php


Auth::routes();

Route::get('/', 'PageController@index')->name('index');

Route::get('/home', 'PageController@home')->name('home');

Route::get('/admin/dashboard', 'PageController@dashboard')->name('admin.dashboard');


/**
 * ActivationToken
 */
Route::resource('/accounts/token', 'Auth\ActivationController', [
    'parameters' => ['token' => 'activationToken'],
    'only' => ['create', 'store', 'show'],
]);

Route::prefix('admin')->namespace('User')->name('admin.')
    ->group(function (){

    Route::resource('accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'update', 'destroy']
    ]);

});