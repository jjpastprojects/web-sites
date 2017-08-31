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
                    <li class="active"><span>Categories</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Categories <a href="/admin/add_category" class="btn btn-success">Add</a>
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
                	Categories
	            </div>
	            <div class="panel-body table-responsive">
					<table class="margin-top table table-hover table-striped" id="folder-table">
						<thead>
							<tr>
								<th width="40">#</th>
								<th>Name</th>
								<th>Priority</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($categories as $l):?>
								<tr>
									<td>
										<?php echo $l->id;?>
									</td>
									<td>
										<h5>
											<?php echo $l->name;?>
										</h5>
									</td>
									<td>
										<?php echo $l->weight;?>
									</td>
									<td>
										<a href="/admin/category/<?php echo $l->id;?>" title="Edit" class="btn btn-action btn-info">
											<i class="fa fa-edit"></i>
										</a>
										<a data-delete-id="<?php echo $l->id;?>" href="#" title="Delete" class="btn btn-action btn-danger">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php foreach($l->children as $child):?>
									<tr>
										<td>
											<?php echo $child->id;?>
										</td>
										<td>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<?php echo $child->name;?>
										</td>
										<td>
										<?php echo $child->weight;?>
										</td>
										<td>
											<a href="/admin/category/<?php echo $child->id;?>" title="Edit" class="btn btn-action btn-info">
												<i class="fa fa-edit"></i>
											</a>
											<a data-delete-id="<?php echo $child->id;?>" href="#" title="Delete" class="btn btn-action btn-danger">
												<i class="fa fa-trash"></i>
											</a>
										</td>
								<?php endforeach;?>
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
		$('[data-delete-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Delete Category?'))
				return;

			$.post('/admin/categories', {id: $(this).data('delete-id')}, function(data) {
				if(data.success)
				{
					location.reload();
				}
			}, 'json')
		})
	});
</script>