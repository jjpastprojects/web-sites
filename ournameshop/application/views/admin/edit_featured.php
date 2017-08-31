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
                    <li class="active">
                        <span><?php if(isset($featured)):?>
                            Edit Featured
                        <?php else:?>
                            Add Featured
                        <?php endif;?></span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?php if(isset($featured)):?>
                    Edit Featured
                <?php else:?>
                    Add Featured
                <?php endif;?>
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
                    <?php if(isset($featured)):?>
                        Edit Featured
                    <?php else:?>
                        Add Featured
                    <?php endif;?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 col-lg-7">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Name:</label>
                                    <div class="col-md-8">
                                        <input required type="text" name="name" class="form-control" 
                                        value="<?php echo !empty($featured) ? form_prep($featured->name) : '';?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Link:</label>
                                    <div class="col-md-8">
                                        <input required type="text" name="link" class="form-control" 
                                        value="<?php echo !empty($featured) ? form_prep($featured->link) : '';?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-5 col-sm-8">
                                        <label>Choose Image</label>
                                        <input type="file" name="file" />
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <?php if(isset($featured) && $featured->img):?>
                                            <img class="img-thumbnail" src="<?php echo featured_img($featured->img);?>" style="height: 180px;" />
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-5 col-sm-8">
                                        <input type="submit" value="Save" class="btn btn-primary margin-top" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>