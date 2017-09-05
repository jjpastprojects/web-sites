<?php

Route::group([
    'as' => 'api::',
    'middleware' => ['api'],
    'namespace' => 'Lembarek\Api\Controllers',
    'prefix' => '/api/v1/'
], function () {

    Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

});
