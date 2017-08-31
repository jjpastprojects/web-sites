<div class="left-sliding-panel cart" data-panel="cart">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Color &amp; Size</h3>
      <span class="glyphicon glyphicon-remove close-product-panel" aria-hidden="true"></span>
    </div>

    <div class="panel-body">
      <form action="" method="" class="product-chooser-frm">
        <input type="hidden" name="tpl_id" value="<?php echo $template->id;?>" />
        <input type="hidden" name="lastname_id" value="<?php echo $lname->id;?>" />

        <input type="hidden" name="surface_id" value="<?php echo current($variants)->id;?>" />
        <input type="hidden" name="surface_type" value="<?php echo $surface->type;?>" />
        <input type="hidden" name="surface_product_id" value="<?php echo $product->id;?>" />
        <?php if($avail_styles && sizeof($avail_styles) > 1):?>
          <div class="form-group" style="margin-bottom:0;">
            <label>
              Available Styles:
            </label>
            <small>
              <a href="<?php echo products_url($template, $surface);?>" class="text-muted">View All</a>
            </small>
          </div>
          <div>
            <select data-change-product class="form-control input-lg hidden">
              <?php foreach($avail_styles as $as):?>
                <option value="<?php echo $as->id;?>"<?php if($as->id == $product->id) echo ' selected';?>>
                  <?php echo $as->model;?>
                </option>
              <?php endforeach;?>
            </select>

            <div class="other-styles">
              <a href="#" class="btn btn-warning choose-available-styles">
                Choose
                <span class="caret"></span>
              </a>
              <div class="avail-styles-holder">
                <?php foreach($avail_styles as $as):?>
                  <div class="row avail-style<?php if($as->id == $product->id) echo ' avail-style-current';?>" 
                  data-avail-style-id="<?php echo $as->id;?>" data-avail-style-name="<?php echo $as->model;?>">
                    <div class="col-xs-4">
                      <img src="<?php echo product_thumb($as);?>" class="img-thumbnail img-responsive" />
                    </div>
                    <div class="col-xs-8">
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
                    <div data-color-code="<?php echo $color;?>" class="color <?php if($k == 0) echo ' act5555ive';?>" 
                    style="background: <?php echo $color;?>" title="<?php echo $v[0]->color.':'.$v[0]->color_code;?>"></div>
                  <?php $k++; endforeach;?>
                </div>
              </div>
            <?php endif;?>

            
            <div role="tabpanel" class="tab-pane" id="logo-color">
              <div class="form-group">
                <?php if($product->type == 'EMBROIDERY'):?>
                  <div class="embroidery-color-holder">
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
            </div>
          </div>

          <?php if($has_sizes):?>
            <div class="row">
              <div class="col-sm-9">
                <div class="form-group size margin-top">
                  <label>Size</label>
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
      
        <div class="<?php if($has_colors || $has_sizes) echo 'h1idden ';?>button-q margin-top">
          <div class="row">
            <div class="col-xs-1 col-xs-offset-3" style="padding-top: 13px;">
              <img data-q="-1" src="/img/ico_p1.png" alt="" style="cursor: pointer;" />
            </div>
            <div class="col-xs-3 col-sm-2 col-sm3 text-center" style="padding-right: 0;">
              <input type="text" min="1" name="q" value="1" class="input-lg form-control text-center" placeholder="quantity" />
            </div>
            <div class="col-xs-2 col-sm-1" style="padding-top: 13px; padding-left: 12px;">
              <img data-q="1" src="/img/ico_p2.png" style="cursor: pointer;" alt="" />
            </div>
            <div class="col-xs-12 col-sm-5 mid-margin-top">
              <button type="submit" data-price="<?php echo current($variants)->price;?>" class="btn custom-danger btn-block">
                BUY NOW $<?php echo current($variants)->price;?>
              </button>
            </div>

            <?php if(is_main_shop($shop)):?>
              <div class="col-xs-12 mid-margin-top">
                <a href="#" 
                class="btn btn-default custom-default btn-block start-sell-this">
                  SELL THIS
                </a>
              </div>
            <?php endif;?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>