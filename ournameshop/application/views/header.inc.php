
<div class="logo-login">
  <div class="floating-search-panel">
    <div class="row rowxs">
    <div class="col-sm-6 col-sm-offset-3 col-xs-12">
        <form class="lastname-form">
          <div class="row">
            <div class="col-xs-8">
              <input type="text" required class="form-control" name="lastname" placeholder="Enter your first or last name here" />
            </div>
            <div class="col-xs-4">
              <button type="submit" class="btn btn-search">
                Search
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="close-holder">
      <a href="#">
        <span class="glyphicon glyphicon-remove"></span>
      </a>
    </div>
  </div>
  
  <div class="row rowxs">
    <div class="col-sm-10 col-sm-offset-1">
      <div class="row">
        <div class="col-xs-4 col-sm-6 logo">
          <a href="/" class="pull-left">
            <img src="<?php echo logo_url();?>" alt="logo" />
          </a>
        </div>
          
        <div class="col-xs-8 col-sm-6 text-right auth-links<?php echo $this->user_id ? ' logged_id' : '';?> text">
          <?php if($this->user_id):?>
            <ul class="user-menu">
              <li>
                <a href="/cart/" class="cart-lnk">
                  <span class="glyphicon glyphicon-shopping-cart"></span>

                  <?php if($cart_items_cnt):?>
                    <span class="label label-primary">
                      <?php echo $cart_items_cnt;?>
                    </span>
                  <?php endif;?>
                </a>
              </li>
              <li>
                <a href="/collection/<?php echo $this->user_id;?>">
                  <span class="glyphicon glyphicon-heart"></span>
                  <span class="label label-info fav-cnt<?php if(!$fav_items_cnt) echo ' hidden';?>">
                    <?php echo $fav_items_cnt;?>
                  </span>
                </a>
              </li>
              <li>
                <a href="<?php echo $this->ion_auth->in_group(GROUP_ID_STORE_OWNER) ? '/' . STORE_ADMIN_URL_PREFIX . '/dashboard' : '/customer/orders/';?>">
                  <span class="glyphicon glyphicon-user"></span>
                </a>
              </li>
              <li>
                <a href="#" class="open-floating-search">
                  <span class="glyphicon glyphicon-search"></span>
                </a>
              </li>
            </ul>
          <?php else:?>
            <a href="#" class="show-login-popup">
              SIGN IN
            </a>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
</div>
