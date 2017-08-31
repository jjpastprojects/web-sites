<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>
            <div id="hbreadcrumb" class="pull-right m-t-md">
                <ol class="hbreadcrumb breadcrumb">
                    <li><span>Logotypes</span></li>
                    <li class="active"><span>Pricing Tool</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Pricing Tool
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-lg-5 col-md-8 no-padding">
				<div class="hpanel hgreen portlet-item">
			        <div class="panel-heading">
			            <div class="panel-tools">
			                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
			                <a class="closebox"><i class="fa fa-times"></i></a>
			            </div>
			            Logos Price
			        </div>
			        <div class="panel-body">
						<form action="" method="post" class="form-inline">
							<input type="hidden" name="action" value="pricing" />
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">$</div>
									<input type="text" name="price" class="form-control" />
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Set</button>
						</form>
			        </div>
			    </div>
		    </div>
		</div>

		<div class="col-sm-12">
			<div class="col-lg-5 col-md-8 no-padding">
				<div class="hpanel hgreen portlet-item">
			        <div class="panel-heading">
			            <div class="panel-tools">
			                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
			                <a class="closebox"><i class="fa fa-times"></i></a>
			            </div>
			            Income
			        </div>
			        <div class="panel-body">
						<form action="" method="post" class="form-inline margin-top">
							<input type="hidden" name="action" value="income" />
							<div class="radio margin-bottom-15" style="display: block;">
								<label>
									<input type="radio" name="income_type" value="percentage"<?php if(!empty($options['income_type']) && $options['income_type']->option_value == 'percentage') echo ' checked';?> />
									Percentage
								</label>
									&nbsp;&nbsp;&nbsp;
									<label>
									<input type="radio" name="income_type" value="fixed"<?php if(!empty($options['income_type']) && $options['income_type']->option_value == 'fixed') echo ' checked';?> />
									Fixed
								</label>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon income-type-addon">
										<?php if(!empty($options['income_type']) && $options['income_type']->option_value == 'percentage'):?>
										%
										<?php else:?>
										$
										<?php endif;?>
									</div>
									<input type="text" name="income" class="form-control" value="<?php if(!empty($options['income'])) echo $options['income']->option_value;?>" />
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Save</button>
						</form>
			        </div>
			    </div>
		    </div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('[name=income_type]').on('change', function() {

			if($(this).val() == 'fixed')
			{
				$('.income-type-addon').text('$');
			}
			else
			{
				$('.income-type-addon').text('%')
			}
		});
	});
</script>