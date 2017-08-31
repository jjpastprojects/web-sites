<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="catalog-holder">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 surface-items collection">
        <h3 class="circled">
          Collection of user <?php echo $user_collection->first_name;?>
        </h3>
        <?php if($collection):?>
          <div class="row izotope-container">
            <?php foreach($collection as $item):?>
              <div class="col-lg-15 col-md-3 col-sm-6 col-xs-6 item">
                <div class="inner">
                  <div class="img">
                    <a href="<?php echo product_url(
                                $item->lastname,
                                (object)array('slug' => $item->tpl_slug), 
                                (object) array('slug' => $item->surface_slug), 
                                (object)array('id' => $item->product_id)
                              );?>/custom/<?php echo $item->id;?>">
                              
                      <img class="surface" src="<?php echo product_thumb($item, 'listing');?>" />

                      <img src="<?php echo saved_logo_url((object) array('filename' => $item->filename));?>" 
                      class="tpl-thumb <?php echo $item->css_class;?>" alt="" />
                      
                    </a>
                  </div>

                  <?php if($this->user_id && $this->user_id == $user_collection->id):?>
                    <div class="remove-lnk">
                      <a href="#" data-remove-id="<?php echo $item->id;?>" class="btn btn-danger btn-xs">remove</a>
                    </div>
                  <?php endif;?>

                  <?php if($this->user_id && $this->user_id == $user_collection->id && FALSE):?>
                    <div class="title">
                      <div class="row">
                        <div class="col-lg-12 col-xs-12">
                          <a href="#" data-remove-id="<?php echo $item->id;?>">
                            Remove from collection
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php endif;?>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        <?php else:?>
          <div class="alert alert-info">
            empty collection
          </div>  
        <?php endif;?>
      </div>
    </div>
  </div>
</div>


<script>
  $(function() {
    $('[data-remove-id]').on('click', function(e) {
      e.preventDefault();

      if(!confirm('Remove from collection?'))
        return;

      var lnk = $(this);

      $.post('/remove_from_collection', {id: lnk.data('remove-id')}, function(data) {
        if(data.success)
        {
          if(data.fav_items_cnt == 0)
            $('.fav-cnt').addClass('hidden');

          $('.fav-cnt').text(data.fav_items_cnt);

          lnk.parents().closest('.item').remove();
        }
      }, 'json');
    });
  });
</script>























