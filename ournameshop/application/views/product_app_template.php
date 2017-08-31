<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title><?php echo $title ? $title : $shop->name;?></title>


    <meta name="description" content="<?php echo $meta_description;?>">
    <meta name="keywords" content="<?php echo $meta_keywords;?>">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/font.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/print_fonts.css" />
    <link href="/css/style.css" rel="stylesheet" />

    <link rel="stylesheet" href="/js/spectrum/spectrum.css" />
    <link href="/css/product_app.css" rel="stylesheet" />
    <link href="/js/fancybox/jquery.fancybox.css" rel="stylesheet">




    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/member/bootstrap.js"></script>

    <script src="/js/colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/colorpicker/css/bootstrap-colorpicker.min.css" />

    <script src="/js/sharer.js"></script>

    <script src="/js/fabric.min.js"></script>
    <script src="/js/caman.full.pack.js"></script>

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
    <?php $this->load->view('header.inc.php');?>

    <div class="product-chooser-frm">
      <?php $this->load->view('print_designer/print_designer_panel');?>
      <?php $this->load->view('print_designer/product_app_cart_panel');?>
      <?php $this->load->view('print_designer/product_app_share_panel');?>
      <?php $this->load->view('print_designer/product_app_change_product_panel.php');?>
    </div>

    <div id="designArea">
      <div id="ichabod" class="lab_designArea">
        <div class="labView<?php if($product->preview_thumb) echo ' overlay-color';?>">
          <img id="view_1_modelImage_front" class="modelImage surface" src="<?php echo $product_img;?>">
          <div class="workArea">
            <div class="product-preview">
              <div class="canvas-holder <?php echo $surface->css_class;?>">
                <div class="corner tr"></div>
                <div class="corner tl"></div>
                <div class="corner br"></div>
                <div class="corner bl"></div>
                <canvas id="canvas-logo" class="tpl-thumb <?php echo $surface->css_class;?>"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <nav class="navbar navbar-default navbar-fixed-bottom">
        <ul class="nav navbar-nav">
          <li class="active">
            <a href="#" class="open-text-designer">
              <span class="glyphicon glyphicon-font"></span>
            </a>
          </li>

          <li class="active">
            <a href="#" data-open-panel="cart">
              <span class="glyphicon glyphicon-shopping-cart"></span>
            </a>
          </li>

          <li class="active">
            <a href="#" data-open-panel="share">
              <span class="glyphicon glyphicon-share"></span>
            </a>
          </li>

          <li class="active">
            <a href="#" data-open-panel="change-product">
              <span class="glyphicon glyphicon-option-horizontal"></span>
            </a>
          </li>
        </ul>
      </nav>
    </footer>


    <script>
      var designer_configs = {
        'DIGITAL-PRODUCT': {
          // scales: [120]
          scales: [300, 150, 150, 100],

          joiner: {
            top: 0,
            left: 0,
            scale: 1
          }
        },

        'T-SHIRT': {
          // scales: [120]
          scales: [150, 150, 150, 200],

          joiner: {
            top: 110,
            left: 85,
            scale: 0.8
          }
        },

        'HOODIE': {
          scales: [150, 150, 150, 175],

          joiner: {
            top: 110,
            left: 85,
            scale: 0.8
          }
        },

        'MUG': {
          scales: [200, 200, 200, 230],
          cheight:  231,

          joiner: {
            top: 95,
            left: 35,
            scale: 0.8
          }
        },

        'EMBROIDERY': {
          logo_scale:    0.5,

          cwidth:   300,
          cheight:  109,
          scales: [250, 250, 250, 280],

          joiner: {
            top: 110,
            left: 85,
            scale: 0.8
          }
        },

        'POSTER': {
          scales: [166, 165, 172, 187],
          cheight:  376,

          joiner: {
            top: 65,
            left: 105,
            scale: 0.7
          }
        },

        'FRAMED-POSTER': {
          scales: [90, 90, 93, 60],
          cheight:  385,

          joiner: {
            top: 55,
            left: 117,
            scale: 0.7
          }
        },

        'CARD': {
          scales: [90, 90, 93, 100],

          cheight:  385,

          joiner: {
            top: 70,
            left: 105,
            scale: 0.8
          }
        },

        'TOTE-BAG': {
          scales: [150, 150, 150, 180],
          cheight:  385,

          joiner: {
            top: 200,
            left: 90,
            scale: 0.8
          }
        },

        'PHONE-CASE': {
          scales: [200, 150, 150, 400],
          cheight:  550,

          joiner: {
            top: 180,
            left: 45,
            scale: 1
          }
        },

        'BIB': {
          scales: [200, 150, 150, 240],
          cheight:  250,

          joiner: {
            top: 95,
            left: 50,
            scale: 0.5
          }
        },

        'APRON': {
          scales: [200, 150, 150, 220],
          cheight:  250,

          joiner: {
            top: 114,
            left: 40,
            scale: 0.6
          }
        },
      };
    </script>

    <script src="/js/spectrum/spectrum.js"></script>


    <script src="/js/print_designer.js"></script>
    <script src="/js/hello.all.min.js"></script>


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



    <?php $this->load->view('catalog/product_customizer_scripts');?>

    <?php $this->load->view('auth_popup');?>


    <script src="/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/product_app.js"></script>
  </body>
</html>
