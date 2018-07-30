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
Route::prefix('admin')->name('admin.')->group(function (){

    //User
    Route::namespace('User')->group(function(){

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

        /**
         * Profile
         */
        Route::get('/profiles/{profileId}/edit', 'ProfileController@edit')->name('profiles.edit');
        Route::post('/profiles/{userId}', 'ProfileController@store')->name('profiles.store');
        Route::get('/profiles/{userId}/create', 'ProfileController@create')->name('profiles.create');
        Route::resource('profiles', 'ProfileController', [
            'parameters' => ['profiles' => 'userId'],
            'only' => ['show', 'update', 'destroy']
        ]);

        /**
         * Avatar
         */
        Route::resource('avatars', 'AvatarController', [
            'parameters' => ['avatars' => 'profile'],
            'only' => ['show', 'edit', 'update']
        ]);
    });

    //Profile
    Route::namespace('Profile')->group(function(){

        Route::resource('schedule', 'DaysController',[
            'parameters' => ['schedule' => 'profile'],
            'only' => ['update'],
        ]);
    });
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

    /**
    * Profile
    */
    Route::get('/myprofile', 'ProfileController@edit')->name('profiles.edit');
    Route::put('/myprofile', 'ProfileController@update')->name('profiles.update');
    Route::delete('/myprofile', 'ProfileController@destroy')->name('profiles.destroy');
});

