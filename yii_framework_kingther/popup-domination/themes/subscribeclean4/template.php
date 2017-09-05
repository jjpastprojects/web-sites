<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div style="width: 761px" class="popup2 lightbox-main lightbox-color-<?PHP echo $color ?>">
		<h2><?PHP echo $fields['title']; ?></h2>
		<div class="book-detail">
			<div class="img-holder">
				<img src="<?PHP if(!empty($fields['book_image'])) { echo $fields['book_image']; } else { echo $this->currentcss . '/images/book.png'; } ?>" alt="Ebook">
			</div>
			<div class="detail">
				<h3><?PHP echo $fields['description_title']; ?></h3>
				<p><?PHP echo $fields['description']; ?></p>
			</div>
		</div>
		<form method="post" action="<?php echo $form_action ?>"<?php echo $target; ?> class="email-form">
			<?PHP echo str_replace('placeholder="" name="email"', 'placeholder="Email Address" name="email"', (isset($inputs['hidden']) ? $inputs['hidden'] : '').(isset($fstr) ? $fstr : '')); ?>
			<input type="submit" value="<?PHP echo esc_attr($fields['button_text']); ?>">
		</form>
		<?php if(isset($fields['footer_note'])){ ?>
			<span class="text"><?php echo $fields['footer_note']; ?></span>
		<?php } ?>
		<a href="#" class="close"><img src="<?PHP echo $this->currentcss; ?>/images/close.png" width="44" height="44" alt=""></a>
	</div>
</div>