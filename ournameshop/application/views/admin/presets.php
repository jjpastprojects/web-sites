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
                    <li class="active"><span>Presets</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Template Presets
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
                    Template Presets
                </div>
                <div class="panel-body collection">
                	<?php if(!$collection):?>
						<div class="alert alert-info">
							No Preset Added Yet
						</div>
					<?php endif;?>
					<div class="row">
						<?php foreach($collection as $item):?>
						<div class="col-xs-12 col-xxs-6 col-sm-6 col-md-4 col-lg-3 col-xlg-2 preset-item">
							<div class="img text-center">
								<a href="<?php echo product_url(
									$item->lastname,
									(object)array('slug' => $item->tpl_slug), 
									(object) array('slug' => $item->surface_slug), 
									(object)array('id' => $item->product_id)
									);?>/custom/<?php echo $item->id;?>">
									<img class="surface img-thumbnail" src="<?php echo product_thumb($item, 'listing');?>" />
									<img src="<?php echo saved_logo_url((object) array('filename' => $item->filename));?>" 
									class="tpl-thumb <?php echo $item->css_class;?>" alt="" />
								</a>
							</div>
							<div class="margin-top-5">
		                        <div class="input-group input-group-sm">
		                            <input class="form-control" value="<?php echo product_url(
																		$item->lastname,
																		(object)array('slug' => $item->tpl_slug), 
																		(object) array('slug' => $item->surface_slug), 
																		(object)array('id' => $item->product_id)
																		);?>/custom/<?php echo $item->id;?>" type="text">
		                            <div class="input-group-btn">
		                                <button class="btn btn-danger" data-delete-id="<?php echo $item->id;?>" title="Delete"><i class="fa fa-trash"></i></button>
		                            </div>
		                        </div>
		                    </div>
						</div>
						<?php endforeach;?>
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

			var lnk = $(this);

			if(!confirm('Delete Preset'))
				return;

			$.post('/admin/presets', {id: lnk.data('delete-id')}, function(data) {
				if(data.success)
				{
					lnk.parents().closest('.item').remove();
				}
				else
				{
					alert('Sorry, something gone wrong');
				}
			}, 'json');

		});

		$('.collection input').focus(function() {
		    var $this = $(this);
		    $this.select();
		    
		    $this.mouseup(function() {
		        $this.unbind("mouseup");
		        return false;
		    });
		});
	});
</script>