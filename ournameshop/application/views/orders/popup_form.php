<form action="/orders/place" method="post" style="width: 400px;" class="popup-order-form">
	<input type="hidden" name="tpl_id" value="<?php echo intval($this->input->get('tpl_id'));?>" />

	<input type="hidden" name="size_id" value="<?php echo intval($this->input->get('size_id'));?>" />
	<input type="hidden" name="brand_id" value="<?php echo intval($this->input->get('brand_id'));?>" />
	
	<input type="hidden" name="color_id" value="<?php echo intval($this->input->get('color_id'));?>" />
	<input type="hidden" name="product_id" value="<?php echo intval($this->input->get('fashion_id'));?>" />


	<div class="alert alert-success hidden">
		Thank You. Your order has been placed.
	</div>
	<div class="form">
		<div class="form-group">
			<label for="">Your Name *</label>
			<input type="text" required class="form-control" name="name" />
		</div>

		<div class="form-group">
			<label for="">Address *</label>
			<input type="text" required class="form-control" name="address" />
		</div>

		<div class="form-group">
			<label for="">Address 2</label>
			<input type="text" class="form-control" name="address2" />
		</div>

		<div class="form-group">
			<label for="">City *</label>
			<input type="text" required class="form-control" name="city" />
		</div>

		<div class="form-group">
			<label for="">State / Province *</label>
			<input type="text" required class="form-control" name="state" />
		</div>

		<div class="form-group">
			<label for="">Zip Code *</label>
			<input type="text" required class="form-control" name="zip" />
		</div>

		<div class="form-group">
			<label for="">Country *</label>
			<input type="text" required class="form-control" name="country" value="US" />
		</div>

		<button type="submit" class="btn btn-success">Place Order</button>
	</div>
</form>