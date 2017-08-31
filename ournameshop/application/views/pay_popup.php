<div id="pay-popup" class="pay-popup">
	<div class="clearfix">
		<a href="javascript:$.fancybox.close();" class="pclose"></a>
	</div>
	<h4>Secure<br>Payment Info</h4>
	<form action="" method="post" class="pay-popup-frm">
		<div class="choose-method margin-top clearfix">
			<div class="pay-type">
				<div class="ccType">
					<label>
						<input type="radio" name="method" checked value="<?php echo PAY_METHOD_STRIPE;?>" />
						<img style="margin-top:-12px;" src="/img/mastercard5.svg" data-method="stripe">
						<img style="margin-top:-4px; width:33px; height:24px;" src="/img/visa6.svg" data-method="stripe">
						<img style="margin-top:-12px;" src="/img/american16.svg" data-method="stripe">
						<img style="margin-top:-12px; margin-left:-1px;" src="/img/discover1.svg" data-method="stripe">
					</label>
				</div>
				<div class="ppType">
					<label>
						<input type="radio" name="method" value="<?php echo PAY_METHOD_PP;?>" />
						<img data-method="paypal" src="/img/paypal11.svg">
					</label>
				</div>
			</div>
		</div>

		<div class="pay-popup-form">
			<div class="stripe-frm">
				<div class="card-info">
					<div class="field">
						<label>Name (as it appears on your card)</label>
						<input type="text" name="payer_name" class="form-control" value="<?php echo $user->first_name; ?> <?php echo $user->last_name; ?>" />
					</div>
					<div class="field">
						<label>Card number (no dashes or spaces)</label>
						<input type="text" name="cardnum" value="5555 5555 5555 4444" class="form-control" placeholder="Card Number" required />
					</div>
					<div class="field">
						<label>Expiration date</label>
						<div class="clearfix">
							<select name="exp_month" class="form-control expireMonth">
								<?php for($i = 1; $i <= 12; $i++):?>
									<option value="<?php echo $i;?>">
										<?php echo $i;?>
									</option>
								<?php endfor;?>
							</select>
							<select name="exp_year" class="form-control expireYear">
								<?php for($i = intval(date('Y')); $i <= intval(date('Y')) + 20; $i++):?>
									<option value="<?php echo $i;?>"<?php if($i == date('Y')) echo ' selected';?>>
										<?php echo $i;?>
									</option>
								<?php endfor;?>
							</select>
						</div>
					</div>
					<div class="field">
						<label>Security code (3 on back, Amex; 4 on front)</label>
						<input type="text" name="cvv" value="123" style="width: 143px;" placeholder="CVV Number" class="form-control" required />
					</div>
				</div>
				<div class="margin-top align-center">
					<input type="submit" class="btn btn-success btn-block" value="Pay Now" />
				</div>
			</div>
		</div>
	</form>
</div>