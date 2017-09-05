<?php

return [
    "links" => [
        ["admin::dashboard", '', "dashboard"],
        ["admin::users.index", '', "users"],
        ["admin::posts.index", '', "posts"],
        ["admin::roles.index", '', "roles"],
        ["admin::tags.index", '', "tags"],
        ["admin::categories.index", '', "categories"],
        ["uploadManager::upload.manager", '', "upload Manager"],
        ["admin::users.show", '["username" => auth()->user()->username]', "settings"],
    ],

    'paginate' => 22,
];
