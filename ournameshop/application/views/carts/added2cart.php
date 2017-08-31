<div class="added2cart">
	<span class="glyphicon glyphicon-remove close-fancybox" aria-hidden="true"></span>
	<div class="text-center">
		<span class="glyphicon glyphicon-ok glyphicon-green" aria-hidden="true"></span>	
		<h4 class="text-green" style="margin-top: 5px;">Item added to your cart</h4>
	</div>

	<div class="row margin-top-20">
		<div class="col-lg-6 text-center">
			<img class="product-img" src="<?php echo custom_print_url($item);?>" alt="" />
		</div>

		<div class="col-lg-6">
			<h4 class="name"><?php echo ucfirst(mb_strtolower($lastname));?> Family</h4>
			<div class="description">
				<?php echo $variant->name;?>
			</div>

			<h2 class="price text-green">
				<?php echo format_price($variant->price * $q);?>
			</h2>

			<div class="quantity">
				Quantity: <?php echo $q;?>
			</div>
		</div>
	</div>

	<div class="row btns-holder">
		<div class="col-lg-6">
			<a href="#" class="close-fancybox btn custom-default-md btn-block">
				Keep Browsing
			</a>
		</div>

		<div class="col-lg-6">
			<a class="btn custom-success-md btn-block" href="/cart/">
			<!--	Checkout (<?php echo sinlural($cart_items_cnt, 'item');?>)-->
				Checkout (<?php echo $cart_items_cnt;?>) <?php echo ($cart_items_cnt > 1 ? plural('item') : singular('item'));?>
			</a>
		</div>
	</div>
</div>