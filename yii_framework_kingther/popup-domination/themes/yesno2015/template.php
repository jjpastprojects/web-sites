<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div style="width: 873px" class="popup1 lightbox-main lightbox-color-<?PHP echo $color ?>">
		<div class="header">
			<strong class="logo">
				<img src="<?PHP if(!empty($fields['logo_image'])) { echo $fields['logo_image']; } else { echo $this->currentcss . '/images/logo.jpg'; } ?>" alt="Logo" />
			</strong>
		</div>
		<div class="content">
			<div class="detail">
				<h2><?PHP echo $fields['title']; ?></h2>
				<p><?PHP echo $fields['title_sub']; ?></p>
			</div>
			<div class="btn-holder">
				<a href="<?PHP echo $fields['yes_button_link'] ?>" class="btn <?PHP echo $button_color?>-button"><span><?PHP echo $fields['yes_button_title_text']; ?></span><br> <?PHP echo $fields['yes_button_text']; ?></a>
				<a href="#" class="btn lightbox-close <?PHP echo $button_color?>-button" id="<?php echo $lightbox_close_id?>"><span><?PHP echo $fields['no_button_title_text'] ?></span><br><?PHP echo $fields['no_button_text']; ?></a>
			</div>
			<span class="description"><?PHP echo $fields['footer_note']; ?></span>
		</div>
		<footer class="footer">
			<div class="holder">
				<span class="powered-by">Powered by</span>
				<div class="img-hodler"><a href="#"><img src="<?PHP echo $this->currentcss; ?>/images/logo-bottom.png" width="120" height="34" alt="img description"></a></div>
			</div>
		</footer>
		<a href="#" class="close lightbox-close" id="<?php echo $lightbox_close_id?>"><img src="<?PHP echo $this->currentcss; ?>/images/close.png" width="44" height="44" alt="img description"></a>
	</div>
</div>