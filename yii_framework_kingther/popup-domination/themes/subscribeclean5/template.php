<script>
setInterval(function(){
	jQuery('#pdifr').contents().find('.video-block .video-holder').css('height', jQuery('#popdom_iframe').contents().find('.video-block .detail').height() + 'px');
}, 300);
</script>
<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div style="width: 783px" class="lightbox-main lightbox-color-<?PHP echo $color ?> popup3">
		<div class="video-block">
			<div class="video-holder"> 
				<a href="#" onclick="return false;"><img src="<?PHP if(!empty($fields['image'])) { echo $fields['image']; } else { echo $theme_url.'/images/video.png'; } ?>" alt="img description"></a>
			</div>
			<div class="detail">
				<h2><?PHP echo $fields['title'] ?></h2>
				<p><?PHP echo nl2br($fields['short_paragraph']) ?></p>
			</div>
			<span class="arrow">&nbsp;</span>
		</div>
		<form method="post" action="<?php echo $form_action ?>"<?php echo $target ?> class="email-form">
			<?PHP echo $inputs['hidden'].$fstr; ?>
			<input class="button-color-<?php echo $button_color ?>" type="submit" value="<?PHP echo $fields['submit_button'] ?>">
		</form>
		<span class="text"><?PHP echo $fields['footer_note'] ?></span>
		<a href="#" class="button-color-<?php echo $button_color ?> close lightbox-close" id="<?PHP echo $lightbox_close_id?>">&times;</a>
	</div>
</div>