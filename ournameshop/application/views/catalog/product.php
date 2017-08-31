<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="product-holder">
  <div class="container">

    <h3 class="margin-top hidden-sm hidden-md hidden-lg">
      <?php echo $product->model;?>
    </h3>

    <div class="fast-switch-product clearfix text-center">
      <?php
        $array = array(
          'T-SHIRT'         => 'adix1.png',
          'HOODIE'          => 'adix2.png',
          'MUG'             => 'adix3.png',
          'EMBROIDERY'      => 'adix4.png',
          'BIB'             => 'adix5.png',
          'APRON'           => 'adix6.png',
          'PHONE-CASE'      => 'adix7.png',
          'POSTER'          => 'adix8.png'
        );
      ?>

      <ul class="hidden-xs">
        <?php


         foreach($this->config->item('surfaces') as $k => $srfc):
            if(!isset($array[$srfc->type])) continue;

            if($srfc->type == 'EMBROIDERY' && !bits($template->options, TEMPLATE_OPTION_MONOCHROME))
              continue;

            $url = $srfc->default_product ? product_url($lastname, $template, $srfc, (object)array('id' => $srfc->default_product)) :
             products_url($template, $srfc);
          ?>
          <li>
            <a href="<?php echo $url;?>" <?php if($surface->type == $srfc->type) echo ' class="selected"';?>>
              <div class="av1">
                <img alt="" src="/img/<?php echo $array[$srfc->type];?>">
              </div>
              <div class="nd1">
                <?php echo $srfc->name;?>
              </div>
            </a>
          </li>
        <?php endforeach;?>
      </ul>

      <div class="hidden-sm hidden-md hidden-lg">
        <select class="form-control input-lg">
          <?php foreach($this->config->item('surfaces') as $k => $srfc):
              if(!isset($array[$srfc->type])) continue;

              if($srfc->type == 'EMBROIDERY' && !bits($template->options, TEMPLATE_OPTION_MONOCHROME))
                continue;

              $url = $srfc->default_product ? product_url($lastname, $template, $srfc, (object)array('id' => $srfc->default_product)) :
               products_url($template, $srfc);
            ?>
            <option value="<?php echo $url;?>"<?php if($surface->type == $srfc->type) echo ' selected';?>>
              <?php echo $srfc->name;?>
            </option>
          <?php endforeach;?>
        </select>
      </div>
    </div>


    <?php $this->load->view('catalog/campaign.inc.php');?>

    <form action="" method="" class="product-chooser-frm">
      <input type="hidden" name="tpl_id" value="<?php echo $template->id;?>" />
      <input type="hidden" name="lastname_id" value="<?php echo $lname->id;?>" />

      <input type="hidden" name="surface_id" value="<?php echo current($variants)->id;?>" />
      <input type="hidden" name="surface_type" value="<?php echo $surface->type;?>" />
      <input type="hidden" name="surface_product_id" value="<?php echo $product->id;?>" />

      <input type="hidden" name="custom_print_file" value="" />

      <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-m1d-offset-2 col-sm1-offset-1 col-lg-offset-1">
          <?php if($product->preview_thumb || TRUE):;?>
            <div class="product-preview<?php if($product->preview_thumb) echo ' overlay-color';?>">
              <img src="<?php echo $product_img;?>" alt="" class="surface <?php echo $surface->css_class;?>" />

              <div class="canvas-holder <?php echo $surface->css_class;?>">
                <div class="corner tr"></div>
                <div class="corner tl"></div>
                <div class="corner br"></div>
                <div class="corner bl"></div>
                <canvas id="canvas-logo" class="tpl-thumb <?php echo $surface->css_class;?>"></canvas>
              </div>
            </div>
          <?php else:?>
            <div class="product-preview">
              <img src="<?php echo current($variants)->image;?>" alt="" class="surface" />
            </div>
          <?php endif;?>

          <?php if($template->print_designer || TRUE):?>

            <div class="margin-top text-center add-text-zoom">
              <div class="row">
                <div class="col-xs-6">
                  <a href="#" class="btn btn-block btn-lg btn-default fancybox.ajax open-text-designer">
                    <span class="glyphicon glyphicon-text-size"></span>
                    Add Custom Text
                  </a>
                </div>
                <div class="col-xs-6">
                  <a href="#" class="btn btn-block btn-lg btn-default zoom-lnk hidden">
                    <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                    Zoom In
                  </a>
                  <?php /*<a href="/print_designer?tpl_id=<?php echo $template->id;?>" class="btn btn-warning make-custom-print">
                    Make Custom Print
                  </a>*/?>
                </div>
              </div>
            </div>
          <?php endif;?>

          <?php $this->load->view('print_designer/print_designer_panel');?>
        </div>

        <div class="col-lg-6 col-md-5 col-sm-4">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div>
                <h3 class="no-margin-top hidden-xs product-name">
                  <?php echo $template->f_name;?>
                </h3>

                <span><b>Product:</b></span>
                <span class="product-model text-muted"><?php echo $product->model;?></span>

                <p class="text-muted" style="margin-top: 15px;">
                  <?php if($product->description):?>
                    <?php echo $product->description;?>
                  <?php else:?>
                    A tee that represents thoughts and feelings about riding or the types of
                    bicycles we love. Hapinness, Fun, Health, Freedom, Exploration, Camaraderie,
                    Community, Environment&hellip;
                  <?php endif;?>
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-8">

              <?php if($avail_styles && sizeof($avail_styles) > 1):?>
                <div>
                  <select data-change-product class="form-control input-lg hidden">
                    <?php foreach($avail_styles as $as):?>
                      <option value="<?php echo $as->id;?>"<?php if($as->id == $product->id) echo ' selected';?>>
                        <?php echo $as->model;?>
                      </option>
                    <?php endforeach;?>
                  </select>

                  <div class="other-styles">
                    <a href="#" class="btn choose-available-styles" style="margin-right: 10px;">
                      See More Styles
                      <span class="caret"></span>
                    </a>
                    <small>
                    <a href="<?php echo products_url($template, $surface);?>" class="text-muted">View All</a>
                  </small>
                    <div class="avail-styles-holder">
                      <?php foreach($avail_styles as $as):?>
                        <div class="row avail-style<?php if($as->id == $product->id) echo ' avail-style-current';?>"
                        data-avail-style-id="<?php echo $as->id;?>" data-avail-style-name="<?php echo $as->model;?>">
                          <div class="col-sm-4">
                            <img src="<?php echo product_thumb($as);?>" class="img-thumbnail img-responsive" />
                          </div>
                          <div class="col-sm-8">
                            <h4>
                              <?php echo $as->model;?>
                            </h4>
                          </div>
                        </div>
                      <?php endforeach;?>
                    </div>
                  </div>
                </div>
              <?php endif;?>

              <?php if($product->type == 'PHONE-CASE'):?>
                <div class="form-group">
                  <label>Phone Model</label>
                  <select required class="form-control phone-case-model">
                    <?php foreach($variants as $variant):?>
                      <option value="<?php echo $variant->id;?>" data-img="<?php echo $variant->image;?>">
                        <?php echo $variant->name;?>
                      </option>
                    <?php reset($variants); endforeach;?>
                  </select>
                </div>
              <?php endif;?>

              <div class="size-and-color">
                <ul class="nav nav-tabs" role="tablist">
                  <?php if($has_colors):?>
                    <li role="presentation">
                      <a href="#surface-color" aria-controls="surface-color" role="tab" data-toggle="tab">
                        <?php echo singular($surface->name);?> Color
                      </a>
                    </li>
                  <?php endif;?>
                  <li role="presentation">
                    <a href="#logo-color" aria-controls="logo-color" role="tab" data-toggle="tab">
                      Logo Color
                    </a>
                  </li>
                </ul>

                <div class="tab-content">
                  <?php if($has_colors):?>
                    <div role="tabpanel" class="tab-pane" id="surface-color">
                      <div class="color-holder margin-top">
                        <?php $k = 0; foreach($by_color as $color => $v):?>
                          <div data-color-code="<?php echo $color;?>" class="color <?php if($k == 0) echo ' active';?>"
                          style="background: <?php echo $color;?>" title="<?php echo $v[0]->color.':'.$v[0]->color_code;?>"></div>
                        <?php $k++; endforeach;?>
                      </div>

                    </div>
                  <?php endif;?>

                  <div role="tabpanel" class="tab-pane" id="logo-color">
                    <!-- Added By Glado 2016/5/10 START -->
                    <div class="margin-top" id="control_panel">
                      <input type="checkbox" name="invert_color" value="" id="invert_color_btn"> 
                        <label class="normal-text" for="invert_color_btn">Reverse Color</label><br>
                      <input type="checkbox" name="choose_color_btn" value="" id="choose_color_btn">
                        <label class="normal-text" for="choose_color_btn">Convert to a Single Color</label><br>
                      <input type="checkbox" name="adjust_color_btn" value="" id="adjust_color_btn">
                        <label class="normal-text" for="adjust_color_btn">Adjust Color Hue</label><br>
                    </div>
                    <div class="form-group" id="choose_color_panel" style="display: none;">
                      <div class="margin-top choose_colors">
                        <?php
                         $predefined_colors = array('#000000', '#666b6f', '#cbc5cf', '#fefefe', '#a33033', '#FE0000', '#e8122e', '#f6cacb', '#f8afc3', 
                                                    '#eb539e', '#df219d', '#ef6a01', '#f99a0c', '#ffb514', '#cd9864', '#853f0e', '#a48206', '#828304', 
                                                    '#d7b613', '#ffff00', '#f4ed7b', '#225a33', '#025239', '#007272', '#56ab1a', '#a9dd6e', '#003466', 
                                                    '#0038a9', '#3d00de', '#a9cee1', '#00bce2', '#5b1960', '#492f94', '#bf94ca', '#930142');
                          $k = 0; foreach ($predefined_colors as $val): ?>
                        <div data-color-code="<?php echo $val;?>" class="lcol" style="background: <?php echo $val;?>"></div>
                      <?php $k++; endforeach; ?>
                      </div>
                      <button type="button" class="btn" id="return_btn">Back</button>
                    </div>
                    <div class="form-group" id="adjust_color_panel" style="display: none;">
                      <?php if($product->type == 'EMBROIDERY'):?>
                        <div class="embroidery-color-holder margin-top">
                          <?php $k = 0; foreach($product->options['thread_colors']->values as $color => $v):?>
                            <div data-color-code="<?php echo $color;?>" class="color<?php if($color == '#000000') echo ' active';?>" style="background: <?php echo $color;?>"></div>
                          <?php $k++; endforeach;?>
                        </div>
                      <?php else:?>
                        <div class="margin-top">
                          <?php $this->load->view('print_designer/hue_holder.inc.php');?>
                        </div>
                      <?php endif;?>
                    </div>
                    <!-- Added By Glado 2016/5/10 END -->
                  </div>
                </div>

                <?php if($has_sizes):?>
                  <div class="row">
                    <div class="col-sm-12 col-md-9">
                      <div class="form-group size margin-top" style="margin-bottom: 10px;">
                        <label>Select a Size</label>
                        <select required name="params[size]" class="form-control size-sel input-lg">
                          <option value="">Choose</option>
                          <?php foreach($by_size as $size => $v):?>
                            <option value="<?php echo $size;?>">
                              <?php echo $size;?>
                            </option>
                          <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php endif;?>
              </div>
              </div>
            </div>
            <hr  class="<?php if($has_colors || $has_sizes) echo 'hidden ';?>button-q"/>
            <div class="<?php if($has_colors || $has_sizes) echo 'hidden ';?>button-q margin-top">
              <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-2 text-center" style="padding-right: 0;">
                  <input type="text" min="1" name="q" value="1" class="input-lg form-control text-center quantity" placeholder="quantity" />
                </div>
                <div class="col-xs-1 col-sm-3 col-md-1" style="padding-left: 10px;">
                  <i class="fa fa-caret-up q-up" data-q="1"></i>
                  <i class="fa fa-caret-down q-down" data-q="-1"></i>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5" style="padding: 0px 8px;">
                  <button type="submit" data-price="<?php echo current($variants)->price;?>" class="btn custom-danger btn-block">
                    BUY NOW $<?php echo current($variants)->price;?>
                  </button>
                </div>
                <?php if(is_main_shop($shop)):?>
                  <div class="col-xs-12 col-sm-12 col-md-4" style="padding: 0px 8px;">
                    <a href="#"
                    class="btn btn-default custom-default btn-block start-sell-this">
                      SELL THIS
                    </a>
                  </div>
                <?php endif;?>
              </div>
            </div>
          

          <?php /*
          <select class="form-control test-chosen" name="font_family">
            <?php foreach($this->config->item('print_fonts') as $k => $font):?>
              <option value="<?php echo $k;?>" data-font-family="<?php echo $font['family'];?>">
                <?php echo $font['name'];?>
              </option>
            <?php endforeach;?>
          </select> */?>

          <?php if($this->ion_auth->is_admin()):?>
            <hr />
            <div class="margin-bottom">
              <a href="#" data-preset="1" class="btn btn-info save-preset">
                Save to presets
              </a>

              <div class="margin-top">
                <h5>Default Combination</h5>

                <div class="row">
                  <div class="col-sm-6">
                    <input type="file" id="def-comb-listing-img" name="file" />

                    <div class="margin-top">
                      <a href="#" data-def-comb="1" class="btn btn-info save-preset">
                        Make
                      </a>

                      <a href="#" data-def-comb="1" data-clear="1" class="btn btn-danger save-preset">
                        Clear
                      </a>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <img src="<?php echo $def_comb_has_listing_image ? product_thumb((object)array('image' => $def_comb->listing_image), 'listing') : '';?>" class="preview-def-listing-img img-thumbnail img-responsive <?php if(!$def_comb_has_listing_image) echo 'hidden';?>" />
                  </div>
                </div>
              </div>
            </div>
          <?php endif;?>

          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="listSoc1 margin-top">
                <h5 style="font-weight: bold;">Share This:</h5>
                <ul>
                  <li>
                    <a class="s1" href="#" data-sharer-network="facebook"> </a>
                  </li>
                  <li>
                    <a class="s2" href="#" data-sharer-network="twitter"> </a>
                  </li>
                  <li>
                    <a class="s3" href="#" data-sharer-network="pinterest"> </a>
                  </li>
                  <li>
                    <a class="s4" href="#" data-sharer-network="google"> </a>
                  </li>
                  <li>
                    <a class="s5" href="#" data-sharer-network="linkedin"> </a>
                  </li>
                  <?php if($this->user_id):?>
                    <li class="hidden">
                      <a title="add to collection" class="f7 add-to-col" href="#"></a>
                    </li>
                  <?php endif;?>
                </ul>
              </div>
            </div>
          </div>

          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="wtt-holder">
  <h1 class="wtt">
    Want to try a different name?
  </h1>

  <a href="#" class="smb open-floating-search">
    SEARCH MORE BRANDS
  </a>
