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
                    <li><span>Logotypes</span></li>
                    <li class="active"><span>Templates</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Templates
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel hgreen">
	            <div class="panel-heading">
	                <div class="panel-tools">
	                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
	                    <a class="closebox"><i class="fa fa-times"></i></a>
	                </div>
                	Templates
	            </div>
	            <div class="panel-body table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="40">#</th>
								<th data-sort-field="name">Name</th>
								<th data-sort-field="price">Price</th>
								<th data-sort-field="num_views">Views</th>
								<th data-sort-field="num_sales">Sales</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($templates as $l):?>
							<tr>
								<td>
									<?php echo $l->id;?>
								</td>
								<td>
									<?php echo $l->name;?>
								</td>
								<td>
									<?php echo format_price($l->price);?>
								</td>
								<td>
									<?php echo $l->num_views;?>
								</td>
								<td>
									<?php echo $l->num_sales;?>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
	                <div class="col-sm-12 text-center">
	                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
                	</div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('table').thsort({
	        current_sort_field : '<?php echo $order_field;?>',
	        current_sort_order : '<?php echo $order_dir;?>',
	        qs                 : '<?php echo preg_replace('/&?sort=\w+&order=\w+/', '', $_SERVER['QUERY_STRING']);?>',
	        current_url        : '<?php echo current_url();?>' 
	    });
	});
</script>