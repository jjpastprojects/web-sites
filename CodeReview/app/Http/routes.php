<?php

Route::get('/', [
    'as' => 'home',
    'uses' => 'PageController@get',
    ]);

Route::get('/home', [
    'as' => 'home',
    'uses' => 'PageController@get',
    ]);


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
* languages chooser
*/

Route::get('/lang', [
    'as' => 'LanguageChooser',
    'uses' => 'LanguageController@chooser',
    ]);


/**
* profile
*/


Route::get('/profile', [
    'as' => 'profile',
    'uses' => 'ProfileController@index',
    ]);



Route::get('/profile/set', [
    'as' => 'profile.set',
    'uses' => 'ProfileController@show',
    ]);

Route::get('/profile/set/{variable_id}', [
    'as' => 'profile.set.2',
    'uses' => 'ProfileController@show2',
    ]);


Route::post('/profile/store', [
    'as' => 'profile.store',
    'uses' => 'ProfileController@store',
    ]);



Route::get('/profile/update/{variable_id}', [
    'as' => 'profile.update',
    'uses' => 'ProfileController@showForUpdate',
    ]);



Route::post('/profile/update', [
    'as' => 'profile.update',
    'uses' => 'ProfileController@update',
    ]);


Route::delete('/profile/delete', [
    'as' => 'profile.delete',
    'uses' => 'ProfileController@delete',
    ]);


Route::get('/profile/undefinedVariables', [
    'as' => 'profile.undefinedVariables',
    'uses' => 'ProfileController@getUndefinedVariables',
    ]);




/**
* variable
*/

Route::get('/variable/create', [
    'as' => 'variable_create',
    'uses' => 'VariableController@create',
    ]);

Route::post('/variable/store', [
    'as' => 'variable_create',
    'uses' => 'VariableController@store',
    ]);

/**
*condition just for develepment
*/

Route::get('/condition', [
    'as' => 'condition',
    'uses' => 'ConditionController@test',
    ]);



/**
* pages
*/

Route::get('/pages', [
    'as' => 'pages',
    'uses' => 'PageController@get',
    ]);


Route::get('/page/{title}', [
    'as' => 'page',
    'uses' => 'PageController@show',
    ]);


Route::post('/page/save/', [
    'as' => 'saveAPage',
    'uses' => 'PageController@save',
    ]);

Route::post('/page/delete/', [
    'as' => 'deleteAPage',
    'uses' => 'PageController@delete',
    ]);

/**
* admin
*/

Route::get('/admin/users', [
    'as' => 'admin_users',
    'uses' => 'AdminController@showUsers',
    ]);



