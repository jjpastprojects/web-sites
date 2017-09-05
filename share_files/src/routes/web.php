<?php

Route::group([
    'as' => 'file::',
    'middleware' => 'web',
    'namespace' => 'Lembarek\ShareFiles\Controllers'
], function () {

    Route::resource('files', 'FilesController', ['only' => ['index', 'create', 'store', 'show']]);

    Route::get('/search', [
    'as' => 'search',
    'uses' => FilesController::class.'@search',
    ]);

});
