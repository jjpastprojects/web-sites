<?PHP list($form_header_1, $form_header_2) = explode(' ', $fields['form_header'], 2); ?>
<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="pop_1 lightbox-main lightbox-color-<?PHP echo $color ?>">
		<div class="pop_1__top">
			<a href="#" class="pop_1__close lightbox-close" id="<?php echo $lightbox_close_id?>"></a>
			<div class="pop_1__top__content">
				<figure>
					<img src="<?PHP echo (empty($fields['left_image']) ? $this->currentcss.'/images/img_1.jpg' : $fields['left_image']); ?>" alt="">
				</figure>
				<section>
					<div class="text_top">
						<span class="text_1"><?PHP echo $fields['title'] ?></span>
						<span class="text_2">
							<span><?PHP echo $form_header_1; ?></span>
							<?PHP echo $form_header_2; ?>
						</span>
					</div>
					<span class="text_3"><i></i><?PHP echo $fields['sub_form_header'] ?></span>
				</section>
				<div class="pop_1__clear"></div>
			</div>
		</div>
		<div class="pop_1__mid">
			<form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
				<div class="pop_1__form__left">
					<div class="pop_1__form__error" style="display:none;">
						<i></i>
						invalid email address
					</div>
					<?PHP echo (isset($inputs['hidden']) ? $inputs['hidden'] : '').(isset($fstr) ? $fstr : ''); ?>
				</div>
				<?PHP
				$css_submit = '';
				$css_right  = '';
				if(isset($fstr)) {
					if(substr_count($fstr, 'type="text" class="') == 1)
						$css_right = 'height:49px;';
					else
						$css_right = 'height:' . strval(substr_count($fstr, 'type="text" class="') * 62)  . 'px;';
				} else {
					$css_right  = 'height:49px;width:100%;';
					$css_submit = 'width:100%;';
				}
				?>
				<div class="pop_1__form__right" style="<?PHP echo $css_right; ?>">
					<input type="submit" value="<?PHP echo esc_attr($fields['submit_button']); ?>" style="<?PHP echo $css_right; ?>" class="button-color-<?php echo $button_color; ?>">
				</div>
				<div class="pop_1__clear"></div>
			</form>
		</div>
		<div class="pop_1__bottom">
			<?PHP echo $fields['footer_note'] ?>
		</div>
	</div>
</div>