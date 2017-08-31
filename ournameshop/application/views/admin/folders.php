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
                	<li><span>Logo Types</span></li>
                    <li class="active"><span>Folders</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Logo Types <a href="/admin/add_logo_type" class="btn btn-success">Add</a>
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
                	Logo Types
	            </div>
	            <div class="panel-body table-responsive">
					<table class="margin-top table table-hover table-striped" id="folder-table">
						<thead>
							<tr>
								<th width="40">#</th>
								<th>Name</th>
								<th>Category</th>
								<th>Price</th>
								<th>Dir</th>
								<th>Num Templates</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($folders as $l):?>
							<tr>
								<td>
									<?php echo $l->id;?>
								</td>
								<td>
									<?php echo $l->name;?>
									<?php if(!$l->enabled):?>
										<span class="label label-default">Disabled</span>
									<?php endif;?>

									<?php if($l->featured):?>
										<span class="label label-warning">Featured</span>
									<?php endif;?>
								</td>
								<td>
									<?php foreach($l->cats as $k => $c):?>
										<?php echo $c->name;?><?php if($k != sizeof($l->cats) - 1) echo ', ';?>
									<?php endforeach;?>
								</td>
								<td>
									<?php echo format_price($l->price);?>
								</td>
								<td>
									/<?php echo $l->dir;?>
								</td>
								<td>
									<?php echo $l->tpl_cnt;?>
								</td>
								<td>
									<a href="/admin/logo_type/<?php echo $l->id;?>" title="Edit" class="btn btn-action btn-info">
										<i class="fa fa-edit"></i>
									</a>
									<a data-delete-id="<?php echo $l->id;?>" href="/admin/logo_type/<?php echo $l->id;?>" title="Delete" class="btn btn-action btn-danger">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
	                <!-- <div class="col-sm-12 text-center">
	                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
                	</div> -->
	            </div>
	        </div>
		</div>
	</div>
</div>

<script>
	$(function() {
		$('[data-delete-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Delete Logo Type?'))
				return;

			$.post('/admin/logo_types', {id: $(this).data('delete-id')}, function(data) {
				if(data.success)
				{
					location.reload();
				}
			}, 'json')
		});

		$('#folder-table').dataTable({
			ordering:  false
		});
	});
</script>