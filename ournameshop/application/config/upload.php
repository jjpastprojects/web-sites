<?php

$config['avatar_img'] = array(
    'path'                  => './media/avatars/',
    'url_path'              => '/media/avatars/',
);

$config['templates_img'] = array(
	'path'			=> './img/tpl/',
	'url_path'		=> '/img/tpl/'
);

$config['print_preview'] = array(
	'path'			=> './media/print_previews/',
	'url_path'		=> '/media/print_previews/',
);

$config['shop_logo'] = array(
    'path'                  => './media/logo/',
    'url_path'              => '/media/logo/',
    'allowed_types'         => 'gif|jpg|png|jpeg',
    'upload_max_size'       => 8192,
    'width'                 => 217,
    'height'                => 48,
);

$config['saved_logo'] = array(
    'path'          => './media/saved_logos/',
    'url_path'      => '/media/saved_logos/',
);

$config['tmp_path'] = './media/tmp/';

$config['featured_img'] = array(
    'path'                  => './media/featured/',
    'url_path'              => '/media/featured/',
    'allowed_types'         => 'gif|jpg|png|jpeg',
    'upload_max_size'       => 8192,
    'width'                 => 400,
    'height'                => 400,
);

$config['sndfeatured_img'] = array(
    'path'                  => './media/2ndfeatured/',
    'url_path'              => '/media/2ndfeatured/',
    'allowed_types'         => 'gif|jpg|png|jpeg',
    'upload_max_size'       => 8192,
    'width'                 => 400,
    'height'                => 400,
);