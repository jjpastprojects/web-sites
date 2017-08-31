
<?php 
	$headlines = array(
		"Family's that pray Together\nStay Together",
		"Family is the wind\nbeneath my wings",
		"Blood makes you related,\nLove makes you family",
		"Home is where the heart is",
		"Family is where life begins\nand love never ends"
	);
?>

<div class="text-designer-popup">	
	<h3>Add Text&hellip;</h3>

	<form class="margin-top text-designer-frm">
		<div class="form-group">
	    	<select class="form-control family-slogan">
	    		<?php foreach($headlines as $h):?>
	    			<option>
	    				<?php echo $h;?>
	    			</option>
	    		<?php endforeach;?>
	    	</select>
	  	</div>
	  	<div class="form-group">
	    	<select class="form-control font-family" name="font_family">
	    		<?php foreach($this->config->item('print_fonts') as $k => $font):?>
	    			<option value="<?php echo $k;?>" data-font-family="<?php echo $font['family'];?>">
	    				<?php echo $font['name'];?>
	    			</option>
	    		<?php endforeach;?>
	    	</select>
	  	</div>
	  	<div class="form-group">
	  		<div class="row">
	  			<div class="col-lg-2">
	  				Color:
	  			</div>
	  			<div class="col-lg-10">
			  		<div class="color-holder">
		              	<?php $k = 0; foreach(array('111', 'FFF', 'CBCBCB', 'FBCE73', 'FE7E12', 'D09377', '85CA19', '07E8A6', '707070', 'D35A01', '09D164', '814E00', '1A74CC', 'A301EA', 'CF1081', '444', '6C3001') as $color_code):?>
		              		<div data-color-code="#<?php echo $color_code;?>" class="color <?php if($k == 0) echo ' active';?>" style="background: #<?php echo $color_code;?>"></div>
		              	<?php $k++; endforeach;?>
		            </div>
		        </div>
		    </div>
	  	</div>
	  	<div class="form-group preview-text">
	  		<div class="input-wrapper">
	  			<!-- <div class="input" contenteditable="true"></div>
	  			<div class="input" contenteditable="true"></div> -->
	  			<input type="text" />
	  			<input type="text" />
	  		</div>
	  	</div>
	  	<div class="text-right">
		  	<a href="#" class="btn btn-default" onclick="$.fancybox.close(); return false;">Cancel</a>
		  	<button type="submit" class="btn btn-success">Done</button>
		</div>
	</form>
</div>

<script src="/js/text_designer.js"></script>
<link rel="stylesheet" type="text/css" href="/css/print_fonts.css" />
