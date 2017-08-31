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
                	<li><span>Campaigns</span></li>
                    <li class="active"><span>Edit</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Edit Campaign
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-sm-12">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Edit Campaign / <?php echo $campaign->name; ?>
                </div>
                <div class="panel-body">
                    <div class="col-md-8 col-sm-7">
                    	<form action="" method="post">
							<div class="form-group">
								<label>Title</label>
								<input type="text" class="form-control" name="name" required value="<?php echo form_prep($campaign->name);?>" />
							</div>

							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" name="description" rows="4"><?php echo form_prep($campaign->description);?></textarea>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label>Goal</label>
										<input type="number" class="form-control" required name="goal" value="<?php echo form_prep($campaign->goal);?>" />
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group">
										<label>Profit per item</label>
										<input type="text" class="form-control" name="profit" value="<?php echo form_prep($campaign->profit);?>" />
									</div>
								</div>

								<div class="col-sm-4">
									<div class="form-group">
										<label>Days</label>
										<input type="number" class="form-control" required name="days" value="<?php echo form_prep($campaign->days);?>" />
									</div>
								</div>
							</div>
							<div class="checkbox">
					    		<label class="no-padding">
					      			<input<?php if(bits($campaign->options, CAMPAIGN_OPTION_AUTO_RESTART)) echo ' checked';?> type="checkbox" 
					      			name="options[]" class="i-checks" value="<?php echo CAMPAIGN_OPTION_AUTO_RESTART;?>"> Auto restart campaign
					    		</label>
					  		</div>

					  		<div class="checkbox">
					    		<label class="no-padding">
					      			<input<?php if(bits($campaign->options, CAMPAIGN_OPTION_PRIVATE)) echo ' checked';?>  type="checkbox" 
					      			name="options[]" class="i-checks" value="<?php echo CAMPAIGN_OPTION_PRIVATE;?>"> Make campaign private
					    		</label>
					  		</div>

					  		<div class="checkbox">
					    		<label class="no-padding">
					      			<input<?php if(bits($campaign->options, CAMPAIGN_OPTION_ACTIVE)) echo ' checked';?>  type="checkbox" 
					      			name="options[]" class="i-checks" value="<?php echo CAMPAIGN_OPTION_ACTIVE;?>"> Active
					    		</label>
					  		</div>

							<button type="submit" class="btn btn-primary">Save</button>
						</form>
                    </div>
                    <div class="col-md-4 col-sm-5 campaign-preview-product margin-top-15">
						<img src="<?php echo $variant->image;?>" class="surface img-thumbnail" />
						<img src="<?php echo saved_logo_url((object) array('filename' => $saved_logo->filename));?>" 
				  		class="tpl-thumb" alt="" />
					</div>
                </div>
            </div>
        </div>
    </div>
</div>