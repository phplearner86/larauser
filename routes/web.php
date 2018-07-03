<?php

use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', 'PageController@index')->name('index');
Route::get('/test/{userId}', 'PageController@test')->name('test');
Route::get('/test/show/{userId}', 'PageController@show')->name('show');
Route::post('/test/{userId}', 'PageController@upgrade')->name('upgrade');
Route::put('/test/{userId}', 'PageController@update')->name('update');
Route::delete('/test/{userId}', 'PageController@deleteall')->name('deleteall');




Route::get('/days/{profile}', 'PageController@getDays')->name('getDays');
Route::get('/days/all/{profile}', 'PageController@showDays')->name('showDays');
Route::post('/days/{profile}', 'PageController@createSchedule')->name('createSchedule');
Route::put('/days/{profile}', 'PageController@updateDays')->name('updateDays');
Route::get('/days/{profile}/edit', 'PageController@editDays')->name('editDays');



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

    /**
     * Profile
     */
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

