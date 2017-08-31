<?php $this->load->view('header.inc.php');?>

<?php if(!empty($lname)):?>  
  <div class="index-header">
    
    <h2 title="click here, type another lastname and hit enter" class="lastname" data-lastname-navigation>
      <span contentEditable onclick=""><?php echo $lastname;?></span>

      <?php /*
      <span class="glyphicon glyphicon-search"></span>
      <span class="glyphicon glyphicon-remove hidden"></span>*/?>
    </h2>

    
    <h5 class="text-center">
        <?php echo isset($header_title) ? $header_title : 'GIFTS SHOP';?>
    </h5>
  </div>
<?php else:?>
  <div style="margin-top: 100px;"></div>  
<?php endif;?>