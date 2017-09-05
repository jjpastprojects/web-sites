<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(["before" => "guest"] , function(){
    
     Route::any("/",[
        "as" => "home",
        "uses" => "HomeController@showHome"
    ]);
     
    Route::any("/login",[
        "as" => "user/login",
        "uses" => "UserController@loginAction"
    ]);
    
    Route::any("/request",[
        "as" => "user/request",
        "uses" => "UserController@requestAction"
    ]);

    Route::any("/reset",[
        "as" => "user/reset",
        "uses" => "UserController@resetAction"
    ]);
    
    Route::any("/register",[
        "as" => "user/register",
        "uses" => "UserController@registerAction"
    ]);
});

Route::group(["before" => "auth"] , function(){
    
    Route::any("/profile",[
        "as" => "user/profile",
        "uses" => "UserController@profileAction"
    ]);
    
    Route::any("/logout",[
        "as" => "user/logout",
        "uses" => "UserController@logoutAction"
    ]);

    
});



