<div class="left-sliding-panel change-product" data-panel="change-product">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Change Product</h3>
      <span class="glyphicon glyphicon-remove close-product-panel" aria-hidden="true"></span>
    </div>

    <div class="panel-body">
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

        <ul class="">
          <?php
            

           foreach($this->config->item('surfaces') as $k => $srfc): 
              if(!isset($array[$srfc->type])) continue;

              if($srfc->type == 'EMBROIDERY' && !bits($template->options, TEMPLATE_OPTION_MONOCHROME))
                continue;

              $url = $srfc->default_product ? product_url($lastname, $template, $srfc, (object)array('id' => $srfc->default_product)) :
               products_url($template, $srfc);
            ?>
            <li>
              <a href="<?php echo $url;?>">
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
      </div>
    </div>
  </div>
</div>