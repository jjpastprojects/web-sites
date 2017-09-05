<?php

Route::group(['namespace ' => 'Lembarek\Core\Controllers', 'as' => 'core::', 'middleware' => ['web']], function () {

    Route::get('/', [
    'as' => 'home',
    'uses' => 'Lembarek\Core\Controllers\HomeController@home',
    ]);

});
