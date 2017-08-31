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

    <!-- App styles -->
    <link rel="stylesheet" href="/theme/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="/theme/fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="/theme/styles/style.css">

    <script src="/theme/vendor/jquery/dist/jquery.min.js"></script>
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
                        <li><a href="/auth/logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li>
                        <a href="/auth/logout">
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
                <a href="/customer/profile">
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
                            <small class="text-muted">Customer <b class="caret"></b></small>
                        </a>
                        <ul class="dropdown-menu animated flipInX m-t-xs">
                            <li><a href="/customer/profile"><i class="fa fa-user"></i>&nbsp;&nbsp; Profile</a></li>
                            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php 
                $uri = $this->uri->segment(2);
            ?>
            <ul class="nav metismenu" id="side-menu">
                <li class="<?php echo($uri=='orders'?'active':'');?>">
                    <a href="/customer/orders"><span class="nav-label"><i class="fa fa-list"></i>&nbsp;&nbsp;Orders</span></a>
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
                Customer Panel
            </span>
            <?php echo $this->config->item('site_title');?> &copy;<?php echo date('Y');?>
        </footer>

    </div>

    <!-- Vendor scripts -->
    <script src="/theme/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/theme/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/theme/vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="/theme/vendor/iCheck/icheck.min.js"></script>
    <!-- App scripts -->
    <script src="/theme/scripts/homer.js"></script>
</body>
</html>