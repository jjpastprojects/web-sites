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
                    <li><span>Lastnames</span></li>
                    <li class="active"><span>Lastname Requests</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Lastname Requests
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
                	Lastname Requests
	            </div>
	            <div class="panel-body table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th width="40">#</th>
								<th>Last Name</th>
								<th>From</th>
								<th>Date</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($requests as $l):?>
							<tr>
								<td>
									<?php echo $l->id;?>
								</td>
								<td>
									<h5>
										<?php echo $l->lastname;?>
									</h5>
								</td>
								<td>
									<?php echo sprintf('%s %s', $l->firstname, $l->lastname);?><br />
									<?php echo $l->email;?>
								</td>
								<td>
									<?php echo format_date($l->create_ts);?>
								</td>
								<td>
									<?php if($l->status == LNAME_REQ_STATUS_PENDING):?>
										<span class="label bg-dark">pending</span>
									<?php elseif($l->status == LNAME_REQ_STATUS_ACCEPTED):?>
										<span class="label bg-success">accepted</span>
									<?php elseif($l->status == LNAME_REQ_STATUS_REJECTED):?>
										<span class="label bg-danger">rejected</span>
									<?php endif;?>
								</td>
								<td>
									<?php if($l->status == LNAME_REQ_STATUS_PENDING):?>
										<a href="#" data-id="<?php echo $l->id;?>" data-status="<?php echo	LNAME_REQ_STATUS_ACCEPTED;?>" class="btn btn-sm btn-success">
											Accept
										</a>

										<a href="#" data-id="<?php echo $l->id;?>" data-status="<?php echo	LNAME_REQ_STATUS_REJECTED;?>" class="btn btn-sm btn-danger">
											Reject
										</a>
									<?php endif;?>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
	                <div class="col-sm-12 text-center">
	                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
                	</div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('[data-status]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Change status of request?'))
				return;

			var lnk = $(this);

			$.post('/admin/lastname_requests', {
				id: lnk.data('id'), status: lnk.data('status')
			}, function(data) {
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