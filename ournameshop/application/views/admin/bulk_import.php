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
                    <li><span>Logotypes</span></li>
                    <li class="active"><span>Bulk Import</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Bulk Import
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-sm-12 col-lg-10">
				<div class="hpanel hgreen portlet-item">
			        <div class="panel-heading">
			            <div class="panel-tools">
			                <a class="showhide"><i class="fa fa-chevron-up"></i></a>
			                <a class="closebox"><i class="fa fa-times"></i></a>
			            </div>
			            Path
			        </div>
			        <div class="panel-body">
						<form action="" method="post" class="form-inline margin-top">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">s3://images.ournameshop.com/</div>
                                    <input type="text" name="url" class="form-control" placeholder="cute_critters" required/>
								</div>
                                &nbsp;&nbsp;===>&nbsp;&nbsp;
                                <select name="category_id" class="form-control">
                                    <?php foreach ($this->categories->get_all() as $c): ?>
                                        <option value="<?php echo $c->id; ?>"<?php if ($c->id == $template->category_id) echo ' selected'; ?>>
                                            <?php echo $c->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
							</div>
							<button type="submit" class="btn btn-primary">Import</button>
						</form>
			        </div>
			    </div>
		</div>
	</div>
</div>