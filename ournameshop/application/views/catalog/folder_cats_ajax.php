<div class="caro">
  <?php foreach($templates as $k => $template):?>
    <?php if(!$category):?>
      <a href="/<?php echo $lastname;?>/category/<?php echo current($template)->category_slug;?>" class="pull-right">
        view all
      </a>
    <?php endif;?>
    <h3 class="text-muted text-center">
      <?php echo $k;?>
    </h3>

    <div class="margin-top">
      <div class="<?php echo !$category ? 'flexslider' : '';?>">
        <?php $this->load->view('catalog/listing.inc.php', array('templates' => $template));?>
      </div>
    </div>
  <?php endforeach;?>
</div>