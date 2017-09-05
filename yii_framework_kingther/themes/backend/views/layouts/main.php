<?php
Yii::app()->clientscript
// use it when you need it!
/*
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css' )
  ->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css' )
  ->registerCoreScript( 'jquery' )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
  ->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->bootstrap->register(); ?>
        <meta name="language" content="en" />
        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
        <!-- Le fav and touch icons -->
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><?php echo Yii::app()->name ?></a>
                    <div class="nav-collapse">
                        <?php
                        if(!Yii::app()->user->isGuest)
                            $this->widget('zii.widgets.CMenu', array(
                                'htmlOptions' => array('class' => 'nav'),
                                'activeCssClass' => 'active',
                                'items' => array(
                                    array('label' => 'Home', 'url' => array('/backend/site/index')),
                                    array('label' => 'Pages', 'url' => array('/backend/page/admin')),
                                    array('label' => 'Features', 'url' => array('/backend/feature/admin')),
                                    array('label' => 'Listings', 'url' => array('/backend/listing/admin')),
                                    array('label' => 'Reviews', 'url' => array('/backend/review/admin')),
                                    array('label' => 'SEO Data', 'url' => array('/backend/seoData/admin')),
									array('label' => 'Change Password', 'url' => array('/backend/user/profile/changepassword')),
									array('label' => 'Backup', 'url' => array('/backend/site/dump')),
                                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/backend/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                                ),
                            ));
                        ?>

                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="cont">
            <div class="container-fluid">
                <?php if (!Yii::app()->user->isGuest && isset($this->breadcrumbs)): ?>
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                        'homeLink' => false,
                        'tagName' => 'ul',
                        'separator' => '',
                        'activeLinkTemplate' => '<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
                        'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                        'htmlOptions' => array('class' => 'breadcrumb')
                    ));
                    ?>
                    <!-- breadcrumbs -->
                <?php endif ?>

                <?php echo $content ?>


            </div><!--/.fluid-container-->
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">                    
                    <div id="footer-terms" class="col-md-3">
                        © 2012-13 Chiromonkey.com &dagger;
                    </div> <!-- /.span6 -->
                </div> <!-- /row -->
            </div> <!-- /container -->
        </div>
    </body>
</html>
