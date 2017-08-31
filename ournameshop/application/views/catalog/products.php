<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="catalog-holder">
  <div class="container">
    <?php if(!$lname):?>
      <div class="alert alert-info">
         Sorry, your last name not found
      </div>
    <?php else:?>
      <?php /*
      <div class="row">
        <div class="col-lg-12 surface-items products">
          

          

          <div class="row">
            <?php if(isset($has_filter) && FALSE):?>
              <div class="col-sm-2">
                
                <div class="filter margin-top">
                  <form>
                    <div id="filter-brand">
                      <p>
                        <b>
                          Brand:
                        </b>
                      </p>
                      <?php foreach($brands as $brand):?>
                        <div class="checkbox">
                          <label>
                            <input value=".<?php echo make_slug($brand);?>" type="checkbox" />
                            <?php echo $brand;?>
                          </label>
                        </div>
                      <?php endforeach;?>
                      
                      <?php if(TRUE):?>
                        <div class="margin-top">
                          <select class="form-control" id="sort-sel">
                            <option value="">
                              Sort By
                            </option>
                            <option data-sort="price" value="false">
                              Price &darr;
                            </option>
                            <option data-sort="price" value="true">
                              Price  &uarr;
                            </option>
                            <option data-sort="bestsellers" value="false">
                              Bestsellers
                            </option>
                            <option data-sort="popular" value="false">
                              Most Popular
                            </option>
                          </select>
                        </div>
                      <?php endif;?>
                      <div class="margin-top">
                        <div>
                          <b>Price</b>:
                          <span class="price-min">
                            $<?php echo min($arr_prices);?>
                          </span>
                          -
                          <span class="price-max">
                            $<?php echo max($arr_prices);?>
                          </span>
                        </div>
                        
                        <div class="margin-top">
                          <div id="slider"></div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <?php endif;?>    
            
            <!-- <div class="col-sm-1<?php echo isset($has_filter) ? '0' : '2';?>"> -->
            <div class="col-sm-12">
              
            </div>
          </div>

        </div>
      </div>*/?>
    <?php endif;?>
  </div>
</div>

<div class="products-izo-filter">
  <h3 class="circled">
    <span class="circle">2</span>
    Select your <strong><?php echo $lastname;?></strong> family
    <?php echo mb_strtolower(singular($surface->name));?> style:
  </h3>

  <?php if(isset($has_filter)):?>      
    <div class="filter margin-top row">
      <div class="col-sm-6">
        <form>
          <div class="row" id="filter-brand">
            <div class="col-sm-4">
              <p><b>Brand</b></p>
              <select class="form-control" id="brand-sel">
                <option value="">All</option>
                <?php foreach($brands as $brand):?>
                  <option value=".<?php echo make_slug($brand);?>">
                    <?php echo $brand;?>
                  </option>
                  <?php /*<div class="checkbox">
                    <label>
                      <input value=".<?php echo make_slug($brand);?>" type="checkbox" />
                      <?php echo $brand;?>
                    </label>
                  </div>*/?>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-sm-4">
              <?php if(TRUE):?>
                <p><b>Sort</b></p>
                <select class="form-control" id="sort-sel">
                  <option value="">
                    Sort By
                  </option>
                  <option data-sort="price" value="false">
                    Price &darr;
                  </option>
                  <option data-sort="price" value="true">
                    Price  &uarr;
                  </option>
                  <option data-sort="bestsellers" value="false">
                    Bestsellers
                  </option>
                  <option data-sort="popular" value="false">
                    Most Popular
                  </option>
                </select>
                
              <?php endif;?>
            </div>
            <div class="col-sm-4">
              <div>
                <b>Price</b>
                <span class="price-min">
                  $<?php echo min($arr_prices);?>
                </span>
                -
                <span class="price-max">
                  $<?php echo max($arr_prices);?>
                </span>
              </div>
              
              <div class="margin-top">
                <div id="slider"></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php endif;?>
</div>

<div class="surface-items index-grid family-items izo-greed clearfix">

  

  <?php $this->load->view('catalog/products_listing.inc.php');?>
</div>


<link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.11.4/jquery-ui.css" />
<script src="/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script src="/js/isotope.pkgd.min.js"></script>

<script>
  $(function() {
    <?php if(isset($has_filter)):?>
      $('#slider').slider({
        step: .5,
        range: true,
        values: [
         <?php echo min($arr_prices);?>, 
         <?php echo max($arr_prices);?>
        ],

        min: <?php echo min($arr_prices);?>,
        max: <?php echo max($arr_prices);?>,
        
        slide: function(event, ui) {
          $( ".price-min" ).text( "$" + ui.values[ 0 ]);
          $( ".price-max" ).text( "$" + ui.values[ 1 ]);
        },

        change: function( event, ui ) {
          $container.isotope({ filter: iso_flt});
        }
      });

      function iso_flt () {
        var price   = $(this).data('price');
        var values  = $('#slider').slider('option', 'values');
        
        var brands = current_brands();
        
        if(brands.length > 0)
        {
          if( !$(this).is(brands.join(',')) )
            return false;
        }
        
        return (price >= values[0] && price <= values[1]);
      }

      function current_brands()
      {
        var filters = [];

        if($('#brand-sel').val())
          filters.push($('#brand-sel').val());
        // $.each($('#brand-sel'), function(i, v) {
        //   filters.push($(v).val());
        // });

        return filters;
      }


      var $container = $('.izotope-container');
      
      $container.isotope({
        itemSelector: '.item',
        layoutMode: 'fitRows',

        getSortData: {
          price:        '[data-price]',
          bestsellers:  '[data-num-sales]',
          popular:      '[data-num-views]'
        }
      });

      $('#brand-sel').on('change', function() {
        $container.isotope({ filter: iso_flt });
      }).trigger('change');

      $('#sort-sel').on('change', function() {
        var sel = $(this);

        if(sel.val())
        {
          $container.isotope({
            sortBy: sel.find('option:selected').data('sort'),
            sortAscending: sel.val() == 'true' ? true : false
          });  
        }
        else
        {
          $container.isotope({
            sortBy: 'original-order',
          });
        }
        
      }).trigger('change');
    <?php endif;?>
  });
  
</script>