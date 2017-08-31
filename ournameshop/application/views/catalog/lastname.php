<?php $this->load->view('catalog/family_header.inc.php');?>
<?php if(!$lname):?>
  <div class="row margin-top padding-bottom-30">
    <div class="col-lg-4 col-lg-offset-4">
      <div class="alert alert-info">
          Sorry, our elves have not had a chance to create your family name store yet but we have good news...
          we can bring in some additional elves to speed up things a little.<br /><br />
          We will notify you once your store is up and running.
      </div>

      <form role="form" action="" method="post" class="request-form">
        <div class="alert alert-success" style="display: none;">
          Thank You. We'll notify about your request by email.
        </div>
        <div class="form-group">
          <label>First Name</label>              
          <input required class="form-control" name="firstname" />
        </div>
        <div class="form-group">
          <label>Last Name</label>              
          <input required class="form-control" name="lastname" value="<?php echo form_prep($lastname);?>" />
        </div>

        <div class="form-group">
          <label>Email</label>              
          <input required type="email" class="form-control" name="email" />
        </div>

        <button type="submit" class="btn btn-success">Send</button>
      </form>
    </div>
  </div>

  

  <script>
    $(function() {
      $('.request-form').on('submit', function(e) {
        e.preventDefault();
        var frm = $(this);

        frm.find('button:submit').text('please wait').attr('disabled', true);

        $.post('/request-lastname', frm.serialize(), function(data) {
          frm.find('button:submit').text('Send').attr('disabled', false);
          if(data.success)
          {
            frm.find('.alert').slideDown('fast');
          }
          else
          {
            alert(data.msg);
          }
        }, 'json');
      });

    });


  </script>

<?php else:?>

<div class="container">
  <div class="fast-switch-product clearfix text-center">
    <ul class="hidden-xs">
      <?php
        $array = array(
          'T-SHIRT'         => 'adix1.png',
          'HOODIE'          => 'adix2.png',
          'MUG'             => 'adix3.png',
          // 'EMBROIDERY'      => 'adix4.png',
          'BIB'             => 'adix5.png',
          'APRON'           => 'adix6.png',
          'PHONE-CASE'      => 'adix7.png',
          'POSTER'          => 'adix8.png'
        );

       foreach($this->config->item('surfaces') as $k => $srfc): 
          if(!isset($array[$srfc->type])) continue;

          $url = current_url() . '?surface=' . $srfc->type;
        ?>
        <li>
          <a href="<?php echo $url;?>" <?php echo ($srfc->type==$selected_surface_type?'class="selected"':''); ?>>
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

    <div class="hidden-sm hidden-md hidden-lg">
      <select class="form-control input-lg">
          <option value="/<?php echo $lname->lastname?>">All categories</option>
        <?php foreach($this->config->item('surfaces') as $k => $srfc): 
            if(!isset($array[$srfc->type])) continue;

            $url = current_url() . '?surface=' . $srfc->type;
          ?>
          <option value="<?php echo $url;?>"  <?php echo ($srfc->type==$selected_surface_type?'selected':''); ?>>
            <?php echo $srfc->name;?>
          </option>
        <?php endforeach;?>
      </select>
    </div>
  </div>
</div>

