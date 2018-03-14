<?php


Auth::routes();

Route::get('/', 'PageController@index')->name('index');

Route::get('/home', 'PageController@home')->name('home');

Route::resource('/accounts/token', 'Auth\ActivationController', [
    'parameters' => ['token' => 'activationToken'],
]);