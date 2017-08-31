<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>
            <div id="hbreadcrumb" class="pull-right m-t-md">
                <ol class="hbreadcrumb breadcrumb">
                    <li class="active"><span>Dashboard</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Dashboard
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
  <div class="row">
    <div class="col-md-4 col-sm-12">
      <div class="hpanel hgreen portlet-item">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                <a class="closebox"><i class="fa fa-times"></i></a>
            </div>
            New Orders
        </div>
        <div class="panel-body no-padding scroll-body">
          <ul class="list-group alt">
            <?php foreach($new_orders as $order):?>
              <li class="list-group-item">
                <div class="media">
                  <div class="pull-right media-xs text-center text-muted">
                    <strong class="h4">
                      <?php echo format_price($order->subtotal);?>
                    </strong>
                  </div>
                  <div class="media-body">
                    <div>
                      <a href="/admin/order/<?php echo $order->id;?>">
                        <?php echo $order->name;?>
                      </a>
                    </div>
                    <small class="text-muted">
                      <?php echo relative_date($order->create_ts);?>
                    </small>
                  </div>
                </div>
              </li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6">
      <div class="hpanel hblue portlet-item">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                <a class="closebox"><i class="fa fa-times"></i></a>
            </div>
            New Customers
        </div>
        <div class="panel-body no-padding scroll-body">
          <ul class="list-group alt">
            <?php foreach($new_customers as $customer):?>
              <li class="list-group-item">
                <div class="media">
                  
                  <div class="media-body">
                    <div>
                      <a href="#">
                        <?php echo sprintf('%s %s', $customer->first_name, $customer->last_name);?>
                      </a>
                    </div>
                    <small class="text-muted">
                      <?php echo relative_date($customer->created_on);?>
                    </small>
                  </div>
                </div>
              </li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6">
      <div class="hpanel hviolet portlet-item">
        <div class="panel-heading">
            <div class="panel-tools">
                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                <a class="closebox"><i class="fa fa-times"></i></a>
            </div>
            New Lastname Requests
        </div>
        <div class="panel-body no-padding scroll-body">
          <ul class="list-group alt">
            <?php if($new_lname_requests):?>
              <?php foreach($new_lname_requests as $r):?>
                <li class="list-group-item">
                  <div class="media">
                    <div class="pull-right media-xs">
                      <a href="#" data-id="<?php echo $r->id;?>" data-r-status="<?php echo  LNAME_REQ_STATUS_ACCEPTED;?>" class="btn btn-sm btn-success">
                        Accept
                      </a>

                      <a href="#" data-id="<?php echo $r->id;?>" data-r-status="<?php echo  LNAME_REQ_STATUS_REJECTED;?>" class="btn btn-sm btn-danger">
                        Reject
                      </a>
                    </div>
                    <h4 class="no-margin-top">
                      <a href="#" class="text-warning">
                        <?php echo $r->lastname;?>
                      </a>
                    </h4>
                    <div class="media-body">
                      <div>
                        By <?php echo sprintf('%s %s', $r->firstname, $r->lastname);?>
                      </div>
                      <small class="text-muted">
                        <?php echo relative_date($r->create_ts);?>
                      </small>
                    </div>
                  </div>
                </li>
              <?php endforeach;?>
            <?php else:?>
              <li class="list-group-item">
                <div class="alert alert-info">
                  no requests
                </div>
              </li>
            <?php endif;?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9">
      <div class="hpanel sales-graph" data-function="buildGraph" data-graph="sales">
        <div class="panel-heading hbuilt">
          Sales
        </div>
        <div class="panel-body" style="padding-top: 10px;">
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-sm btn-white active">
              <input type="radio" name="sales_period" value="week"> Week
            </label>
            <label class="btn btn-sm btn-white">
              <input type="radio" name="sales_period" value="month"> Month
            </label>
            <label class="btn btn-sm btn-white">
              <input type="radio" name="sales_period" value="year"> Year
            </label>
          </div>
          <div id="sales-graph" class="graph"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="hpanel by-surface-graph" data-function="buildDonutGraph" data-graph="by_surface">
        <div class="panel-heading hbuilt">
          % of Sales by Product types
        </div>
        <div class="panel-body" style="padding-top: 10px;">
          <div class="btn-group" data-toggle="buttons">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-sm btn-white active">
                <input type="radio" name="sales_period" value="week"> Week
              </label>
              <label class="btn btn-sm btn-white">
                <input type="radio" name="sales_period" value="month"> Month
              </label>
              <label class="btn btn-sm btn-white">
                <input type="radio" name="sales_period" value="year"> Year
              </label>
            </div>
          </div>
          <div id="by-surfaces-graph" class="graph"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/member/charts/morris/raphael-min.js" cache="false"></script>
<script src="/js/member/charts/morris/morris.min.js" cache="false"></script>

<script>
  $(function() {

    $('[name=sales_period]').on('change', function() {
      var input   = $(this);
      var holder  = input.parents().closest('div.hpanel');
      
      $.getJSON('/admin/graph_data', {graph: holder.data('graph'), period: $(this).val()}, function(data) {
        
        if(data.success)
        {
          switch(holder.data('function'))
          {
            case 'buildGraph':
            {
              buildGraph('sales-graph', data.data);
            } break;

            case 'buildDonutGraph':
            {
              buildDonutGraph('by-surfaces-graph', data.data);
            } break;
          }  
        }
        else
        {
          alert(data.msg);
        }
      });
    });

    $('.sales-graph [name=sales_period]:first, .by-surface-graph [name=sales_period]:first')
    .attr('checked', true).trigger('change');
    
    $('[name=sales_period]:first').attr('checked', true);

    var buildDonutGraph = function(container, data) {

      Morris.Donut({
        element: container,
        data: data,
        colors:['#afcf6f'],
        formatter: function (y) { return y + "%" }
      });
    }

    var buildGraph = function(container, data) {
      $('#' + container).empty();

      Morris.Line({
        element: container,
        data: data,
        
        xkey: 'period',
        ykeys: ['sales'],
        
        labels: ['Sales'],   
        hideHover: 'auto',
        lineWidth: 2,
        pointSize: 4,
        lineColors: ['#59dbbf'],
        fillOpacity: 0.5,
        smooth: true,
        parseTime: false,

        yLabelFormat: function (y) { return '$' + y.toString(); },
        // xLabelFormat: function (x) { console.log(x); }
      });
    };

    $('#hero-area').each(function(){
      // buildArea();
      // var morrisResizes;
      // $(window).resize(function(e) {
      //   clearTimeout(morrisResizes);
      //   morrisResizes = setTimeout(function(){
      //     $('.graph').html('');
      //     buildArea();
      //   }, 500);
      // });
    });

    $('[data-r-status]').on('click', function(e) {
      e.preventDefault();

      if(!confirm('Change status of request?'))
        return;

      var lnk = $(this);

      $.post('/admin/lastname_requests', {
        id: lnk.data('id'), status: lnk.data('r-status')
      }, function(data) {
        if(data.success)
        {
          location.reload();
        }
        else
        {
          alert(data.msg);
        }
      }, 'json');
    });
  });
</script>