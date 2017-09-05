<?php

return CMap::mergeArray(
                require(dirname(__FILE__) . '/main.php'), array(
            'components' => array(
                'urlManager' => array(
                    'showScriptName' => false,
                    'rules' => array(
                        'sitemap.xml'=>'site/sitemapxml',
                        'contact.html' => 'site/contact',
                        '<url_name:chiropractic_\w+>.html' => 'feature/view',
                        '<url_name>.html' => 'page/view',
                        'chiropractic_software/<url_name>.html' => 'listing/view',
                        'chiropractic_software/write_a_review/<listing_url_name>.html' => 'review/create',
                        'chiropractic_software/confirm_a_review/<listing_url_name>.html' => 'review/confirm',
                    ),
                ),
            )
        ));
?>
