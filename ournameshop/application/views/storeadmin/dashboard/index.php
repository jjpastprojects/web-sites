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
        <div class="col-sm-12">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Statistics
                </div>
                <div class="panel-body">
                    <div class="col-sm-3">
                        <section class="panel hbox">
                            <aside class="bg-info r-l text-center v-middle">
                                <div class="wrapper">
                                    <i class="fa fa-money fa-4x"></i>
                                </div>
                            </aside>
                            <aside>
                                <div class="wrapper text-center light-gray-bg">
                                    <p class="h1"><?php echo custom_number_format(intval($shop->total_profit));?></p>
                                    <span>Total Profit</span>
                                </div>
                            </aside>
                        </section>
                    </div>

                    <div class="col-sm-3">
                        <section class="panel no-borders hbox">
                            <aside class="bg-success r-l text-center v-middle">
                                <div class="wrapper">
                                    <i class="fa fa-dollar fa-4x"></i>
                                </div>
                            </aside>
                            <aside>
                                <div class="wrapper text-center light-gray-bg">
                                    <p class="h1"><?php echo custom_number_format($active_campaigns);?></p>
                                    <span><?php echo $active_campaigns > 1 ? plural('Campaign') : singular('Campaign');?></span>
                                </div>
                            </aside>
                        </section>
                    </div>

                    <div class="col-sm-3">
                        <section class="panel no-borders hbox">
                            <aside class="bg-warning r-l text-center v-middle">
                                <div class="wrapper">
                                    <i class="fa fa-shopping-cart fa-4x"></i>
                                </div>
                            </aside>
                            <aside>
                                <div class="wrapper text-center light-gray-bg">
                                    <p class="h1"><?php echo custom_number_format($total_sales);?></p>
                                    <span>Total Sales</span>
                                </div>
                            </aside>
                        </section>
                    </div>

                    <div class="col-sm-3">
                        <section class="panel no-borders hbox">
                            <aside class="bg-primary r-l text-center v-middle">
                                <div class="wrapper">
                                    <i class="fa fa-users fa-4x"></i>
                                </div>
                            </aside>
                            <aside>
                                <div class="wrapper text-center light-gray-bg">
                                    <p class="h1"><?php echo custom_number_format($total_visitors);?></p>
                                    <span>Visitors</span>
                                </div>
                            </aside>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Profit
                </div>
                <div class="panel-body">
                    <div id="chart-container" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Latest Orders
                </div>
                <div class="panel-body">
                    <?php if($last_orders):?>
                        <?php foreach($last_orders as $o):?>
                        <div class="clearfix">
                            <div class="pull-right">
                                <h3 class="text-success">
                                    <?php echo format_price($o->total);?>
                                </h3>
                            </div>
                            #<?php echo $o->id;?>
                            <h4>
                                <a href="/<?php echo STORE_ADMIN_URL_PREFIX;?>/orders/order/<?php echo $o->id;?>" class="text-warning">
                                    <?php echo $o->name;?>
                                </a>
                                <small class="text-muted">
                                    <?php echo relative_date($o->create_ts);?>
                                </small>
                            </h4>
                            <hr />
                        </div>
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="alert alert-info">
                            No Orders
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Active Campaigns
                </div>
                <div class="panel-body">
                    <?php if($active_campaigns_list):?>
                        <?php foreach($active_campaigns_list as $campaign):?>
                        <div class="clearfix">
                            <div class="pull-right">
                                <h3>
                                    <span class="text-warning" title="Goal">
                                        <?php echo $campaign->goal;?>
                                    </span> /
                                    <span class="text-success" title="Sales">
                                        <?php echo $campaign->num_sales;?>
                                    </span>
                                </h3>
                            </div>

                            <h4>
                                <a class="text-warning" href="<?php echo product_url(
                                    $campaign->lastname, 
                                    (object)array('slug' => $campaign->tpl_slug),
                                    (object)array('slug' => $campaign->surface_slug),
                                    (object)array('id' => $campaign->product_id)
                                    );?>">
                                    <?php echo $campaign->name;?>
                                </a>
                            </h4>
                            Ends: <?php echo format_date($campaign->till_ts);?>
                        </div>
                        <hr />
                        <?php endforeach;?>
                    <?php else:?>
                        <div class="alert alert-info">
                            No Active Campaigns
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="/js/highcharts.js"></script> -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="/js/exporting.js"></script>

<script>
    $(function() {

        $.getJSON('/manage/dashboard/chart_data', {}, function(data) {
            $('#chart-container').highcharts('StockChart', {
                chart: {
                    type: 'line',
                },

                title: null,

                yAxis: 
                [
                    {
                        min: 0,
                        title: {
                            text: 'Visits / Sales'
                        }
                    },
                    { //profit axis
                        opposite: false,

                        title: {
                            text: 'Profit',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        labels: {
                            format: '${value}',
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    },
                ],

                legend: {
                    enabled: true,
                    align: 'right',
                    backgroundColor: '#FCFFC5',
                    borderColor: 'black',
                    borderWidth: 2,
                    layout: 'vertical',
                    verticalAlign: 'top',
                    y: 100,
                    shadow: true
                },

                tooltip: {
                    shared: true
                },

                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },

                rangeSelector: {
                    buttons: [
                        // {
                        //     type: 'day',
                        //     count: 3,
                        //     text: '3d'
                        // },
                        {
                            type: 'week',
                            count: 1,
                            text: '1w'
                        },
                        {
                            type: 'month',
                            count: 1,
                            text: '1m'
                        },
                        {
                            type: 'month',
                            count: 6,
                            text: '6m'
                        },
                        {
                            type: 'year',
                            count: 1,
                            text: '1y'
                        },
                        {
                            type: 'all',
                            text: 'All'
                        }
                    ],
                    selected: 1
                },

                series: [
                    {
                        name: 'Visits',
                        color: 'rgba(165,170,217,1)',
                        data: data.visits,
                        pointPadding: 0.3,
                        pointPlacement: -0.2,
                    },
                    {
                        name: 'Sales',
                        yAxis: 0,
                        color: '#92cf5c',
                        data: data.sales,
                        pointPadding: 0.4,
                        pointPlacement: -0.1,
                    },
                    {
                        name: 'Profit',
                        yAxis: 1,
                        color: 'rgba(248,161,63,1)',
                        data: data.profit,
                        pointPadding: 0.4,
                        pointPlacement: -0.1,
                    }
                ]
            });
        });
    });
</script>