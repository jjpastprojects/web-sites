<?php


Route::group([
    'namespace' => 'Lembarek\Admin\Controllers',
    'prefix' => 'dashboard',
    'as' => 'admin::',
    'middleware' => ['web','auth','AccessBackend']
],
    function () {

        Route::delete('/users/{user}/roles/{role}', [
            'as' => 'roles.users.destroy',
            'uses' => 'RoleUserController@destroy',
        ]);

        Route::post('/users/{user}', [
            'as' => 'roles.users.store',
            'uses' => 'RoleUserController@store',
            ]);

        Route::post('/categories/attach_post_to_category', [
            'as' => 'categories_posts.store',
            'uses' => 'CategoryPostController@store',
            ]);

        Route::delete('/categories/detach_post_from_category', [
            'as' => 'categories_posts.destroy',
            'uses' => 'CategoryPostController@destroy',
            ]);

        Route::resource('roles', 'RolesController');
        Route::resource('posts', 'PostsController');
        Route::resource('users', 'UsersController');
        Route::resource('tags', 'TagsController');
        Route::resource('categories', 'CategoriesController');

        Route::get('{page?}', [
            'as' => 'dashboard',
            'uses' => 'DashboardController@index',
            ]);
});
