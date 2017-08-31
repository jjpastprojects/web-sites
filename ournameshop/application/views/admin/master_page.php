<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title><?php echo $title ? $title : $this->config->item('site_title');?></title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="/theme/vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/theme/vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="/theme/vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="/theme/vendor/bootstrap/dist/css/bootstrap.css" />
    <link href="/js/fancybox/jquery.fancybox.css" rel="stylesheet">

    <!-- App styles -->
    <link rel="stylesheet" href="/theme/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="/theme/fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="/theme/styles/style.css">

    <script src="/theme/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/theme/vendor/jquery-ui/jquery-ui.min.js"></script>
</head>
<body>

    <!-- Simple splash screen-->
    <?php $this->load->view('admin/splash.inc.php');?>
    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Header -->
    <div id="header">
        <div class="color-line">
        </div>
        <div id="logo" class="light-version">
            <a href="/"><span><?php echo $this->config->item('site_title');?></span></a>
        </div>
        <nav role="navigation">
            <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
            <div class="small-logo">
                <a href="/"><span class="text-primary"><?php echo $this->config->item('site_title');?></span></a>
            </div>
            <form role="search" class="navbar-form-custom" method="post" action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search something special" class="form-control" name="search">
                </div>
            </form>
            <div class="mobile-menu">
                <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="collapse mobile-navbar" id="mobile-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/admin/logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li>
                        <a href="/admin/logout">
                            <i class="pe-7s-upload pe-rotate-90"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Navigation -->
    <aside id="menu">
        <div id="navigation">
            <div class="profile-picture">
                <a href="/admin/profile">
                    <?php if($user->avatar): ?>
                        <img src="<?php echo $user->avatar;?>" class="img-circle m-b" alt="logo" width="50">
                    <?php else: ?>
                        <img src="/img/member/profile.png" class="img-circle m-b" alt="logo" width="70">
                    <?php endif; ?>
                </a>
                <div class="stats-label text-color">
                    <span class="font-extra-bold font-uppercase"><?php echo $user->first_name.' '.$user->last_name; ?></span>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <small class="text-muted">Administrator <b class="caret"></b></small>
                        </a>
                        <ul class="dropdown-menu animated flipInX m-t-xs">
                            <li><a href="/admin/profile"><i class="fa fa-user"></i>&nbsp;&nbsp; Profile</a></li>
                            <li><a href="/admin/logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php 
                $uri = $this->uri->segment(2);
            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="<?php echo($uri=='dashboard'?'active':'');?>">
                    <a href="/admin/dashboard"><span class="nav-label"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard</span></a>
                </li>

                <li class="<?php echo($uri=='shops'||$uri=='orders'||$uri=='customers'?'active':'');?>">
                    <a href="#"><span class="nav-label"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Shops</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php echo($uri=='shops'?'active':'');?>">
                            <a href="/admin/shops"><i class="fa fa-list"></i>&nbsp;&nbsp;<span>List</span></a>
                        </li>
                        <li class="<?php echo($uri=='orders'?'active':'');?>">
                            <a href="/admin/orders"><i class="fa fa-dollar"></i>&nbsp;&nbsp;<span>Orders</span></a>
                        </li>
                        <li class="<?php echo($uri=='customers'?'active':'');?>">
                            <a href="/admin/customers"><i class="fa fa-user"></i>&nbsp;&nbsp;<span>Customers</span></a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo($uri=='products'||$uri=='featured'||$uri=='sndfeatured'||$uri=='product_types'||$uri=='presets'?'active':'');?>">
                    <a href="#"><span class="nav-label"><i class="fa fa-product-hunt"></i>&nbsp;&nbsp;Products</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php echo($uri=='products'?'active':'');?>">
                            <a href="/admin/products"><i class="fa fa-list"></i>&nbsp;&nbsp;<span>List</span></a>
                        </li>
                        <li class="<?php echo($uri=='featured'?'active':'');?>">
                            <a href="/admin/featured"><i class="fa fa-gift"></i>&nbsp;&nbsp;&nbsp;<span>Featured</span></a>
                        </li>
                        <li class="<?php echo($uri=='sndfeatured'?'active':'');?>">
                            <a href="/admin/sndfeatured"><i class="fa fa-diamond"></i>&nbsp;&nbsp;<span>2nd Featured</span></a>
                        </li>
                        <li class="<?php echo($uri=='product_types'?'active':'');?>">
                            <a href="/admin/product_types"><i class="fa fa-tasks"></i>&nbsp;&nbsp;<span>Product Types</span></a>
                        </li>
                        <li class="<?php echo($uri=='presets'?'active':'');?>">
                            <a href="/admin/presets"><i class="fa fa-cog"></i>&nbsp;&nbsp;<span>Presets</span></a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo($uri=='lastname_requests'||$uri=='lastnames'?'active':'');?>">
                    <a href="#"><span class="nav-label"><i class="fa fa-users"></i>&nbsp;&nbsp;Lastnames</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php echo($uri=='lastname_requests'?'active':'');?>">
                            <a href="/admin/lastname_requests"><i class="fa fa-signal"></i>&nbsp;&nbsp;<span>Requests</span></a>
                        </li>
                        <li class="<?php echo($uri=='lastnames'?'active':'');?>">
                            <a href="/admin/lastnames"><i class="fa fa-list"></i>&nbsp;&nbsp;<span>List</span></a>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo($uri=='templates'||$uri=='pricing_tool'||$uri=='logo_types'||$uri=='categories'||$uri=='bulk_import'?'active':'');?>">
                    <a href="#"><span class="nav-label"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Logotypes</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li class="<?php echo($uri=='templates'?'active':'');?>">
                            <a href="/admin/templates"><i class="fa fa-puzzle-piece"></i>&nbsp;&nbsp;<span>Templates</span></a>
                        <li>
                        <li class="<?php echo($uri=='pricing_tool'?'active':'');?>">
                            <a href="/admin/pricing_tool"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;<span>Pricing Tool</span></a>
                        </li>
                        <li class="<?php echo($uri=='logo_types'?'active':'');?>">
                            <a href="/admin/logo_types"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<span>Folders</span></a>
                        </li>
                        <li class="<?php echo($uri=='categories'?'active':'');?>">
                            <a href="/admin/categories"><i class="fa fa-cubes"></i>&nbsp;<span>Categories</span></a>
                        </li>
                        <li class="<?php echo($uri=='bulk_import'?'active':'');?>">
                            <a href="/admin/bulk_import"><i class="fa fa-clone"></i>&nbsp;&nbsp;<span>Bulk Import</span> </a>
                        </li>
                    </ul>
                </li>
                
                <li class="<?php echo($uri=='meta_tags'?'active':'');?>">
                    <a href="/admin/meta_tags"><i class="fa fa-tags"></i>&nbsp;&nbsp;<span>Meta Tags</span></a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div id="wrapper">
        <?php echo $content;?>

        <!-- Footer-->
        <footer class="footer">
            <span class="pull-right">
                Admin Panel
            </span>
            <?php echo $this->config->item('site_title');?> &copy;<?php echo date('Y');?>
        </footer>

    </div>

    <!-- Vendor scripts -->
    <script src="/theme/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/theme/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/theme/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/theme/vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="/theme/vendor/iCheck/icheck.min.js"></script>
    <script src="/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/theme/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/theme/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/jquery.ui.widget.js"></script>
    <script src="/js/jquery.fileupload.js"></script>
    <!-- App scripts -->
    <script src="/js/member/admin_custom.js"></script>
    <script src="/theme/scripts/homer.js"></script>
</body>
</html>