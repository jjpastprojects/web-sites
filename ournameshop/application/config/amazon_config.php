<?php

$config['amazon_api_key']               = 'AKIAI7MLZ5QXBGRKNJWQ';
$config['amazon_api_secret']            = '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';

$config['bucket']                       = 'images.ournameshop.com';
$config['saved_logos_folder']           = 'saved_logos';

return array(
    'includes' => array('_aws'),
    'services' => array(
        'default_settings' => array(
            'params' => array(
                'key'    => $config['amazon_api_key'],
                'secret' => $config['amazon_api_secret'],
                'region' => 'us-east-1'
            )
        )
    )
);