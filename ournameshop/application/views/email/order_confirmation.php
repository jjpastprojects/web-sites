<p>Hello <?php echo $order->name;?></p>

<p>
	Your order #<?php echo $order->id;?> has been placed successfuly.
</p>

<p>Order Items:</p>

<table>
	<tr>
	</tr>

	<?php foreach($items as $item):?>
		<tr>
			<td>
				<?php echo $item->params->name;?>

				<?php if(bits($item->options, CART_ITEM_OPTION_DIGITAL)):?>
					[ <a href="<?php echo download_product_url($item);?>">download</a> ]
				<?php endif;?>

				<?php if($item->q > 1):?>
					x<?php echo $item->q;?>
				<?php endif;?>
			</td>
			<td>
				<?php echo format_price($item->price * $item->q);?>
			</td>
		</tr>
	<?php endforeach;?>
	<tr>
		<td style="padding-top: 20px;" colspan="2" align="right">
			<h4>Subtotal: <?php echo format_price($order->subtotal);?></h4>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<h4>Shipping: <?php echo format_price($order->shipping);?></h4>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			<h4>Total: <?php echo format_price($order->total);?></h4>
		</td>
	</tr>
</table>