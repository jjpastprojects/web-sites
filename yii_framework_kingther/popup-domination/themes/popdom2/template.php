<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="pop_2 lightbox-main lightbox-color-<?PHP echo $color ?>">
		<div class="pop_2__top">
			<a href="#" class="pop_2__close lightbox-close" id="<?php echo $lightbox_close_id?>"></a>
			<span class="title_1">
				<?PHP echo $fields['title'] ?>
			</span>
			<span class="title_2">
				<i></i>
				<?PHP echo $fields['sub_text'] ?>
			</span>
			<form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
				<section>
					<div class="error" style="display:none;">
						<i></i>
						invalid email address
					</div>
					<?PHP echo (isset($inputs['hidden']) ? $inputs['hidden'] : '').(isset($fstr) ? $fstr : ''); ?>
				</section>
				<input type="submit" value="<?PHP echo esc_attr($fields['submit_button']); ?>" class="button-color-<?php echo $button_color; ?>">
			</form>
		</div>
		<div class="pop_2__bottom">
			<figure></figure>
			<span><?PHP echo $fields['footer_note'] ?></span>
		</div>
	</div>
</div>