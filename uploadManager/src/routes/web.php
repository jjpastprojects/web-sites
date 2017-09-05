<?php

Route::group([
    'as' => 'uploadManager::',
    'middleware' => ['web', 'auth'],
    'namespace' => 'Lembarek\UploadManager\Controllers',
    'prefix' => 'dashboard',
], function () {

    Route::get('/upload/manager', [
        'as' => 'upload.manager',
        'uses' => 'UploadController@index',
    ]);

    Route::post('/upload/file', [
        'as' => 'upload.file',
        'uses' => 'UploadController@uploadFile',
    ]);

    Route::delete('/upload/file', [
        'as' => 'upload.file',
        'uses' => 'UploadController@deleteFile',
    ]);

    Route::post('/upload/folder', [
        'as' => 'upload.folder',
        'uses' => 'UploadController@createFolder',
    ]);

    Route::delete('/upload/folder', [
        'as' => 'upload.folder',
        'uses' => 'UploadController@deleteFolder',
    ]);

});
