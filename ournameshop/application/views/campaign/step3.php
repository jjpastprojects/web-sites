<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h2 class="titlex1">
	    Your Campaign Is Ready!
	    </h2>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h5 class="text_des">
	    Let’s Start Selling! 
	    </h5>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<form action="" method="post">
			<?php if($this->session->flashdata('success')):?>
				<h3 class="text-success">Your campaign was published successfuly!</h3>
				
				<?php
					$url = shop_url($campaign_shop)
					. product_url($lastname->lastname, $template, $variant, (object)array('id' => $variant->product_id));
				?>

				<a href="<?php echo $url;?>">
					Visit product page
				</a>
				<br />
				<a href="<?php echo shop_url($campaign_shop);?>">
					Visit your shop
				</a>
			<?php else:?>

			<div class="row">
				<div class="col-xs-12 col-sm-12" style="margin-top: 40px;">
					<div class="subTxt">
						Product URL
					</div>
					<div class="subTxt2">
						This is where you will send buyers to view your product for sale
					</div>
				</div>
				<?php
					$url = shop_url($campaign_shop) 
					. product_url($lastname->lastname, $template, $variant, (object)array('id' => $variant->product_id));
				?>
				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<input type="text" class="form-control custom-input" value="<?php echo $url;?>" />
					</div>
					<div class="text-right">
						<a target="_blank" href="<?php echo $url;?>?p" class="btn btn-xs btn-pr1">
							PREVIEW
						</a>

						<a href="#" class="btn btn-xs btn-pr2">
							COPY URL
						</a>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12" style="margin-top: 40px;">
					<div class="subTxt">
						Full Shop URL
					</div>
					<div class="subTxt2">
						This is where you will send buyers to view your product for sale
					</div>
				</div>
				<?php $url = shop_url($campaign_shop) . '/' . $lastname->lastname;?>
				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<input type="text" class="form-control custom-input" value="<?php echo $url;?>" />
					</div>
					<div class="text-right">
						<a target="_blank" href="<?php echo $url;?>?" class="btn btn-xs btn-pr1">
							PREVIEW
						</a>

						<a href="#" class="btn btn-xs btn-pr2">
							COPY URL
						</a>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12" style="margin-top: 70px">
					<a class="btn btn-prev" href="#">
				 		SAVE AS DRAFT
					</a>
					<button class="btn btn-next" type="submit" name="publish" value="1">
						LAUNCH IT
					</button>
				</div>
			</div>
			<?php endif;?>

		</form>
	</div>

	<div class="col-sm-6 campaign-preview-product">
		<img src="<?php echo $variant->image;?>" class="surface img-thumbnail" />
		<img src="<?php echo saved_logo_url((object) array('filename' => $saved_logo->filename));?>" 
			class="tpl-thumb" alt="" />
	</div>
</div>