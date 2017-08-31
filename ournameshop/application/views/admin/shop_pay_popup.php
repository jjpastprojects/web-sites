<div style="width: 400px;">
	<form action="/admin/shop_pay_popup" method="post" class="pay-shop-frm">
		<input type="hidden" name="shop_id" value="<?php echo $curr_shop->id;?>" />

		<h4>
			Make payment for <b><?php echo $curr_shop->name;?></b> owner
		</h4>

		<h4>
			Current Balance:
			<span class="text-success">
				<b>
					$<?php echo $curr_shop->balance;?>
				</b>
			</span>
		</h4>

		<?php if($curr_shop->balance > 0):?>
			<div class="alert alert-info">
				<?php if(!empty($options['pp_email'])):?>
					Please send payment to paypal email <b><?php echo $options['pp_email']->option_value;?></b><br />
					After you can click button "PAY" to reset shop's balance.
				<?php else:?>
					paypal email not set
				<?php endif;?>
			</div>

			<?php if(!empty($options['pp_email'])):?>
				<button type="submit" class="btn btn-info" style="float: right;">PAY</button>
			<?php endif;?>
		<?php endif;?>
	</form>
</div>