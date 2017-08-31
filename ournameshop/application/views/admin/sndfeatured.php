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
                	<li><span>Products</span></li>
                    <li class="active"><span>2nd Featured</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                2nd Featured <a href="/admin/add_sndfeatured" class="btn btn-success">Add</a>
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
                	2nd Featured
	            </div>
	            <div class="panel-body table-responsive">
					<table class="margin-top table table-hover table-striped" id="folder-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Link</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($featured as $f):?>
							<tr>
								<td>
									<?php echo $f->name;?>
								</td>
								<td>
									<a href="<?php echo $f->link;?>">
										<?php echo $f->link;?>
									</a>
								</td>
								<td>
									<img src="<?php echo sndfeatured_img($f->img);?>" style="height: 100px;" />
								</td>
								<td>
									<a href="/admin/edit_sndfeatured/<?php echo $f->id;?>" title="Edit" class="btn btn-action btn-info">
										<i class="fa fa-edit"></i>
									</a>
									<a href="#" data-delete-id="<?php echo $f->id;?>" title="Delete" class="btn btn-action btn-danger">
										<i class="fa fa-trash"></i>
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

<script>
	$(function() {
		$('[data-delete-id]').on('click', function(e) {
			e.preventDefault();

			if(!confirm('Delete 2nd Featured?'))
				return;

			$.post('/admin/sndfeatured', {id: $(this).data('delete-id')}, function(data) {
				if(data.success)
				{
					location.reload();
				}
			}, 'json')
		})
	});
</script>