<?php $this->load->view('header.inc.php');?>

<div class="index-header index">
  <div class="header-bg" style="display: none;"></div>

  <!-- WOW Slider Added By Glado 2016/5/13 START -->
  <link rel="stylesheet" type="text/css" href="/js/wowslider/style.css" />
  <div id="wowslider-container1">
    <div class="ws_images">
      <ul>
        <li><img src="/img/wowslider/images/1.jpg" alt="1" title="1" id="wows1_0"/></li>
        <li><img src="/img/wowslider/images/2.jpg" alt="2" title="2" id="wows1_1"/></li>
        <li><img src="/img/wowslider/images/3.jpg" alt="3" title="3" id="wows1_2"/></li>
        <li><img src="/img/wowslider/images/4.jpg" alt="4" title="4" id="wows1_3"/></li>
      </ul>
    </div>
    <div class="ws_bullets">
      <div>
        <a href="#" title="1"><span><img src="/img/wowslider/tooltips/1.jpg" alt="1"/>1</span></a>
        <a href="#" title="2"><span><img src="/img/wowslider/tooltips/2.jpg" alt="2"/>2</span></a>
        <a href="#" title="3"><span><img src="/img/wowslider/tooltips/3.jpg" alt="3"/>3</span></a>
        <a href="#" title="4"><span><img src="/img/wowslider/tooltips/4.jpg" alt="4"/>4</span></a>
      </div>
    </div>
    <div class="ws_script" style="position:absolute;left:-99%"></div>
    <div class="ws_shadow"></div>
  </div>
  <script type="text/javascript" src="/js/wowslider/wowslider.js"></script>
  <script type="text/javascript" src="/js/wowslider/script.js"></script>
  <!-- WOW Slider Added By Glado 2016/5/13 END -->

  <h2 class="text-center">
    OVER 4 MILLION PERSONALIZED PRODUCTS
  </h2>

  <div class="container">
    <div class="row search-lastname">
      <div class="col-sm-10 col-sm-offset-1">
        <form action="/" method="get" class="lastname-form">
          <div class="row">
            <input type="text" required class="form-control" name="lastname" placeholder="Enter your first or last name here" />
            <button type="submit" class="fake-button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="catalog-holder">
  <div class="cont1ainer<?php if(isset($_GET['fluid']) || TRUE) echo '-fluid';?> surface-items index-grid">
    <?php $sliders = array(
      // array(
      //   'title'   => 'Now Trending',
      //   'class'   => 'trending',
      //   'key'     => 'trending'
      // ),

      array(
        'title'   => 'Most Popular',
        'class'   => 'most-popular',
        'key'     => 'popular'
      ),

      array(
        'title'   => 'Best Sellers',
        'class'   => 'best-sellers',
        'key'     => 'bestsellers'
      )
    );?>  

    <?php if($featured):?>
      <div class="slider-trending">
        <h2 class="text-center">
          Featured
        </h2>
        
        <div class="flexslider">
          <ul class="slides products-grid">
            <?php foreach($featured as $f):?>
              <li>
                <div class="pdgvkl1">
                  <div class="itemx1">
                    <div class="avt1">
                      <a href="<?php echo $f->link;?>">
                        <img src="<?php echo featured_img($f->img);?>" />
                      </a>
                    </div>
                    <div class="egx1">
                      <div class="ptr1">
                        <div class="ti1">
                          <?php echo $f->name;?>
                        </div>
                      </div>
                      <div class="addx1">
                        <a href="<?php echo $f->link;?>">
                          CUSTOMIZE
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    <?php endif;?>

    <div class="slider-trending" id="load-item">
    </div>
    
    <div class="text-center">
      <a href="javascript:;" class="load-more" id="load-more">
        <i class="fa fa-pulse fa-spinner" style="display: none;"></i>&nbsp;&nbsp;Load More
      </a>
    </div>

  </div>
</div>

<link rel="stylesheet" type="text/css" href="/css/flexslider.css" />
<script src="/js/jquery.flexslider-min.js"></script>

<script>
  $(function() {
    listing_canvas().replace();

    $('.flexslider').flexslider({
      animation: "slide",
      minItems: 1,
      itemWidth: 303,
      slideshow: false,
      controlNav: false,
      prevText: '',
      nextText: ''
    });

    $('#load-more').click(function(){
      $('#load-more i').css('display', 'inline-block'); //Show Loading
      $.post('/catalog/loadmoreSnd', function(data) {
        if(data.success){
          $.each(data.sndfeatured, function(idx, val){
            var item = '<div class="new-item">\
                          <div class="pdgvkl1">\
                            <div class="itemx1">\
                              <div class="avt1">\
                                <a href="'+val.link+'">\
                                  <img src="/media/2ndfeatured/'+val.img+'" />\
                                </a>\
                              </div>\
                              <div class="egx1">\
                                <div class="ptr1">\
                                  <div class="ti1">'+val.name+'</div>\
                                </div>\
                                <div class="addx1">\
                                  <a href="'+val.link+'">CUSTOMIZE</a>\
                                </div>\
                              </div>\
                            </div>\
                          </div>\
                        </div>';
            var num = parseInt(screen.width/303);
            var len = data.sndfeatured.length;
            var availRow = parseInt(len/num);
            if( idx < num*availRow){
              var holder = '#load-item';
              $(holder).append(item).delay(100).fadeIn('fast');
            }
          });
        }
        $('#load-more i').css('display', 'none'); //Remove Loading
      }, 'json');
    });

    $('#load-more').click();
  });
</script>