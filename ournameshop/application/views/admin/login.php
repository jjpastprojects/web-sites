<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Admin Login</title>
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
</head>
<body class="blank">

<!-- Simple splash screen-->
<?php $this->load->view('admin/splash.inc.php');?>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line"></div>

<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Admin Sign in</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                  <form action="/auth/login" method="post" id="loginForm">
                      <?php if(!empty($message)): ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $message;?>
                        </div>
                      <?php endif; ?>
                      <div class="form-group">
                          <label class="control-label" for="username">Email</label>
                          <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="" value="" name="email" id="username" class="form-control">
                          <span class="help-block small">Your email to app</span>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="password">Password</label>
                          <input type="password" title="Please enter your password" placeholder="********" required="" value="" name="password" id="password" class="form-control">
                          <span class="help-block small">Your strong password</span>
                      </div>
                      <div class="checkbox">
                          <input type="checkbox" class="i-checks" name="remember" value="TRUE" checked>
                               Remember login
                          <p class="help-block small">(if this is a private computer)</p>
                      </div>
                      <button class="btn btn-success btn-block">Login</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo date('Y');?> Copyright <?php echo $this->config->item('site_title');?>
        </div>
    </div>
</div>

<!-- Vendor scripts -->
<script src="/theme/vendor/jquery/dist/jquery.min.js"></script>
<script src="/theme/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="/theme/vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/theme/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/theme/vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="/theme/vendor/iCheck/icheck.min.js"></script>
<script src="/theme/vendor/sparkline/index.js"></script>

<!-- App scripts -->
<script src="/theme/scripts/homer.js"></script>

</body>
</html>