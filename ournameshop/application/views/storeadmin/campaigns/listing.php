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
                    <li class="active"><span>Campaigns</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Campaigns
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
                    Campaigns
                </div>
                <div class="panel-body table-responsive">
                	<?php if($campaigns):?>
	                    <table class="table table-hover table-striped">
	                    	<thead>
								<tr>
									<th width="40">#</th>
									<th>Name</th>
									<th>Description</th>
									<th>Days</th>
									<th>Status</th>
									<th>Goal / Sales</th>
									<th>Created</th>
									<th>Till</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($campaigns as $campaign):?>
								<tr>
									<td>
										<?php echo $campaign->id;?>
									</td>
									<td>
										<a href="<?php echo product_url(
											$campaign->lastname, 
											(object)array('slug' => $campaign->tpl_slug),
											(object)array('slug' => $campaign->surface_slug),
											(object)array('id' => $campaign->product_id)
										);?>">
											<?php echo $campaign->name;?>
										</a>
									</td>
									<td>
										<?php echo $campaign->description;?>
									</td>
									<td>
										<?php echo $campaign->days;?>
									</td>
									<td>
										<?php if(bits($campaign->options, CAMPAIGN_OPTION_ACTIVE)):?>
											<span class="label label-success">active</span>
										<?php else:?>
											<span class="label label-default">not active</span>
										<?php endif;?>
									</td>
									<td>
										<?php echo $campaign->goal;?> / <?php echo $campaign->num_sales;?>
									</td>
									<td>
										<?php echo format_date($campaign->create_ts, 'Y/m/d');?>
									</td>
									<td>
										<?php if(bits($campaign->options, CAMPAIGN_OPTION_ACTIVE) && $campaign->till_ts):?>
											<?php echo format_date($campaign->till_ts, 'Y/m/d');?>
										<?php else:?>
											-
										<?php endif;?>
									</td>
									<td>
										<?php if(!bits($campaign->options, CAMPAIGN_OPTION_ACTIVE)):?>
										<a href="#" title="Activate" data-activate-id="<?php echo $campaign->id;?>" class="btn btn-action btn-success">
											<i class="fa fa-check"></i>
										</a>
										<?php endif;?>
										<a href="/<?php echo STORE_ADMIN_URL_PREFIX;?>/campaigns/edit/<?php echo $campaign->id;?>" title="Edit" class="btn btn-action btn-info">
											<i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>

						<div class="col-sm-12 text-center">
		                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
	                	</div>
                	<?php else:?>
                		<div class="alert alert-info">
                            No Campaigns
                        </div>
                	<?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$(function() {
		$('[data-activate-id]').on('click', function(e) {
			e.preventDefault();
			var lnk = $(this);

			if(!confirm('Activate Campaign?'))
				return;

			$.post('/<?php echo STORE_ADMIN_URL_PREFIX;?>/campaigns/activate', {id: lnk.data('activate-id')}, function(data) {
				if(data.success)
				{
					location.reload();
				}	
				else
				{
					alert(data.msg);
				}
			}, 'json');
		});
	});
</script>




