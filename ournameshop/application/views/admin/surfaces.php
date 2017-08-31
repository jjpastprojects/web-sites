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
                    <li class="active"><span>Product Types</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Product Types
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
                	Product Types
	            </div>
	            <div class="panel-body table-responsive">
					<table class="margin-top table table-hover table-striped">
						<thead>
							<tr>
								<th width="40">#</th>
								<th>Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($surfaces as $l):?>
							<tr>
								<td>
									<?php echo $l->id;?>
								</td>
								<td>
									<?php echo $l->name;?>
								</td>
								<td>
									<a href="/admin/surface/<?php echo $l->id;?>" title="Edit" class="btn btn-action btn-info">
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
	            </div>
	        </div>
		</div>
	</div>
</div>