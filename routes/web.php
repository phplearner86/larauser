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



/**
 * Admin
 */
Route::prefix('admin')->namespace('User')->name('admin.')
    ->group(function (){
    /**
     * Account
     */
    Route::resource('accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'update', 'destroy']
    ]);

    /**
     * Role
     */
    Route::resource('roles', 'RoleController', [
        'only' => ['index', 'show', 'store', 'update', 'destroy']
    ]);

});