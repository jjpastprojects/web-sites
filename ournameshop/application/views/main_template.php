<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title ? $title : $shop->name;?></title>

    <meta name="description" content="<?php echo $meta_description;?>">
    <meta name="keywords" content="<?php echo $meta_keywords;?>">

    <?php echo isset($extra_meta) ? implode(PHP_EOL, $extra_meta) : '';?>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/js/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="/css/font.css" rel="stylesheet">

    <link rel="stylesheet" href="/js/spectrum/spectrum.css" />

    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/print_fonts.css" />
    <link rel="stylesheet" type="text/css" href="/css/font-awesome.css" />


    <?php if(!empty($saved_logo)):?>
      <meta property="og:image" content="<?php echo saved_logo_url($saved_logo);?>" />
      <meta property="og:title" content="<?php echo $title;?>" />
      <meta property="og:site_name" content="Ournameshop.com" />

      <meta name="twitter:card" content="summary" />
      <meta name="twitter:site" content="Ournameshop.com" />
      <meta name="twitter:title" content="<?php echo $title;?>" />
      <meta name="twitter:description" content="<?php echo $meta_description;?>" />
      <meta name="twitter:image" content="<?php echo saved_logo_url($saved_logo);?>" />
    <?php endif;?>


    <script src="/js/jquery-1.11.2.min.js"></script>

    <script src="/js/fabric.min.js"></script>
    <script src="/js/caman/caman.full.pack.js"></script>
    <script src="/js/listings.js"></script>

    <?php if(TRUE):?>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <?php endif;?>

    <?php if(is_main_shop($shop) || !$shop->custom_domain):?>
      <script>
        document.domain = '<?php echo $this->config->item('domain');?>';
      </script>
    <?php endif;?>
  </head>

  <body>
    <?php echo $content;?>

    <script src="/js/member/bootstrap.js"></script>
    <script src="/js/hello.all.min.js"></script>
    <script src="/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/js/script.js"></script>

    <script>

      var user_id = <?php echo intval($this->user_id);?>;

      $(function() {

        hello.init({
          facebook : '<?php echo $this->config->item('fb_app_id');?>',
          google   : '<?php echo $this->config->item('g_client_id');?>',
          linkedin : '<?php echo $this->config->item('li_api_key');?>'
        }, {redirect_uri:'<?php echo get_oauth_redirect_uri($shop);?>'});
      });
    </script>

    <?php $this->load->view('auth_popup');?>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-12">
            <div class="col-md-12 col-xs-12 no-padding-rl joinus-block">
              <div class="col-md-7 col-lg-8 col-xlg-7 col-xs-12 joinus">
                <label>Join with us.</label>
                <input class="" placeholder="Enter your email..." name="email"/>
                <button type="submit" class="btn">SIGN UP</button>
              </div>
              <div class="col-md-5 col-lg-4 col-xlg-5 col-xs-12 connect">
                <ul class="social-links">
                  <li class="social-label hidden-xs hidden-rlg">Connect.</li>
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-12 no-padding-rl footer-links hidden-sm hidden-xs">
              <div class="col-md-3 links">
                <h3>Shop:</h3>
                <ul>
                  <li><a href="#">Graduation</a></li>
                  <li><a href="#">Cards</a></li>
                  <li><a href="#">Gifts</a></li>
                  <li><a href="#">Décor</a></li>
                  <li><a href="#">Sale</a></li>
                </ul>
              </div>
              <div class="col-md-3 links">
                <h3>More:</h3>
                <ul>
                  <li><a href="#">eCard Studio</a></li>
                  <li><a href="#">Stories</a></li>
                  <li><a href="#">(in)courage</a></li>
                  <li><a href="#">Mary &amp; Martha</a></li>
                  <li><a href="#">Retailer Services</a></li>
                </ul>
              </div>
              <div class="col-md-3 links">
                <h3>About:</h3>
                <ul>
                  <li><a href="#">About DaySpring</a></li>
                  <li><a href="#">Ministry of Cards</a></li>
                  <li><a href="#">Our Mission and Values</a></li>
                  <li><a href="#">Terms of Use/Privacy</a></li>
                  <li><a href="#">Find A Store</a></li>
                  <li><a href="#">Job Openings (EOE)</a></li>
                </ul>
              </div>
              <div class="col-md-3 links">
                <h3>Help:</h3>
                <ul>
                  <li><a href="#">Customer Service</a></li>
                  <li><a href="#">My Account</a></li>
                  <li><a href="#">Order Tracking</a></li>
                  <li><a href="#">Shipping Information</a></li>
                  <li><a href="#">Affiliate Program</a></li>
                  <li><a href="#">Accessibility</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-12 col-xs-12 no-padding-rl contact-copyright-block">
              <div class="col-sm-5">
                <ul class="contact">
                  <li class="contact-title">Contact:</li>
                  <li class="contact-hours">
                    <span class="">1-877-751-4347</span>
                    <span class="hours">Mon-Fri 8am-5pm CST</span>
                  </li>
                </ul>
              </div>
              <div class="col-sm-7 copyright">
                <ul class="social-widgets hidden-xs hidden-sm">
                  <li>
                    <div class="fb-like" data-href="//facebook.com/dayspringfans" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false">Facebook</div>
                  </li>
                  <li><a class="twitter-follow-button" href="//twitter.com/DaySpring" data-show-screen-name="false">Twitter</a></li>
                  <li><a class="link-pinterest" href="//www.pinterest.com/dayspring/" data-pin-do="buttonFollow">DaySpring</a></li>
                </ul>
                <small>© <?php echo date('Y');?> - Ournameshop. All Rights Reserved.</small>
              </div>
            </div>
          </div>
          <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
            <img class="footer-image" alt="Encourage each other and build each other up." src="/img/pages/footer-logo.png"/>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
