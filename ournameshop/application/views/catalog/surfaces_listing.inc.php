<div class="row margin-top">
  <?php if(!$surfaces):?>
    <div class="alert alert-info">
      Sorry, nothing found
    </div>
  <?php else:?>
    <?php foreach($surfaces as $surface):
      $url = $surface->default_product ? product_url($lastname, $template, $surface, (object)array('id' => $surface->default_product)) :
             products_url($template, $surface);
    ?>
      <div class="col-lg-4 col-md-4 col-sm-6 item <?php echo $surface->css_class;?>">
        <div class="inner">
          <div class="img">
            <?php if($surface->type == 'EMBROIDERY' && !bits($template->options, TEMPLATE_OPTION_MONOCHROME)):?>
              <div class="disabled-overlay">
                <div class="sorry text-info">
                  Sorry, but embroidery service is not available for multi-color logos
                </div>
              </div>
            <?php endif;?>

            <a href="<?php echo $url;?>">
              <img class="surface" src="<?php echo surface_thumb($surface);?>" />
              <img src="<?php echo tpl_thumb($template, 'lo-res');?>" class="tpl-thumb <?php echo $surface->css_class;?>" alt="" />
            </a>
          </div>

          <div class="title text-center">
            <a href="<?php echo $url;?>">
              <?php echo $surface->name;?>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach;?>
  <?php endif;?>
</div>

<div class="catalog-items-overlay"></div>