</div>

<script src="/js/spectrum/spectrum.js"></script>

<div class="hidden" id="zoom-container"></div>

<?php if($template->print_designer && FALSE):?>
  <script src="/js/jquery-ui.min.js"></script>
  <script src="/js/jquery.mousewheel.min.js"></script>
<?php endif;?>

<script src="/js/colorpicker/js/bootstrap-colorpicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="/js/colorpicker/css/bootstrap-colorpicker.min.css" />

<script src="/js/print_designer.js"></script>
<script src="/js/sharer.js"></script>

<?php if($campaign):?>
  <script src="/js/jquery.countdown.min.js"></script>
<?php endif;?>


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
        scales: [150, 150, 150, 100],

        joiner: {
          top: 110,
          left: 85,
          scale: 0.8
        }
      },

      'HOODIE': {
        scales: [150, 150, 150, 100],

        joiner: {
          top: 110,
          left: 85,
          scale: 0.8
        }
      },

      'MUG': {
        scales: [200, 200, 200, 130],
        // cwidth:   200,
        cheight:  400,//154
        logo_scale:    1.25,

        joiner: {
          top: 95,
          left: 35,
          scale: 0.8
        }
      },

      'EMBROIDERY': {
        logo_scale:    0.5,
        // cwidth:   250,
        // cheight:  90
        cwidth:   300,
        cheight:  109,
        scales: [250, 250, 250, 150],

        joiner: {
          top: 110,
          left: 85,
          scale: 0.8
        }
      },

      'POSTER': {
        scales: [166, 165, 172, 125],
        // cwidth:   390,
        cheight:  376,

        joiner: {
          top: 65,
          left: 105,
          scale: 0.7
        }
      },

      'FRAMED-POSTER': {
        scales: [90, 90, 93, 60],
        // cwidth:   390,
        cheight:  385,

        joiner: {
          top: 55,
          left: 117,
          scale: 0.7
        }
      },

      'CARD': {
        scales: [90, 90, 93, 60],
        // cwidth:   390,
        cheight:  385,

        joiner: {
          top: 70,
          left: 105,
          scale: 0.8
        }
      },

      'TOTE-BAG': {
        scales: [150, 150, 150, 100],
        cheight:  385,

        joiner: {
          top: 200,
          left: 90,
          scale: 0.8
        }
      },

      'PHONE-CASE': {
        scales: [200, 150, 150, 115],
        cheight:  550,

        joiner: {
          top: 180,
          left: 45,
          scale: 1
        }
      },

      'BIB': {
        scales: [200, 150, 150, 115],
        cheight:  250,

        joiner: {
          top: 95,
          left: 50,
          scale: 0.5
        }
      },

      'APRON': {
        scales: [200, 150, 150, 115],
        cheight:  250,

        joiner: {
          top: 114,
          left: 40,
          scale: 0.6
        }
      },
    };

    function open_customizer_panel(panel)
    {
      panel.removeClass('hidden');
      panel.addClass('active');
    }

    function close_customizer_panel(panel)
    {
      panel.addClass('hidden');
      panel.removeClass('active');
    }
</script>


<?php $this->load->view('catalog/product_customizer_scripts');?>