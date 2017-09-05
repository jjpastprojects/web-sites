<?php
Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home',
));

Route::get('/terms',array(
    'as' => 'terms',
    'uses' => 'HomeController@terms',
    ));

Route::get('/about_me',array(
    'as' => 'about_me',
    'uses' => 'HomeController@AboutMe'
    ));

Route::get('/faq',array(
    'as' => 'faq',
    'uses' => 'HomeController@faq',
    ));

Route::get('/contact_us',array(
        'as' => 'contact_us',
        'uses' => 'HomeController@GetContactUs',
    ));


Route::post('/contact_us',array(
        'as' => 'contact_us',
        'uses' => 'HomeController@postContactUs',
        'before' => ['csrf'],
    ));


Route::get('/signin',array(
    'as' => 'account-sign-in',
    'uses' => 'AccountController@getSignIn'
));

Route::post('/signin',array(
    'as' => 'account-sign-in-post',
    'uses' => 'AccountController@postSignIn'
));

Route::get('/account/activate/{code}',array(
    'as' => 'account-activate',
    'uses' => 'AccountController@getActivate'
));



Route::group(array('before'=>'auth'), function(){
    Route::get('/signout',array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));
});



Route::group(array('before' => 'csrf'), function(){
    Route::post('/create',array(
        'as' => 'account-create-post',
        'uses' => 'AccountController@postCreate'
    ));
});

Route::get('/create',array(
    'as' => 'account-create',
    'uses' => 'AccountController@getCreate'
));




/* route of paypal */

Route::post('/ipn',array(
        'as' => 'ipn',
        'uses' => 'CcpController@ipn',
    ));
Route::post('/success',array(
        'as' => 'sell_success',
        'uses' => 'CcpController@sell_success',
    ));
Route::post('/cancel',array(
        'as' => 'sell_cancel',
        'uses' => 'CcpController@sell_cancel',
    ));



/* here start the ccp routes */

Route::group(array('before' => 'csrf'),function(){
    Route::group(array('before' => 'sell'),function(){
        Route::post('/sell',array(
            'as' => 'sell',
            'uses' => 'CcpController@postSell',
        ));
    });
    Route::group(array('before' => 'buy'),function(){
        Route::post('/buy',array(
            'as' => 'buy',
            'uses' => 'CcpController@postBuy',
            ));
    });
});


Route::group(array('before' => 'sell'),function(){
    Route::get('/sell',array(
    'as' => 'sell',
    'uses' => 'CcpController@getSell',
    ));
});

Route::group(array('before' => 'buy'),function(){
    Route::get('/buy',array(
        'as' => 'buy',
        'uses' => 'CcpController@getBuy',
        ));
});



// tranlation //



//Route::controller('translations', 'Barryvdh\TranslationManager\Controller');


// language chooser //

Route::get('/language',array(
        'as' => 'lang_chooser',
        'uses' => 'LanguageController@chooser',
    ));

// admin routes
//
//
Route::group(array('before' => ['auth', 'admin']),function(){

Route::get('/admin', [
    'as' => 'admin',
    'uses' => 'AdminController@index',
    ]);


Route::get('/admin/buyers/search', array(
    'as' => 'admin_buyers_search',
    'uses' => 'AdminController@getBuyers',
    ));


Route::get('/info', [
    'as' => 'info',
    'uses' => 'HomeController@info',
    ]);


Route::get('/acp/buys', array(
    'as' => 'acp.buys',
    'uses' => 'AcpController@getBuys',
    ));

});
