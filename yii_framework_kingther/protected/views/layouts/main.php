<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php
        Yii::app()->controller->widget('ext.seo.widgets.SeoHead', array(
            'httpEquivs' => array(
                'Content-Type' => 'text/html; charset=utf-8',
                'Content-Language' => 'en-US'
            ),
            'defaultDescription' => 'Find the right chiropractic software for your office. Chiromonkey provides trusted software reviews for chiropractors shopping for EMR and billing software.',
            'defaultKeywords' => 'chiropractic software, chiropractic billing software, chiropractic software reviews, ehr software, chiromonkey',
            'defaultProperties' => array(
                'robots' => '',
                'copyright' => 'copyright 2007 chiropractic office software http://www.chiromonkey.com/',
                'revisit-after' => '15 days',
                'rating' => 'general',
            ),
        ));
        ?>
        <?php Yii::app()->bootstrap->register(); ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <style>
            .cse .gsc-control-cse, .gsc-control-cse {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                border: none !important;
            }
        </style>
	<script type="text/javascript" src="http://www.chiromonkey.com/popup-domination/js.php?popup=1"></script>
	<script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
		Date();a=s.createElement(o),

		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js
		','ga');
		ga('create', 'UA-3916091-2', 'auto');
		ga('send', 'pageview');

	</script>
	</head>
    <body>
        <div id="fb-root"></div>
        <!-- Facebook -->
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- Twitter -->
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="container" id="page">
            <div id="header">
                <div class="row-fluid top-menu">
                    <div class="span9 navs text-right">
                        <div class="social-buttons pull-left">
                            <div class="fb-like" data-href="https://facebook.com/chiromonkey" data-width="100" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                            <a href="https://twitter.com/Chiro_Monkey" class="twitter-follow-button" data-show-count="false">Follow @Chiro_Monkey</a>
                        </div>
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/">Home</a> | 
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/about_us.html">About Us</a> | 
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/external_software_links.html">Chiropractic Software Links</a>
                    </div>
                    <div class="span3 last search-box ">
                        <script>
                            (function() {
                                var cx = '004010262661143051103:c41wmt9yrc0';
                                var gcse = document.createElement('script');
                                gcse.type = 'text/javascript';
                                gcse.async = true;
                                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                                        '//www.google.com/cse/cse.js?cx=' + cx;
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(gcse, s);
                            })();
                            
                            $(function(){
                                $('input.gsc-search-button[type=button]').live('click', function() {
                                    $('#content').hide();
                                });
                                $('input.gsc-input[type=text]').live('keydown', function (event) {
                                    if (event.keyCode && event.keyCode == '13') {
                                        $('#content').hide();
                                    }
                                });
                            });
                        </script>
                        <gcse:searchbox></gcse:searchbox>
                    </div>

                </div>
                <div class="row-fluid">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/chiropractic-software-reviews.png" class="banner" alt="Chiropractic Software Reviews by ChiroMonkey" />
                </div>
            </div><!-- header -->

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                <div class="text-center notice">
                    All trademarks and copyrights mentioned hereon are those of their respective companies and owners. ChiroMonkey Inc. does not provide, nor imply, any warranty or guarantee concerning the accuracy of the information found on this website and cannot be held liable for errors or omissions of any nature. You are strongly encouraged to contact these vendors further to confirm their latest product and pricing details and information.
                </div>
                <hr/>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/home.html">Home</a> | 
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/copyright.html">Copyright</a> | 
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/privacy_policy.html">Privacy Policy</a> | 
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/terms_of_use.html">Terms Of Use</a> | 
                <a href="http://freechiropracticsoftware.com">Free Chiropractic Software</a> | 
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/chiropractic_billing_software.html">Billing Software for Chiropractors</a>
                <br/>
                Copyright &copy; <?php echo date('Y'); ?> by Chiromonkey.com.<br/>
                All Rights Reserved.<br/>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/chiropractic_software_banana.gif" class="banana" alt="Chiropractic Software Reviews by ChiroMonkey" />
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>