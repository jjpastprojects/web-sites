<?php

Route::group([
    'as' => '{{name}}::',
    'middleware' => ['web'],
    'namespace' => '{{Vendor}}\{{Name}}\Controllers'
], function () {


});
