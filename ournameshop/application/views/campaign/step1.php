<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h2 class="titlex1">
	    Set a Goal
	    </h2>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    <h5 class="text_des">
	    How many units are you aiming to sell?
	    </h5>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<form action="" method="post">
			<input type="hidden" name="variant_id" value="<?php echo $variant->id;?>" />
			<input type="hidden" name="template_id" value="<?php echo $template->id;?>" />
			<input type="hidden" name="lastname_id" value="<?php echo $lastname->id;?>" />

			<div class="row">
				<div class="col-sm-12">
					<div class="goal-slider">
						<div id="slider"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group" style="margin-top: 35px;">
						<div class="input-group">
					      	<div class="input-group-addon"># of units</div>
					      	<input data-goal type="text" name="goal" value="" class="form-control text-center e-form-control" />
					    </div>
					</div>
				</div>
				<div class="col-sm-12 text-muted hidden">
					<small>
						Your goal is the number of units you're aiming to sell, but we'll print
						your campaign as long as you sell enought to generate a profit.
					</small>
				</div>
				<div class="col-sm-12 col-xs-12">
					<div class="eti1">Your estimated profit:</div>
					<div class="eti2" data-profit></div>
				</div>

				<div class="col-sm-12 col-xs-12">
					<div class="linex1"></div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<div class="addx1">
						Add extra profit per unit:
					</div>
					<div class="e-form-group2">
			            <div class="e-input-group2">
			                <div class="e-input-group-addon2">$</div>
			                <input class="e-form-control2" type="text" name="profit" data-profit-per-unit value="<?php echo $campaign ? form_prep($campaign->profit) : '0';?>">
			            </div>
			        </div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<div class="linex1"></div>
				</div>

				<div class="col-sm-12 col-xs-12">
					<button class="btn btn-info btn-block btn-main" type="submit">
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

<script>
	$(function() {
		var goals 				= [1, 4, 10, 20, 50, 150, 300, 500];
		var profit_by_one 		= <?php echo round(percent($variant->profit, AFF_PROFIT_PERCENT), 2);?>;

		$('#slider').slider({
		    value: 0,
		    min: 0,
		    max: 7,
		    step: 1,
		    
		    slide: 	on_slide,
		    change: on_slide
		})
		.each(function() {
		    var opt = $(this).data().uiSlider.options;
			var vals = opt.max - opt.min;

		    for (var i = 0; i <= vals; i++) {
		        var el = $('<label>' + (goals[i]) + '</label>').css('left', (i/vals*100) + '%');

		        $(this).append(el);
		    }

		});

		$('[data-profit-per-unit]').on('keyup', function(e) {
			$('#slider').slider('value', $('#slider').slider('value'));
		});

		function on_slide(e, ui)
		{
			var goal = goals[ui.value];
			
			var est_profit = round(
				profit_by_one + ($('[data-profit-per-unit]').val() ? parseFloat($('[data-profit-per-unit]').val()) : 0), 2
			);

			$('[data-goal]').val(goal);
			$('[data-profit]').text('$' + round(goal * est_profit, 2));
		}

		<?php if($campaign):?>
			$('#slider').slider('value', goals.indexOf(<?php echo $campaign->goal;?>));
		<?php else:?>
			$('#slider').slider('value', 0);
		<?php endif;?>
	});
</script>