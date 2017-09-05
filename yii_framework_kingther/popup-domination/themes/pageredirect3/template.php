<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>" <?php echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>

		<div style="width: 570px" id="popdom-pop" class="popup2 lightbox-main lightbox-color-<?PHP echo $color ?>">
			<a href="#" class="close lightbox-close" id="<?php echo $lightbox_close_id?>">&times;</a>
			<div class="inner">
				<h1><?PHP echo $fields['title']; ?></h1>
				<div class="left">
					<img src="<?PHP if(!empty($fields['image_left'])) { echo $fields['image_left']; } else { echo $this->currentcss . '/images/increase.png'; } ?>" alt="Increase">
				</div>
				<div class="right">
					<p><?PHP echo $fields['description']; ?></p>
					<a target="_parent" href="<?PHP echo $fields['button_url']; ?>" class="button button-<?php echo $button_color ?>"><?PHP echo $fields['button_text']; ?></a>
				</div>
				<div class="clear"></div>
				<?php if(isset($fields['footer_note'])){ ?>
					<p class="secure"><?php echo $fields['footer_note']; ?></p>
				<?php } ?>
			</div>
		</div>


</div>