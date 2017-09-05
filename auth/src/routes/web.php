<?php


Route::group([
    'as' => 'auth::',
    'middleware' => ['web'],
    'namespace' => 'Lembarek\Auth\Controllers'
], function () {
    Route::get('/register', [
    'as' => 'register',
    'uses' => 'AuthController@register',
    ]);

    Route::post('/register', [
    'as' => 'register',
    'uses' => 'AuthController@postRegister',
    ]);

    Route::get('/login', [
    'as' => 'login',
    'uses' => 'AuthController@login',
    ]);

    Route::post('/login', [
    'as' => 'login',
    'uses' => 'AuthController@postLogin',
    ]);


    Route::get('/logout', [
        'as' => 'logout',
        'uses' => 'AuthController@logout',
        ]);


    Route::get('/reset_password', [
        'as' => 'reset.showEmail',
        'uses' => 'PasswordController@showEmail',
        ]);


    Route::post('/reset_password', [
        'as' => 'reset.sendToEmail',
        'uses' => 'PasswordController@sendToEmail',
        ]);


    Route::get('/reset_password/{token}', [
        'as' => 'reset_password',
        'uses' => 'PasswordController@showPasswordField',
        ]);


    Route::post('/post_reset_password', [
        'as' => 'post_reset_password',
        'uses' => 'PasswordController@resetPassword',
        ]);

    if(env('USING_LARAVEL_SOCIALITE', true)){
      Route::get('/auth/{provider}', [
          'as' => 'socialite.redirect',
          'uses' => 'SocialiteController@login',
      ]);
    }
});
