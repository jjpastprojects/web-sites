<ul class="products-grid clearfix izotope-container">
  <?php foreach($products as $product):
    $url = product_url($lastname, $template, $surface, $product);
  ?>
    <li class="item margin-top <?php echo make_slug($product->brand);?>" data-filter="priceRange" data-num-views="<?php echo $product->num_views;?>" data-num-sales="<?php echo $product->num_sales;?>" data-price="<?php echo $product->price;?>">
      <div class="pdgvkl1">
        <div class="itemx1">
          <div class="avt1">
            <a href="<?php echo $url;?>">
              <img class="surface" src="<?php echo product_thumb($product, 'listing');?>" />
              <img src="<?php echo tpl_thumb($template, 'lo-res');?>" class="tpl-thumb <?php echo $surface->css_class;?>" alt="" />
            </a>
          </div>
          <div class="egx1">
            <div class="ptr1">
              <div class="row">
                <div class="col-xs-9 col-sm-8">
                  <div class="ti1">
                    
                    <?php echo $product->model;?>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-4">
                  <div class="ti2">
                    <?php echo format_price($product->price);?>
                  </div>
                </div>
              </div>
            </div>
            <div class="addx1">
              <a href="<?php echo $url;?>">
                CUSTOMIZE
              </a>
            </div>
          </div>
        </div>
      </div>
    </li>
  <?php endforeach;?>
</ul>