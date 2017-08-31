<script>

  $(function() {
    
  });

  var variants_by_color = <?php echo json_encode($by_color);?>;
  var variant           = <?php echo json_encode($variant);?>;
  var has_colors        = <?php echo json_encode($has_colors);?>;
  var has_sizes         = <?php echo json_encode($has_sizes);?>;

  var tpl_id            = <?php echo $template->id;?>;
  
  window.setTimeout(function() {
    
  }, 500);
  

  <?php if($this->input->get('sp')):?>
    $('html, body').scrollTop(<?php echo $this->input->get('sp');?>);
  <?php endif;?>

  $('.fast-switch-product a').on('click', function(e) {
    e.preventDefault();
    
    localStorage.setItem( 'saved_logo', print_designer.share_params().canvas_params);
    
    location = $(this).prop('href') + '?sp=' + $(document).scrollTop();
  });

  if(!print_designer.detectIE())
  {
    $('.zoom-lnk').removeClass('hidden');
  }

  var logo_url;
   
  

  var designer_config     = designer_configs['<?php echo $product->type;?>'];  

  $(function() {
    $('.size-and-color ul.nav a:first').tab('show');

    $('[data-q]').on('click', function() {
      var lnk = $(this);

      var input = $('[name=q]');

      var new_q = parseInt(input.val()) + parseInt(lnk.data('q'));

      if(new_q < 1)
        new_q = 1;

      input.val(new_q).trigger('change');

    });

    $('.add-to-col').on('click', function(e) {
      e.preventDefault();
      var lnk = $(this);

      lnk.addClass('loading');

      var params          = print_designer.share_params();

      params.variant_id   = $('input[name=surface_id]').val();
      
      params.template_id  = $('input[name=tpl_id]').val();
      params.lastname_id  = $('input[name=lastname_id]').val();

      $.post('/catalog/save_print_design', params, function(data) {
        if(data.success)
        {
          lnk.removeClass('loading');
          lnk.addClass('active');
          
          $('.fav-cnt').text(data.fav_items_cnt).removeClass('hidden');

          $('body').trigger('added2col', [data.fav_items_cnt]);
        }

      }, 'json');
    });

    <?php if($this->input->get('add_2collection')):?>
    {
      $(document).on('canval_logo_loaded', function() {
        $('.add-to-col').trigger('click');
      });

      $(document).on('added2col', function(e, cnt) {
        parent.$(parent.document).trigger('added2col', [cnt]);
      });      
    }

    <?php endif;?>

    $('.listSoc1').sharer({bind_to_links: false}).init();

    $('.listSoc1 li a').not('.add-to-col').on('click', function(e) {
      e.preventDefault();
      var lnk = $(this);
      
      var params          = print_designer.share_params();
      params.variant_id   = $('input[name=surface_id]').val();
      
      params.template_id  = $('input[name=tpl_id]').val();
      params.lastname_id  = $('input[name=lastname_id]').val();
      
      var share_window = window.open(
        'about:blank', '', 'menubar=no,location=no,resizable=no,scrollbars=no,status=yes,width=550,height=600'
      );
      
      $.post('/catalog/save_print_design', params, function(data) {
        if(data.success)
        {
          share_window.location.replace($('.listSoc1').sharer().get_share_url(
            lnk.data('sharer-network'),
            '<?php echo site_url(product_url($lastname, $template, $surface, $product));?>' + 
            '/custom/' + data.id,
            data.image_url
          ));
        }
      }, 'json');
    });

    

    designer_config.filter  = '<?php echo $template->monochromic ? 'Tint' : 'Multiply'; ?>';
    
    <?php if(!empty($saved_logo)):?>
      designer_config.params = <?php echo json_encode($saved_logo->params);?>;
    <?php endif;?>

    var saved_logo = localStorage.getItem('saved_logo');

    if(saved_logo != null)
    {
      designer_config.params = JSON.parse(saved_logo);
      localStorage.removeItem('saved_logo');
    }

    // logo_url = '/img/sample_eagle2.png';
    // logo_url = '<?php echo logo_proxy_url($template, 'lo-res');?>?n=2';
    logo_url = '<?php echo tpl_thumb($template) . '?n=' . random_string();?>';
    // logo_url = 'http://subdomain.familykeepsakes.com/logos/669733_4.png?n=2';

    // logo_url = 'http://s3.amazonaws.com/familynamestore/crests/crest_5/lo-res/deal.png';

    print_designer.init(logo_url, designer_config);
      
    print_designer.drawRainbow($('.hue-rainbow-holder'));

    
  });
</script>