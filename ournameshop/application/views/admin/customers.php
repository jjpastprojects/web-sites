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
                    <li><span>Shops</span></li>
                    <li class="active"><span>Customers</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?php if(isset($sh)):?>
					<?php echo $shop->name;?> /
				<?php endif;?>
				Customers
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
                	<?php if(isset($sh)):?>
						<?php echo $shop->name;?> /
					<?php endif;?>
					Customers
	            </div>
	            <div class="panel-body table-responsive">
	            	<form action="/admin/customers" method="get" class="form-inline">
						<div class="row">
							<div class="col-xs-8">
								<div class="form-group">
							        <input name="search" placeholder="search customers" type="text" class="form-control" value="<?php echo form_prep($this->input->get('search'));?>" />
							     </div>
							     <button type="submit" class="btn btn-info">Search</button>
							</div>
							<div class="col-xs-4 text-right">
								<a href="/admin/export_customers" class="btn btn-default">Export</a>
							</div>
						</div>
					</form>
	                <table class="table table-hover table-striped margin-top-15" width="100%">
	                    <thead>
		                    <tr>
								<th width="40">#</th>
								<th data-sort-field="first_name">Name</th>
								<th>Shop</th>
								<th class="text-center" data-sort-field="orders_cnt">Orders</th>
								<th class="text-center" data-sort-field="spent">Spent money</th>
								<th>Address</th>
								<th data-sort-field="created_on">Registered</th>
								<th data-sort-field="last_login">Last login</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($customers as $customer):?>
							<tr>
								<td>
									<?php echo $customer->id;?>
								</td>
								<td>
									<?php echo sprintf('%s %s', $customer->first_name, $customer->last_name);?><br />
									<?php echo $customer->email;?>

									<?php if($customer->phone):?>
										<br />
										<?php echo $customer->phone;?>
									<?php endif;?>
								</td>
								<td>
									<a href="<?php echo shop_url($customer->shop);?>">
										<?php echo $customer->shop_name;?>
									</a>
								</td>
								<td class="text-center">
									<h5>
										<?php if($customer->orders_cnt):?>
											<a href="/admin/orders?user_id=<?php echo $customer->id;?>">
												<?php echo $customer->orders_cnt;?>
											</a>
										<?php else:?>
											-
										<?php endif;?>
									</h5>
								</td>
								<td class="text-center">
									<h5>
										<?php echo $customer->spent ? format_price($customer->spent) : '-';?>
									</h5>
								</td>
								<td>
									<?php echo $customer->address;?>

									<?php if($customer->address2):?>
										<br />
										<?php echo $customer->address2;?>
										<br />
									<?php endif;?>

									<?php echo $customer->city;?>
									<?php echo $customer->state;?>
									<?php echo $customer->zip;?>

									<?php if($customer->country):?>
										<br />
										<?php echo $customer->country;?>
									<?php endif;?>
								</td>
								<td>
									<?php echo format_date($customer->created_on);?>
								</td>
								<td>
									<?php echo time_elapsed_string($customer->last_login);?>
								</td>
								<td>
									<a href="/admin/login_as/<?php echo $customer->id;?>" title="Login" class="btn btn-action btn-success">
										<i class="fa fa-sign-in"></i>
									</a>
									<a href="#" data-delete-id="<?php echo $customer->id;?>" title="Delete" class="btn btn-action btn-danger">
										<i class="fa fa-trash-o"></i>
									</a>
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
		$('[data-delete-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Delete customer? All related data (orders, user\'s favorites etc. will be lost)'))
				return;

			var lnk = $(this);

			$.post('/admin/customers', {id: lnk.data('delete-id')}, function(data) {
				if(data.success)
				{
					location.reload();
				}
				else
				{
					alert('Server error');
				}
			}, 'json');
		});

		$('table').thsort({
            current_sort_field : '<?php echo $order_field;?>',
            current_sort_order : '<?php echo $order_dir;?>',
            qs                 : '<?php echo preg_replace('/&?sort=\w+&order=\w+/', '', $_SERVER['QUERY_STRING']);?>',
            current_url        : '<?php echo current_url();?>' 
        });

		<?php if($this->input->get('search')):?>
           $('table tr td').highlight('<?php echo $this->input->get('search');?>', 'highlight');
        <?php endif;?>
	});
</script>
