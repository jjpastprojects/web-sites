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
                    <li class="active"><span>Edit Product Type</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Edit Product Type
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Edit Product Type / <?php echo $surface->name; ?>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-inline">
                        <input type="hidden" name="action" value="pricing" />
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Name</div>
                                <input required type="name" required name="name" class="form-control" value="<?php echo set_value('name', $surface->name);?>" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>