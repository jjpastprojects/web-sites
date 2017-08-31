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
                    <li><span>Categories</span></li>
                    <li class="active">
                        <span><?php if(isset($cat)):?>
                            Edit Category
                        <?php else:?>
                            Add Category
                        <?php endif;?>
                        </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?php if(isset($cat)):?>
                    Edit Category / <?php echo $cat->name; ?>
                <?php else:?>
                    Add Category
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
                    <?php if(isset($cat)):?>
                        Edit Category
                    <?php else:?>
                        Add Category
                    <?php endif;?>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Name:</label>
                            <div class="col-sm-8 col-md-6">
                                <input required type="name" required name="name" class="form-control" value="<?php echo !empty($cat) ? set_value('name', $cat->name) : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Parent:</label>
                            <div class="col-sm-8 col-md-6">
                                <select name="parent_id" class="form-control" <?php if($cat->has_children) echo "disabled";?>>
                                    <option value="0">Root Category</option>
                                    <?php foreach($this->categories->root()->order_by('name', 'asc')->get_all() as $c):?>
                                        <option value="<?php echo $c->id;?>"<?php if(!empty($cat) && $c->id == $cat->parent_id) echo ' selected';?> class="<?php if($c->id==$cat->id) echo "hidden"?>">
                                            <?php echo $c->name;?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Priority:</label>
                            <div class="col-sm-8 col-md-6">
                                <input type="text" required name="weight" class="form-control" value="<?php echo !empty($cat) ? set_value('weight', $cat->weight) : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" value="Save" class="btn btn-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>