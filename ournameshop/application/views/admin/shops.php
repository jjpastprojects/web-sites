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
                    <li class="active"><span>List</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Shops
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
	                Shops
	            </div>
	            <div class="panel-body table-responsive">
	                <table class="table table-hover table-striped" width="100%">
	                    <thead>
		                    <tr>
								<th>Name</th>
								<th>Domain</th>
								<th class="text-center">Sales</th>
								<th class="text-center">Customers</th>
								<th class="text-center">Uniqs 30 days</th>
								<th class="text-center">Balance</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($shops as $sh):?>
							<tr>
								<td>
									<?php echo $sh->name;?>
								</td>
								<td>
									<a href="<?php echo shop_url($sh);?>">
										<?php echo $sh->domain . (!$sh->custom_domain ? '.' . $this->config->item('domain') : '');?>
									</a>
								</td>
								
								<td class="text-center">
									<h5>
										<?php if($sh->sales_cnt):?>
											<a href="/admin/orders?shop_id=<?php echo $sh->id;?>">
												<?php echo $sh->sales_cnt;?>
											</a>
										<?php else:?>
											-
										<?php endif;?>
									</h5>
								</td>
								<td class="text-center">
									<h5>
										<?php if($sh->customers_cnt):?>
											<a href="/admin/customers?shop_id=<?php echo $sh->id;?>">
												<?php echo $sh->customers_cnt;?>
											</a>
										<?php else:?>
											-
										<?php endif;?>
									</h5>
								</td>
								
								<td class="text-center">
									<h5>
										<?php if($sh->uniqs_cnt):?>
											<a href="#">
												<?php echo $sh->uniqs_cnt;?>
											</a>
										<?php else:?>
											-
										<?php endif;?>
									</h5>
								</td>
								<td class="text-center">
									<?php if($sh->balance > 0):?>
										<span class="text-success">
											<b>
												+$<?php echo $sh->balance;?>
											</b>
										</span>
									<?php else:?>
										$<?php echo $sh->balance;?>
									<?php endif;?>
								</td>
								<td>
									<?php if($sh->balance > 0):?>
										<a href="#" title="Pay" class="btn btn-action btn-info" data-pay-id="<?php echo $sh->id;?>">
											<i class="fa fa-paypal"></i>
										</a>
									<?php endif;?>
									<a href="/admin/login_as/<?php echo $sh->user_id;?>" title="Login" class="btn btn-action btn-success">
										<i class="fa fa-sign-in"></i>
									</a>
									<a href="#" data-delete-id="<?php echo $sh->id;?>" title="Delete" class="btn btn-action btn-danger">
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
		$(document).on('submit', '.pay-shop-frm', function(e) {
			e.preventDefault();

			var frm = $(this);
			frm.find('button:submit').text('Please wait...');

			$.post(frm.prop('action'), frm.serialize(), function(data) {
				if(data.success)
				{
					location.reload();
				}
				else
				{
					frm.find('button:submit').text('PAY');
				}
			}, 'json');
		});

		$('[data-pay-id]').on('click', function(e) {
			e.preventDefault();
			var lnk = $(this);

			$.fancybox.open({
				href: '/admin/shop_pay_popup?id=' + lnk.data('pay-id'),
				type: 'ajax'
			});
		});

		$('[data-delete-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Delete shop? All related data (orders, customers etc. will be lost)'))
				return;

			var lnk = $(this);

			$.post('/admin/shops', {id: lnk.data('delete-id')}, function(data) {
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
	});
</script>