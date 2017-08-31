<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h2 class="titlex1">
	    Tell as a little about your campaign
	    </h2>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h5 class="text_des">
	    This helps with getting traffic to your shop 
	    </h5>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<form action="" method="post">

			<?php if($this->session->flashdata('error')):?>
				<div class="alert alert-danger">
					<?php echo $this->session->flashdata('error');?>
				</div>
			<?php endif;?>

			<div class="row">
				<div class="col-sm-12 margin-top-20">
					<div class="form-group">
						<input type="text" class="form-control custom-input" name="name" required value="<?php echo form_prep($campaign->name);?>" placeholder="Campaign Title" />
					</div>

					<div class="form-group">
						<textarea class="form-control custom-textarea" name="description" placeholder="Description"><?php echo form_prep($campaign->description);?></textarea>
					</div>
				</div>
				
				<div class="col-xs-12 col-sm-12">
					<div class="subTxt margin-top-20">
						Campaign Duration
					</div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="margin-top goal-slider">
						<div id="slider"></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12">
					<input type="hidden" name="days" data-days value="1" />
					<div class="text-muted ending-str"></div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="linex1"></div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="subTxt">
						Enter your shop name i.e. Isabella
					</div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<input <?php if($campaign_shop) echo 'disabled';?> type="text" class="form-control custom-input" required value="<?php echo $campaign_shop ? $campaign_shop->domain : '';?>" name="subdomain" data-subdomain placeholder="Subdomain" />
						<span class="help-block hidden">URL already in use</span>
					</div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="subTxt margin-top-20">
						Your shop url
					</div>
				</div>

				<div class="col-xs-12 col-sm-12">
					<p class="link-text">
						<span class="your-url"><?php echo $campaign_shop ? $campaign_shop->domain : '';?></span>.<?php echo $this->input->server('SERVER_NAME');?>/alphonza/xxxxx</b>
					</p>
				</div>

				<div class="col-xs-12 col-sm-12">
					<div class="linex1 margin-top-20"></div>
				</div>

				<div class="col-xs-12 col-sm-12">
		    		<label class="lblCrl">
		      			<input<?php if(bits($campaign->options, CAMPAIGN_OPTION_AUTO_RESTART)) echo ' checked';?> type="checkbox" 
		      			name="options[]" value="<?php echo CAMPAIGN_OPTION_AUTO_RESTART;?>"> Auto restart campaign
		      			<img src="/img/comment_ico.png"/>
		    		</label>
		    		<label class="lblCrl">
		      			<input<?php if(bits($campaign->options, CAMPAIGN_OPTION_PRIVATE)) echo ' checked';?>  type="checkbox" 
		      			name="options[]" value="<?php echo CAMPAIGN_OPTION_PRIVATE;?>"> Make campaign private
		      			<img src="/img/comment_ico.png"/>
		    		</label>
				</div>

				<div class="col-xs-12 col-sm-12">
					<a href="/campaign/create?cid=<?php echo $campaign->id;?>" class="btn btn-prev">
						BACK
					</a>
					<button class="btn btn-next" type="submit">
						NEXT
					</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-sm-6 campaign-preview-product">
		<img src="<?php echo $variant->image;?>" class="surface img-thumbnail" />
		<img src="<?php echo saved_logo_url((object) array('filename' => $saved_logo->filename));?>" 
			class="tpl-thumb" alt="" />
	</div>
</div>

<script src="/js/moment.min.js"></script>

<script>
	$(function() {
		$('[data-subdomain]').on('change', function() {
			var input = $(this);
			
			input.parent().removeClass('has-error');
			input.next().addClass('hidden');

			$.getJSON('/campaign/check_subdomain', {subdomain: input.val()}, function(data) {
				if(data.valid == false)
				{
					input.parent().addClass('has-error');
					input.next().removeClass('hidden');
					$('button:submit').prop('disabled', true);
				}
				else
				{
					$('button:submit').prop('disabled', false);
				}
			});
		});

		$('[data-subdomain]').on('keyup', function(e) {
			$('.your-url').text($(this).val());
		});

		var days = [1, 4, 25];

		$('#slider').slider({
		    value: 0,
		    min: 0,
		    max: 2,
		    step: 1,
		    slide: function( event, ui ) {
		    	var days_num = days[ui.value];

		    	$('.ending-str').html(
		    		date_str(days_num)	
	    		);
		    	
		    	$('[data-days]').val(days_num);
		    },

		    change: function( event, ui ) {
		    	var days_num = days[ui.value];

		    	$('.ending-str').html(
		    		date_str(days_num)	
	    		);
		    	
		    	$('[data-days]').val(days_num);
		    },
		})
		.each(function() {
		    var opt = $(this).data().uiSlider.options;
			var vals = opt.max - opt.min;

		    for (var i = 0; i <= vals; i++) {
		        var el = $('<label>' + (days[i]) + '</label>').css('left', (i/vals*100) + '%');

		        $(this).append(el);
		    }
		});

		function date_str(days_num)
		{
			return '<b>' + days_num + ' day' + (days_num > 1 ? 's' : '') + '</b> - Ending ' 
			+ moment().add(days_num, 'days').format('dddd, MMMM D');
		}

		<?php if($campaign->days):?>
			$('#slider').slider('value', days.indexOf(<?php echo $campaign->days;?>));
		<?php else:?>
			$('#slider').slider('value', 0);
		<?php endif;?>
	});
</script>
