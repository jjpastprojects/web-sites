<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="catalog-holder">
  <div class="container">
    <?php if(!$lname):?>
      <div class="alert alert-info">
         Sorry, your last name not found
      </div>
    <?php else:?>
      <div class="row">
        <!-- <div class="col-lg-3 sidebar">
          <p>
            <strong>Show results for:</strong>
          </p>

          <div class="side-bar-filter">
            <?php $this->load->view('catalog/sidebar_surface_filter.inc.php');?>
          </div>
        </div> -->
        <div class="col-lg-12 surface-items">
          <h3 class="circled">
            <span class="circle">1</span>
            Select your <strong><?php echo $lastname;?></strong> family product
          </h3>
          
          <?php $this->load->view('catalog/surfaces_listing.inc.php');?>
        </div>
      </div>
    <?php endif;?>
  </div>
</div>