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
                    <li class="active"><span>Orders</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                My Orders
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<?php if($orders):?>
	  			<?php $i=0;
	  			foreach($orders as $order):?>  	
				<div class="hpanel customer-order <?php echo $i%2?'hblue':'hgreen';?>">
			      	<ul class="nav nav-tabs nav-justified">
				        <li class="active">
				        	<a href="#order-<?php echo $order->id;?>-items" data-toggle="tab">
				        		Order #<?php echo $order->id;?> - <?php echo format_date($order->create_ts);?>
				        	</a>
				        </li>
				        <li>
				        	<a href="#order-<?php echo $order->id;?>-shipping" data-toggle="tab">
				        		Shipping
				        	</a>
				        </li>
			      	</ul>
			        <div class="tab-content">
				        <div class="tab-pane active" id="order-<?php echo $order->id;?>-items">
				        	<div class="panel-body">
					        	<ul class="list-group alt">
									<?php foreach($order->items as $item):?>
										<li class="list-group-item">
											<div class="media">
												<div class="pull-right media-xs text-center text-muted">
													<strong class="h4">
														<?php echo format_price($item->price * $item->q);?>
													</strong>
												</div>
												<div class="media-body">
													<div class="row">
														<div class="col-sm-3 order-logo">
															<img src="<?php echo print_url($item);?>" />
														</div>
														<div class="col-sm-8">
															<?php echo $item->params->name;?>
															<?php if($item->q > 1):?>
																x<?php echo $item->q;?>
																<?php endif;?>
																<?php if(bits($item->options, CART_ITEM_OPTION_DIGITAL)):?>
																<p class="margin-top">
																	<a target="_blank" href="<?php echo download_product_url($item);?>" class="btn btn-info">Download</a>
																</p>
															<?php endif;?>
														</div>
													</div>
												</div>
											</div>
										</li>
									<?php endforeach;?>
							  		<li class="list-group-item">
							        	<div class="row">
							        		<div class="col-lg-6">
							        			Order Status:
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
							        		</div>
							        		<div class="col-lg-6 text-right">
									        	<p>
									        		Subtotal: <?php echo format_price($order->subtotal);?>
									        	</p>
									        	<p>
									        		Shipping: <?php echo format_price($order->shipping);?>
									        	</p>
									        	<h4>
									        		Total: <?php echo format_price($order->total);?>
									        	</h4>
									        </div>
									    </div>
							        </li>
							    </ul>
						    </div>
				        </div>
				        <div class="tab-pane" id="order-<?php echo $order->id;?>-shipping">
				        	<div class="panel-body">
			                	<div class="row">
			                		<div class="col-sm-6">
					                	<h4><?php echo $order->name;?></h4>

										<?php echo $order->email;?><br />
										<?php echo $order->phone;?><br /><br />

					                	<?php echo $order->address;?><br />

										<?php if($order->address2):?>
											<?php echo $order->address2;?><br />
										<?php endif;?>

										<?php echo $order->city;?>,
										<?php echo $order->state . ' ' . $order->zip;?><br />
										<?php echo $order->country;?>
									</div>
									<?php if($order->ship_date):?>
										<div class="col-sm-6">
											Order was shipped at
											<?php echo format_date($order->ship_date);?>

											<?php if($order->tracking_number):?>
												<br /><br />
												Tracking Number:
												<code><?php echo $order->tracking_number;?></code>
											<?php endif;?>

											<?php if($order->tracking_url):?>
												<br /><br />
												Tracking Url:
												<a href="<?php echo $order->tracking_url;?>">
													<?php echo $order->tracking_url;?>
												</a>
											<?php endif;?>
										</div>
									<?php endif;?>
								</div>
							</div>
		                </div>
				    </div>
				</div>
				<?php  $i++;
				endforeach;?>

				<div class="col-sm-12 text-center no-padding">
                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
            	</div>

			<?php else:?>
				<div class="hpanel hgreen">
	                <div class="panel-heading">
	                    <div class="panel-tools">
	                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
	                        <a class="closebox"><i class="fa fa-times"></i></a>
	                    </div>
	                    Orders
	                </div>
	                <div class="panel-body">
	                    <div class="alert alert-info">
				  			You have no orders yet
				  		</div>
	                </div>
	            </div>
		  	<?php endif;?>
		</div>
	</div>
</div>