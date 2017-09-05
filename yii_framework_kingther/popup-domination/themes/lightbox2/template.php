<div class="popup-dom-lightbox-wrapper" id="<?php echo $lightbox_id?>"<?php echo $delay_hide ?>>
<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?php echo $color ?>">
		<a href="#" class="lightbox-close" id="<?php echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-clear"></div>
		<div class="lightbox-grey-panel">
			<p class="heading"><?php echo $fields['title'] ?></p>
			<div class="bullet-listx">
				<p><?php echo nl2br($fields['short_paragraph']) ?></p>
				<ul class="bullet-list"><?php
					$count = 1;
					if(isset($list_items) && count($list_items) > 0):
						foreach($list_items as $l):
							if($count>3)
								break;?>
					<li><?php echo $l ?></li><?php
							$count++;
						endforeach;
					endif;?>
				</ul>
				<div class="lightbox-clear"></div>
			</div>
		</div>
		<?php if($provider != 'nm' && $provider != 'form'): ?>
		<div class="lightbox-signup-panel">
			<p><?php echo $fields['form_header'] ?></p>
			<div class="wait" style="display:none;"><img src="<?php echo $this->plugin_url.'css/images/wait.gif'; ?>" /></div>
            <div class="form">
                <div>
	                <form id="removeme">
	                    <?php echo $inputs['hidden'].$fstr; ?>
	                    <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>/images/trans.png" class="<?php echo $button_color?>-button" />
						<p class="secure"><img src="<?php echo $theme_url?>/images/lightbox-secure.png" alt="lightbox-secure" width="" height="" /> <?php echo $fields['footer_note'] ?></p>
					</form>
                </div>
            </div>
		</div>
		<?php else: ?>
		<div class="lightbox-signup-panel">
			<p><?php echo $fields['form_header'] ?></p>
            <form method="post" action="<?php echo $form_action ?>"<?php echo $target ?>>
                <div>
                    <?php echo $inputs['hidden'].$fstr; ?>
                    <input type="submit" value="<?php echo $fields['submit_button'] ?>" src="<?php echo $theme_url?>/images/trans.png" class="<?php echo $button_color?>-button" />
					<p class="secure"><img src="<?php echo $theme_url?>/images/lightbox-secure.png" alt="lightbox-secure" width="" height="" /> <?php echo $fields['footer_note'] ?></p>
                </div>
            </form>
		</div>
		<?php endif; ?>
		<div class="lightbox-clear"></div>
			<?php echo $promote_link ?>
	</div>
</div>