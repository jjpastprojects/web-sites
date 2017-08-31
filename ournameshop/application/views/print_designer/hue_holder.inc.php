<div class="hue-holer">
	<div class="hue-chooser<?php if($template->monochromic) echo ' hidden';?>">
		<div class="row">
			<div class="col-sm-9">
				<div class="clearfix hue-rainbow-holder"></div>
				<input class="hue-slider" type="range" min="-50" max="50" value="0" name="filter_color"
    			data-filter="<?php echo $template->monochromic ? 'Tint' : 'Multiply';?>" />
			</div>
		</div>

		<a href="#" class="text-muted reset-customizer">
			<small>
				<span class="glyphicon glyphicon-repeat"></span> Refresh
			</small>
		</a>
	</div>

 	<?php if($template->monochromic):?>

		<div class="color-chooser<?php if(!$template->monochromic) echo ' hidden';?>">
			<input type='text' class="spectrum-color" />
		</div>
	<?php endif;?>
</div>
