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
                    <li class="active"><span>List</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Products
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
                    Products
                </div>
                <div class="panel-body table-responsive">
                    <form action="/admin/products" method="get" class="form-inline">
						<div class="form-group">
					        <input name="search" placeholder="search products" type="text" class="form-control" value="<?php echo form_prep($this->input->get('search'));?>" />
					    </div>&nbsp;&nbsp;
					    <div class="checkbox">
						    <label>
						      <input type="checkbox" class="i-checks" name="without_liting_thumb" value="1"<?php if($this->input->get('without_liting_thumb')) echo ' checked';?>> W/o listing thumb
						    </label>
						</div>&nbsp;&nbsp;
						<div class="checkbox">
						    <label>
						      <input type="checkbox" class="i-checks" name="without_preview_thumb" value="1"<?php if($this->input->get('without_preview_thumb')) echo ' checked';?>> W/o preview thumb
						    </label>
						</div>&nbsp;&nbsp;
						<div class="checkbox">
						    <label>
						      <input type="checkbox" class="i-checks" name="disabled" value="1"<?php if($this->input->get('disabled')) echo ' checked';?>> Disabled
						    </label>
						</div>&nbsp;&nbsp;
					    <button type="submit" class="btn btn-info">Search</button>
					</form>

					<table class="margin-top-15 table table-hover table-striped">
						<thead>
							<tr>
								<th width="40">#</th>
								<th></th>
								<th></th>
								<th data-sort-field="model">Name</th>
								<th data-sort-field="price">Price</th>
								<th>Type</th>
								<th data-sort-field="num_views">Views</th>
								<th data-sort-field="num_sales">Sales</th>
								<th data-sort-field="import_date">Imported</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if($products):?>
								<?php foreach($products as $l):?>
								<tr>
									<td>
										<?php echo $l->id;?>
									</td>
									<td>
										<a href="javascript:;" data-toggle="popover" data-html="true" data-trigger="hover" data-content="<div class='relative listing-image'><img style='width: 287px;' class='surface bordered' src='<?php echo product_thumb($l, 'listing');?>' /><div class='logo-preview'></div></div>">
											<img class="bordered<?php if(!$l->listing_thumb) echo ' border-red';?>" style="width: 50px;" src="<?php echo product_thumb($l, 'listing');?>" />
										</a>
									</td>
									<td>
										<a href="javascript:;" data-toggle="popover" data-html="true" data-trigger="hover" data-content="<img class='bordered' width='200' src='<?php echo product_thumb($l, 'product');?>' />">
											<img class="bordered<?php if(!$l->preview_thumb) echo ' border-red';?>" style="width: 50px;" src="<?php echo product_thumb($l, 'product');?>" />
										</a>
									</td>
									<td>
										<?php if(!$l->enabled):?>
											<span class="label label-default">disabled</span>
										<?php endif;?>

										<?php echo $l->model;?>
									</td>
									<td>
										<?php echo format_price($l->price);?>
									</td>
									<td>
										<?php echo humanize($l->type);?>
									</td>
									<td>
										<?php echo $l->num_views;?>
									</td>
									<td>
										<?php echo $l->num_sales;?>
									</td>
									<td>
										<?php echo format_date($l->import_date);?>
									</td>
									<td>
										<a href="/admin/product/<?php echo $l->id;?>" title="Edit" class="btn btn-action btn-info">
											<i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
								<?php endforeach;?>
							<?php else:?>
							<tr>
								<td colspan="10">
									<div class="alert alert-info">Nothing found</div>
								</td>
							</tr>
						<?php endif;?>
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
		<?php if($this->input->get('search')):?>
           $('table tr td').highlight('<?php echo $this->input->get('search');?>', 'highlight');
        <?php endif;?>

        $('table').thsort({
            current_sort_field : '<?php echo $order_field;?>',
            current_sort_order : '<?php echo $order_dir;?>',
            qs                 : '<?php echo preg_replace('/&?sort=\w+&order=\w+/', '', $_SERVER['QUERY_STRING']);?>',
            current_url        : '<?php echo current_url();?>' 
        });
	});
</script>