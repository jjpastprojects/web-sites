<?php $this->load->view('catalog/family_header.inc.php');?>
<div class="container">
	<div class="row margin-top padding-bottom-70">
		<div class="col-lg-8 col-lg-offset-3 col-md-7 col-md-offset-2 col-sm-7 col-sm-offset-2">
			<?php if($this->session->flashdata('error')):?>
				<div class="alert alert-danger">
					<p>Oops!</p>
					
					We can not place your order due reason:<br />
					<strong>
						<?php echo $this->session->flashdata('error');?>
					</strong>
				</div>
			<?php endif;?>


				<h3>Order #<?php echo $order->id;?> / Confirm Details</h3>

				<h4 class="margin-top">Order Items:</h4>
				<div class="row">
					<div class="col-lg-8 col-md-12 col-sm-12">
						<div class="row">
							<?php foreach($items as $k => $item):?>
								<?php if($k > 0):?>
									<div class="col-lg-12">
										<hr />
									</div>
								<?php endif;?>
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
									
									<?php echo $item->params->name;?>
									
									<?php if($item->q > 1):?>
										x<?php echo $item->q;?>
									<?php endif;?>
								</div>
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right">
									<?php echo format_price($item->price * $item->q);?>
								</div>
							<?php endforeach;?>	
						</div>
						<hr />
					</div>
				</div>

				

				<div class="row margin-top">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<?php if($order->address):?>
							<h4>Shipping Address:</h4>

							<p>
								<?php if($order->paypal_address):?>
									from PayPal
								<?php else:?>
									<?php echo $order->address;?><br />

									<?php if($order->address2):?>
										<?php echo $order->address2;?><br />
									<?php endif;?>

									<?php echo $order->city;?>,
									<?php echo $order->state . ' ' . $order->zip;?><br />
									<?php echo $order->country;?>
								<?php endif;?>
							</p>
						<?php else:?>
							<h4>Download Link:</h4>

							<p class="text-info"><i>Will be available after payment</i></p>
						<?php endif;?>
					</div>

					<div class="col-lg-4 col-md-6 col-sm-6">
						<h4>Order Summary:</h4>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								Subtotal:
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
								<?php echo format_price($order->subtotal);?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								Shipping:
							</div>
							<div class="col-lg-6 col-md-6 col-xs-6 text-right">
								<?php echo format_price($order->shipping);?>
							</div>
						</div>
						<hr />
						<div class="row text-success">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								Order Total:
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
								<strong><?php echo format_price($order->total);?></strong>
							</div>
						</div>

						<button type="submit" id="pay-btn" class="btn btn-success margin-top">
							Pay
						</button>
						<a href="/cart/shipping" class="btn btn-default margin-top">
							Go back
						</a>
					</div>
				</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('#pay-btn').on('click', function(e) {
			e.preventDefault();

			$.fancybox.open({
				href: '#pay-popup',
				closeBtn: false
			});
		});

		$(document).on('submit', '.pay-popup-frm', function(e){
			e.preventDefault();
			
			var frm = $(this);
			frm.find('input:submit').val('please wait...').attr('di111sabled', true);

			$.post('/cart/pay', frm.serialize(), function(data) {

				if(data.success)
				{
					if(data.redirect)
					{
						window.location = data.redirect;
					}
					else
					{
						window.location = '/cart/payment_success';
					}
				}
				else
				{
					frm.find('input:submit').val('Pay Now').attr('disabled', false);
					alert(data.msg);
				}
			}, 'json');
		})
	});
</script>

<div class="hidden">
	<?php $this->load->view('pay_popup');?>
</div>