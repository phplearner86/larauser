<?php

use Illuminate\Support\Facades\Auth;


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

/**
 * User
 */
Route::prefix('settings')->namespace('User')->name('users.')->group(function(){
   /**
    * Account
    */
    Route::get('/myaccount', 'AccountController@edit')->name('accounts.edit');
    Route::put('/myaccount', 'AccountController@update')->name('accounts.update');
    Route::delete('/myaccount', 'AccountController@destroy')->name('accounts.destroy');
});