<div class="catalog-holder">
  <div class="container">
    <div class="cats-filter-holder">
      <?php /*<form action="" method="get" class="filter-family">
  
        <input type="hidden" name="lastname_id" value="<?php echo $lname->id;?>" />
        <label>
          <span onclick="$(this).next().prop('checked', true).trigger('change'); return false;" class="cat-id<?php if(!$category) echo ' active';?>">
            All
          </span>
          <input type="radio" name="category_id" value="0" class="hidden" checked />
        </label>
        
        <?php foreach($this->categories->root()->get_all() as $v):
          $cat_url = sprintf('/%s/category/%s', $lastname, $v->slug);
        ?>
          <?php if($v->has_children):?>
            <div class="mid-margin-top">
              <a href="<?php echo $cat_url;?>" data-expand-children class="cat-id">
                <small class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></small>
                <?php echo $v->name;?>
              </a>
            </div>
            <div class="hidden">
              <?php foreach($this->categories->get_many_by(array('parent_id' => $v->id)) as $sub_cat):?>
                <div class="radio">
                  <label>
                    <input type="radio" name="category_id" value="<?php echo $sub_cat->id;?>" />
                    <?php echo $sub_cat->name;?>
                  </label>
                </div>
              <?php endforeach;?>
            </div>
          <?php else:?>
            
              <label>
                <a href="<?php echo $cat_url;?>" onclick="$(this).next().prop('checked', true).trigger('change'); return false;" class="cat-id<?php if($category && $v->id == $category->id) echo ' active';?>">
                  <?php echo $v->name;?>
                </a>
                <input type="radio" name="category_id" class="hidden" value="<?php echo $v->id;?>" />
              </label>
            
          <?php endif;?>
        <?php endforeach;?>
      </form>*/?>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar" style="padding:0">
        <?php $this->load->view('catalog/sidebar_tpl_filter.inc.php');?>
    </div>
    <div class="col-sm-9 col-md-10">
      <div class="surface-items index-grid inner-grid family-items">
        <div class="caro">
          <?php foreach($templates as $k => $template):?>
            <?php if(!$category):?>
              <a href="/<?php echo $lastname;?>/category/<?php echo current($template)->category_slug;?><?php if($selected_surface_type) echo '?surface='.$selected_surface_type;?>" class="pull-right">
                view all
              </a>
            <?php endif;?>
            <h3 class="text-muted text-center">
              <?php echo $k;?>
            </h3>

            <div class="margin-top">
              <div class="<?php echo (!$category||$category->has_children) ? 'flexslider' : '';?>">
                <?php $this->load->view('catalog/listing.inc.php', array('templates' => $template));?>
              </div>
            </div>
          <?php endforeach;?>
        </div>
      </div>
      <?php if(!$category):?>
        <div class="text-center" style="margin-bottom: 65px;">
          <a href="#" class="btn btn-pink btn-lg load-more">
            Load More
          </a>
        </div>
      <?php endif;?>
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="/css/flexslider.css" />
<script src="/js/jquery.flexslider-min.js"></script>


<script>
  $(function() {
    listing_canvas().replace();

    var page        = 1;
    var per_page    = <?php echo $this->data['cat_limit'];?>;
    var total_cats  = <?php echo $this->data['total_cats'] = $this->db->count_all_results('categories');?>;
    
    var pages       = Math.ceil(total_cats / per_page);
    
    var cat_holder  = $('.surface-items');
    var surface     = '<?php echo addslashes($this->input->get('surface'));?>';
    
    $('.load-more').on('click', function(e) {
      e.preventDefault();
      var lnk = $(this);

      lnk.text('loading...');

      $.getJSON('/<?php echo $lastname;?>/categories', {
        page:     ++page,
        surface:  surface
      }, function(data) {
        if(data.success)
        {

          if(page == pages)
            lnk.hide();
          
          lnk.text('Load More');
          cat_holder.append(data.html);
          init_sliders();

          listing_canvas().replace();
        }
      });
    });
    
    function init_sliders()
    {
      $('.flexslider').flexslider({
        animation: "slide",
        minItems: 1,
        
        itemWidth: 303,

        slideshow: false,

        controlNav: false,
        prevText: '',
        nextText: ''

      });
    }

    init_sliders();
    

    $('[data-expand-children]').on('click', function(e) {
      e.preventDefault();
      var lnk = $(this);

      lnk.parent().next().toggleClass('hidden');
      lnk.find('span.glyphicon').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');

      $('.filter-family span.cat-id').removeClass('active');
      lnk.addClass('active');
    });
  })
</script>
<?php endif;?>

