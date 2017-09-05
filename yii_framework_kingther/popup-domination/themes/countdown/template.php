<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div style="width: 875px" class="popup4 lightbox-main lightbox-color-<?PHP echo $color ?> button-color-<?PHP echo $color ?>">
		<h2><?PHP echo $fields['title']; ?></h2>
		<div class="holder">
			<div class="video-block">
				<span class="limit"><?PHP echo $fields['description_title']; ?></span>
                                <img src="<?PHP if(empty($fields['image_left'])) { echo $this->currentcss.'/images/video1.png'; } else { echo $fields['image_left']; } ?>" alt="img description">
			</div>
			<div class="right-block">
				<div class="time-block">
					<div class="block" id="block_days" style="display:none;">
						<strong id="countdown_days">  </strong>
						<span>DAYS</span>
					</div>				
					<div class="block">
						<strong id="countdown_hrs">  </strong>
						<span>HRS</span>
					</div>
					<div class="block">
						<strong id="countdown_mins">  </strong>
						<span>MINS</span>
					</div>
					<div class="block">
						<strong class="sec" id="countdown_secs">  </strong>
						<span>SECS</span>
					</div>
				</div>
				<a href="<?PHP echo $fields['button_url']; ?>" class="btn-win"><?PHP echo $fields['button_text']; ?></a>
				<span class="text"><?PHP echo $fields['footer_note']; ?></span>
			</div>
			<span class="arrow">&nbsp;</span>
		</div>
		<div class="base">
			<div class="base-holder">
				<?PHP if(!empty($fields['as_seen_image_1']) && !empty($fields['as_seen_image_2']) && !empty($fields['as_seen_image_3'])) { ?>
				<span class="title">USED BY</span>
				<ul class="logos">
					<?PHP if(!empty($fields['as_seen_image_2'])) { ?><li><img src="<?PHP echo $fields['as_seen_image_2']; ?>" alt="img description"></li><?PHP } ?>
					<?PHP if(!empty($fields['as_seen_image_1'])) { ?><li><img src="<?PHP echo $fields['as_seen_image_1']; ?>" alt="img description"></li><?PHP } ?>
					<?PHP if(!empty($fields['as_seen_image_3'])) { ?><li><img src="<?PHP echo $fields['as_seen_image_3']; ?>" alt="img description"></li><?PHP } ?>
				</ul>
				<?PHP } ?>
			</div>
		</div>
		<a href="#" class="close"><img src="<?PHP echo $this->currentcss; ?>/images/close2.png" width="12" height="12" alt="img description"></a>
	</div>	
</div>
<script>
var today = new Date();
var target_date = new Date(<?PHP if(!empty($fields['countdown_date']) && strtotime($fields['countdown_date']) != 0) { echo strtotime($fields['countdown_date']) * 1000; } else { echo 'today.getTime() + (13 * 60 * 60 * 1000) - (23 * 43 * 1000)'; } ?>);
var days, hours, minutes, seconds;
 
setInterval(function () {
    var current_date = new Date().getTime();
    var seconds_left = (target_date - current_date) / 1000;
 
    // do some time calculations
    days = parseInt(seconds_left / 86400);
    seconds_left = seconds_left % 86400;
     
    hours = parseInt(seconds_left / 3600);
    seconds_left = seconds_left % 3600;
     
    minutes = parseInt(seconds_left / 60);
    seconds = parseInt(seconds_left % 60);
	
	var iframe = document.getElementById('pdifr');
	if(typeof iframe !== 'undefined')
		var innerDoc = (iframe.contentDocument) ? iframe.contentDocument : iframe.contentWindow.document;
	else
		var innerDoc = document;
	
	if(days > 0) {
		innerDoc.getElementById('block_days').style.display = 'inline-block';
		innerDoc.getElementById('countdown_days').innerHTML = days;
	}
	
	innerDoc.getElementById('countdown_hrs').innerHTML  = hours;
	innerDoc.getElementById('countdown_mins').innerHTML = minutes;
	innerDoc.getElementById('countdown_secs').innerHTML = seconds;
}, 1000);
</script>