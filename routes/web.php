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
    Route::get('/accounts/list', 'AccountController@accountsList')->name('accounts.list');
    Route::resource('accounts', 'AccountController', [
        'parameters' => ['accounts' => 'userId'],
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);

    /**
     * Role
     */
    Route::delete('roles-revoke/{userId}', 'RoleController@revoke')->name('roles.revoke');
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

