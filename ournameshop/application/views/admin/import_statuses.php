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
                    <li class="active"><span>Import Jobs</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Import Jobs
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel hgreen">
	            <div class="panel-heading">
	                <div class="panel-tools">
	                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
	                    <a class="closebox"><i class="fa fa-times"></i></a>
	                </div>
                	Import Jobs
	            </div>
	            <div class="panel-body table-responsive">
					<table class="table table-hover table-striped">
						<?php if(!$jobs):?>
							<tr>
								<td colspan="6" align="center">
									no jobs			
								</td>
							</tr>
						<?php endif;?>
						<thead>
							<tr>
								<th>#</th>
								<th>Folder</th>
								<th>Job Start</th>
								<th>Job End</th>
								<th>Status</th>
								<th>Num Inserted</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($jobs as $job):?>
							<tr>
								<td><?php echo $job->id;?></td>
								<td>
									<a href="/admin/logo_type/<?php echo $job->folder_id;?>">
										<?php echo $job->folder;?>
									</a>
								</td>
								<td><?php echo format_date($job->create_ts, 'Y/m/d h:i A');?></td>
								<td><?php echo format_date($job->done_ts, 'Y/m/d h:i A');?></td>
								<td><?php echo $job->status;?></td>
								<td><?php echo $job->num_inserted;?></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
	            </div>
	        </div>
		</div>
	</div>
</div>