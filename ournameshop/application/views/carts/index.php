<?php $this->load->view('catalog/family_header.inc.php');?>

<div class="container">
<div class="row margin-top">
	<div class="col-lg-7 col-xs-12 col-xs-offset-0 col-lg-offset-3">
		<?php if($items):?>
			<form action="" method="post" class="cart-form">
				<table class="table cart-items">
					<tr>
						<th>Item</th>
						<th></th>
						<th class="text-left">Price</th>
						<th class="text-center q">Qty.</th>
						<th class="text-right">Total</th>
					</tr>
					<tbody>
						<?php foreach($items as $item):?>
							<tr class="cart-item" data-id="<?php echo $item->id;?>">
								<td class="img">
									<img src="<?php echo $item->custom_print ? custom_print_url($item) : tpl_thumb($item->template);?>" alt="" />
								</td>
								<td>
									<p>
										<a href="<?php echo product_url($item->lastname, $item->template, $item->surface, $item->product);?>?variant_id=<?php echo $item->surface_id;?>">
											<?php echo $item->params->name;?>
										</a>
									</p>
								</td>
								<td class="price-padding text-left">
									<?php echo format_price($item->price);?>
								</td>
								<td class="text-center price-padding-input">
									<input type="text" class="form-control text-center q-input" value="<?php echo $item->q;?>" />
									<a href="#" class="remove-from-cart">remove</a>
								</td>
								<td class="price-padding text-right total">
									<?php echo format_price($item->price * $item->q);?>
								</td>
							</tr>
						<?php endforeach;?>
						<tr>
							<td colspan="5" class="text-right">
								<h4>
									Subtotal:
									<span class="subtotal">
										<?php echo format_price($this->carts->subtotal());?>
									</span>
								</h4>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<?php if($this->carts->diff_warehouse()):?>
									<div class="alert alert-info">
										<i>
											You have selected items located in different warehouses. 
											Additional shipping costs may apply.
										</i>
									</div>
								<?php endif;?>
							</td>
							<td class="text-right">
								<a href="/cart/shipping" class="btn btn-success btn-lg">
									Checkout
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		<?php else:?>
			<div class="alert alert-info">
				Your cart is empty
			</div>
		<?php endif;?>
	</div>
</div>
</div>