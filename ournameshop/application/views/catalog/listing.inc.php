<ul class="products-grid slides clearfix">
  <?php foreach($templates as $tpl):
    $srfc = $surfaces[array_rand($surfaces)];
    $srfc->slug = $srfc->surface_slug;
    
    if(isset($lname_from_collection))
      $lastname = $tpl->lastname;
    
    if($tpl->canvas_params && isset($def_combs[$tpl->folder_id]))
    {
      if(isset($def_combs[$tpl->folder_id]->fired))
        continue;

      if($def_combs[$tpl->folder_id]->listing_image && $replace_with_canvas)
        $def_combs[$tpl->folder_id]->image = $def_combs[$tpl->folder_id]->listing_image;

      $url = product_url($lastname, $tpl, $def_combs[$tpl->folder_id], (object)array('id' => $def_combs[$tpl->folder_id]->product_id));

      $url .= '/custom/' . $def_combs[$tpl->folder_id]->id;
    } 
    else 
    {
        //tfix
      $url = product_url($lastname, $tpl, $srfc, (object)array('id' => $srfc->id));
      /*$url = $srfc->default_product ? product_url($lastname, $tpl, $srfc, (object)array('id' => $srfc->id)) :
             products_url($tpl, $srfc);*/
    }


  ?>
    <li class="margin-top">
      <div class="pdgvkl1">
        <div class="itemx1">
          <div class="avt1">
            <a href="<?php echo $url;?>">
              <img class="surface" src="<?php echo product_thumb($tpl->canvas_params && $replace_with_canvas ? $def_combs[$tpl->folder_id] : $srfc, 'listing');?>" />
              <img <?php echo $tpl->canvas_params && $replace_with_canvas ? ("data-filters='" .  json_encode(current(json_decode($tpl->canvas_params))->filters) . "'" ) : '';?> 
              src="<?php echo tpl_thumb($tpl);?>" class="tpl-thumb <?php //echo $product->css_class;?>" alt="" />
            </a>
          </div>
          <div class="egx1">
            <div class="ptr1">
              <div class="ti1">
                <?php echo $tpl->f_name;?>
              </div>
              <div class="tryv1">
                <a href="#" class="add2col">
                  <img alt="" src="/img/trymx1.png">
                </a>
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

<div class="catalog-items-overlay"></div>