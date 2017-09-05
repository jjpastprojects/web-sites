<?php

Route::group([
    'as' => 'blog::',
    'middleware' => ['web'],
    'namespace' => 'Lembarek\Blog\Controllers',
    'prefix' => 'blog',
], function () {

    Route::get('', [
        'as' => 'posts',
        'uses' => 'BlogsController@posts',
        ]);

    Route::get('/tag/{tag_name}', [
        'as' => 'posts_with_tag',
        'uses' => 'BlogsController@PostsWithTag',
        ]);

    Route::get('/categories', [
        'as' => 'categories',
        'uses' => 'CategoriesPostsController@index',
        ]);


    Route::get('/categories/{category}/posts', [
        'as' => 'categories.posts',
        'uses' => 'CategoriesPostsController@posts',
        ]);


    Route::get('/search', [
        'as' => 'search',
        'uses' => 'BlogsController@search',
        ]);

    Route::get('/rss', [

        'as' => 'rss',
        'uses' => 'RssController@rss',
        ]);

    Route::get('/recent', [
        'as' => 'recent',
        'uses' => 'BlogsController@recent',
        ]);

    Route::get('/popular', [
        'as' => 'popular',
        'uses' => 'BlogsController@popular',
        ]);

    Route::get('/trending', [
        'as' => 'trending',
        'uses' => 'BlogsController@trending',
        ]);

    Route::get('/add_popularity/{post_id}/{factor_id}', [
        'as' => 'add_popularity',
        'uses' => 'PopularityController@add',
        ]);

    Route::get('/get_posts/{post}', [
        'as' => 'get_posts',
        'uses' => 'PostsController@get_posts',
        ]);

    Route::get('/{slug}', [
        'as' => 'show_post',
        'uses' => 'BlogsController@show',
        ]);

});
