<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="container">
	<div class="row margin-top padding-bottom-70">
		<div class="col-lg-5 col-md-6 col-md-offset-3 col-lg-offset-3 col-sm-8 col-sm-offset-2">
			<form class="shipping-form" action="" method="post" onsubmit="$(this).find('button:submit').attr('disabled', true).text('please wait...');">
				<?php if($this->carts->diff_warehouse()):?>
					<div class="alert alert-info">
						<i>
							You have selected items located in different warehouses. 
							Additional shipping costs may apply.
						</i>
					</div>
				<?php endif;?>
				<h3>Shipping Info</h3>

				<?php if(!empty($error)):?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
				<?php endif;?>
				
				<div class="margin-top">
					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>Full Name *</label>
							    <input value="<?php echo form_prep($order ? $order->name : ($user->first_name . ' ' . $user->last_name));?>" name="name" class="form-control" data-required="true" />
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>Country *</label>
							    <select name="country" class="form-control" data-required="true">
							    	<?php foreach($this->countries->get_all() as $country):?>
							    		<option value="<?php echo $country->code;?>"<?php if($order && $country->code == $order->country || !$order && $user->country == $country->code) echo ' selected';?>>
							    			<?php echo $country->name;?>
							    		</option>
							    	<?php endforeach;?>
							    </select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>Address Line 1 *</label>
							    <input value="<?php echo form_prep($order ? $order->address : $user->address);?>" name="address" class="form-control" data-required="true" />
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>Address Line 2</label>
							    <input value="<?php echo form_prep($order ? $order->address2 : $user->address2);?>" name="address2" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>City *</label>
							    <input value="<?php echo form_prep($order ? $order->city : $user->city);?>" name="city" class="form-control" data-required="true" />
							</div>
						</div>

						<div class="col-lg-6 col-sm-6">
							<div class="form-group">
							    <label>State/Region *</label>
								<select name="state" class="form-control">
									<?php foreach($this->config->item('states_f') as $state):?>
										<option value="<?php echo $state;?>"<?php if($order && $state == $order->state) echo ' selected';?>>
											<?php echo $state;?>
										</option>
									<?php endforeach;?>
								</select>

							    <input value="<?php echo form_prep($order ? $order->state : $user->state);?>" name="state" class="form-control hidden" data-required="true" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4 col-sm-4">
							<div class="form-group">
							    <label>Postal Code *</label>
							    <input value="<?php echo form_prep($order ? $order->zip : $user->zip);?>" name="zip" class="form-control" data-required="true" />
							</div>
						</div>

						<div class="col-lg-4 col-sm-4">
							<div class="form-group">
							    <label>Phone *</label>
							    <input value="<?php echo form_prep($order ? $order->phone : $user->phone);?>" name="phone" class="form-control" data-required="true" />
							</div>
						</div>

						<div class="col-lg-4 col-sm-4">
							<div class="form-group">
							    <label>Email *</label>
							    <input value="<?php echo form_prep($order ? $order->email : $user->email);?>" name="email" type="email" class="form-control" data-required="true" />
							</div>
						</div>
					</div>

					<?php if($this->carts->has_printfull()):?>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
								    <label>Shipping Method *</label>
								    <p>
								    	<small>
										    <?php foreach($items as $k => $item):?>
										    	<?php if(is_printfull_product($item->product_type)):?>
										    		<?php echo $item->params->name;?>
										    	<?php endif;?>
										    <?php endforeach;?>
										</small>
									</p>    
								    <select name="printfull_shipping_id" class="form-control" required>
								    	<option value="">
								    		Please fill your address to see shipping options
								    	</option>
								    </select>
								    <img src="/img/ajax-loader.gif" class="loading" alt="loading" />
								</div>
							</div>
						</div>
					<?php endif;?>

					<?php if($this->carts->has_printaura()):?>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
								    <label>Shipping Method *</label>
								    <p>
								    	<small>
										    <?php foreach($items as $k => $item):?>
										    	<?php if(is_printaura_product($item->product_type)):?>
										    		<?php echo $item->params->name;?>
										    	<?php endif;?>
										    <?php endforeach;?>
										</small>
									</p>    
								    <select name="printaura_shipping_id" class="form-control" required>
								    	<?php foreach($print_aura_shipping as $sh_m):?>
								    		<option hidden data-country-code="<?php echo isset($pa_s2cc[$sh_m->shipping_zone]) ? $pa_s2cc[$sh_m->shipping_zone] : 'other';?>" value="<?php echo $sh_m->shipping_id;?>">
									    		<?php echo $sh_m->shipping_option_name;?>
									    	</option>
									    <?php endforeach;?>
								    </select>
								    <!-- <img src="/img/ajax-loader.gif" class="loading" alt="loading" /> -->
								</div>
							</div>
						</div>
					<?php endif;?>
				</div>

				<button type="submit" class="btn btn-success">
					Continue
				</button>
				<label>
					<input type="checkbox" name="save_addr" value="1" />
					Save my shipping info for further orders
				</label>
			</form>
		</div>
	</div>
</div>

<script>
	$(function() {
		var pa_shipping_methods = <?php echo json_encode(object_transparent($print_aura_shipping, 'shipping_zone'));?>;

		$('[name=country]').on('change', function() {
			var cc 			= $(this).val();
			var ship_sel 	= $('[name=printaura_shipping_id]');

			ship_sel.find('option').prop('hidden', true);

			if(cc == 'US' || cc == 'CA')
			{
				ship_sel.find('option[data-country-code=' + cc + ']').prop('selected', true).prop('hidden', false);
			}
			else
			{
				ship_sel.find('option[data-country-code=other]').prop('selected', true).prop('hidden', false);
			}

		}).trigger('change');

		//checkout
		$('.shipping-form input[data-required]').attr('required', true);
		
		$('.shipping-form [name=country], .shipping-form [name=state], .shipping-form [name=zip]').on('change', function(e) {
		    var frm = $('.shipping-form');

		    var params = {
		      country_code: frm.find('[name=country]').val(),
		      state_code:   frm.find('[name=state]').val(),
		      zip:          frm.find('[name=zip]').val() 
		    }

		    if(!params.country_code || !params.state_code || !params.zip)
		      return;

		    var sel = $('[name=printfull_shipping_id]');
		    sel.empty();

		    $('img.loading').fadeIn('fast');

		    $.getJSON('/cart/shipping_methods', params, function(data) {
		      $('img.loading').fadeOut('fast');

		      if(data.success)
		      {
		        $.each(data.methods, function(i,v) {   
		          sel.append('<option value="' + v.id + '">$' + v.rate + ' ' + v.name + '</option>');
		        });

		        $(document).trigger('shipping_methods_loaded');
		      }
		      else
		      {

		      }
		    });
		});

		<?php if($order):?>
			$(document).on('shipping_methods_loaded', function() {
				$('[name=shipping_id]').val('<?php echo $order->shipping_id;?>');
			});
		<?php endif;?>
		
		$('.shipping-form [name=country]').on('change', function() {
			if($(this).val() == 'US')
			{
				$('select[name=state]').removeClass('hidden').prop('disabled', false);
				$('input[name=state]').addClass('hidden').prop('disabled', true);
			}
			else
			{
				$('select[name=state]').addClass('hidden').prop('disabled', true);
				$('input[name=state]').removeClass('hidden').prop('disabled', false);
			}
		});
		$('.shipping-form [name=country]').trigger('change');
	});
</script>