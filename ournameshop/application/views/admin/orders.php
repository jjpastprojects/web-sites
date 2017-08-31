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
                    <li class="active"><span>Orders</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?php if(!empty($filter_user)):?>
					<?php echo sprintf('%s %s', $filter_user->first_name, $filter_user->last_name);?> /
				<?php elseif(!empty($sh)):?>
					<?php echo $sh->name;?> /
				<?php endif;?>
				Orders
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
                	<?php if(!empty($filter_user)):?>
						<?php echo sprintf('%s %s', $filter_user->first_name, $filter_user->last_name);?> /
					<?php elseif(!empty($sh)):?>
						<?php echo $sh->name;?> /
					<?php endif;?>
					Orders
	            </div>
	            <div class="panel-body table-responsive">
	                <table class="table table-hover table-striped" width="100%">
	                    <thead>
		                    <tr>
								<th width="40">#</th>
								<th data-sort-field="name">Name</th>
								<th>Shop</th>
								<th data-sort-field="subtotal">Total</th>
								<th data-sort-field="status">Status</th>
								<th data-sort-field="create_ts">Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($orders as $order):?>
							<tr>
								<td>
									<?php echo $order->id;?>
								</td>
								<td>
									<?php echo $order->name;?>
								</td>
								<td>
									<a href="<?php echo shop_url($order->shop);?>">
										<?php echo $order->shop_name;?>
									</a>
								</td>
								<td>
									<?php echo format_price($order->total);?>
								</td>
								<td>
									<span class="table-label">
										<?php if($order->status == ORDER_STATUS_PAID):?>
											<label class="label bg-success">
												Paid</label>
										<?php elseif($order->status == ORDER_STATUS_UNPAID):?>
											<label class="label bg-dark">
												Awaiting payment</label>
										<?php elseif($order->status == ORDER_STATUS_SHIPPED):?>
											<label class="label bg-warning">
												Shipped</label>
										<?php elseif($order->status == ORDER_STATUS_REFUNDED):?>
											<label class="label bg-info">
												Refunded</label>
										<?php endif;?>
									</span>
									<?php if($order->status > ORDER_STATUS_UNPAID):?>
										<?php echo $order->payment_method == PAY_METHOD_PP ? 'Paypal' : 'Stripe';?>:
										<?php echo $order->transaction_id;?>
									<?php endif;?>
								</td>
								<td>
									<?php echo format_date($order->create_ts);?>
								</td>
								<td>
									<a href="/admin/order/<?php echo $order->id;?>" title="View" class="btn btn-action btn-success">
										<i class="fa fa-file-text-o"></i>
									</a>

									<?php if($order->status == ORDER_STATUS_PAID):?>
										<a href="#" data-refund-id="<?php echo $order->id;?>" title="Refund" class="btn btn-action btn-danger">
											<i class="fa fa-undo"></i>
										</a>
									<?php endif;?>
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
		$('[data-refund-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Refund this payment?'))
				return;

			$.post('/order/refund', {order_id: $(this).data('refund-id')}, function(data) {
				if(data.success)
				{
					alert('Refund Successful');
				}
				else
				{
					alert(data.msg);	
				}
			}, 'json');
		});

		<?php if($this->input->get('search')):?>
           $('table tr td').highlight('<?php echo $this->input->get('search');?>', 'highlight');
        <?php endif;?>

        $('table').thsort({
            current_sort_field : '<?php echo $order_field;?>',
            current_sort_order : '<?php echo $order_dir;?>',
            qs                 : '<?php echo preg_replace('/&?sort=\w+&order=\w+/', '', $_SERVER['QUERY_STRING']);?>',
            current_url        : '<?php echo current_url();?>' 
        });
	});
</script>