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
                    <li><span>Folders</span></li>
                    <li class="active">
                        <span><?php if(!empty($cat)):?>
                                    Edit logo type
                                <?php else:?>
                                    Add logo type
                                <?php endif;?>
                        </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?php if(!empty($cat)):?>
                    Edit logo type / <?php echo $cat->name; ?>
                <?php else:?>
                    Add logo type
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
                    Logo type Details
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
                            <label class="control-label col-sm-2">Price:</label>
                            <div class="col-sm-8 col-md-6">
                                <input required type="name" required name="price" class="form-control" value="<?php echo !empty($cat) ? set_value('price', $cat->price) : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Directory:</label>
                            <div class="col-sm-8 col-md-6">
                                <input required type="dir" required name="folder" class="form-control" value="<?php echo !empty($cat) ? set_value('dir', $cat->dir) : '';?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Category:</label>
                            <div class="col-sm-8 col-md-6 c-holder">
                                <?php if(isset($cat)):?>
                                    <?php foreach($cat->cats as $k => $folder_cat):?>
                                        <div class="margin-top-5">
                                            <select name="category[]" class="form-control">
                                                <option value="">Choose Category</option>
                                                <?php foreach($this->categories->get_all() as $c):?>
                                                    <option value="<?php echo $c->id;?>"<?php if($c->id == $folder_cat->id) echo ' selected';?>>
                                                        <?php echo $c->name;?>
                                                    </option>
                                                <?php endforeach;?>
                                            </select> 
                                            
                                            <?php if(!$k):?>
                                                <a href="#" title="Add" class="btn btn-action btn-success" add-more-cat>
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            <?php else:?>
                                                <a href="#" title="Remove" class="btn btn-action btn-danger remove-cat">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            <?php endif;?>
                                        </div>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <select name="category[]" class="form-control">
                                        <option value="">Choose Category</option>
                                        <?php foreach($this->categories->get_all() as $c):?>
                                            <option value="<?php echo $c->id;?>">
                                                <?php echo $c->name;?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                    <a href="#" title="Add" class="btn btn-action btn-success" add-more-cat>
                                        <i class="fa fa-plus"></i>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Enabled:</label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="i-checks" name="enabled" value="1" <?php if(isset($cat) && $cat->enabled) echo ' checked';?> />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Featured:</label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="i-checks" name="featured" value="1" <?php if(isset($cat) && $cat->featured) echo ' checked';?> />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-2">
                                <input type="submit" value="Save" class="btn btn-primary" />
                                <?php if(!empty($cat)):?>
                                    <a href="/admin/import_logo_types/<?php echo $cat->id;?>" class="btn btn-warning import-btn">
                                        Import Logotypes
                                    </a>

                                    <small>In our db, we have <?php echo $num_templates;?> logotypes from this folder</small>
                                <?php endif;?>
                            </div>
                        </div>
                    </form>

                    <div class="hidden import-details">
                        <h4>Importing details</h4>
                        <p>
                            Status:
                            <span class="status">running</span>
                        </p>
                        <p>
                            Num Inserted:
                            <span class="num-inserted">3289</span>
                        </p>
                        <p>
                            <a href="#" class="btn btn-sm btn-warning refresh-btn">
                                refresh
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        <?php if(isset($cat)):?>

            var job_id = false;

            $('.refresh-btn').on('click', function(e) {
                e.preventDefault();
                
                if(!job_id)
                {
                    alert('Job not found');
                    return;
                }

                $.getJSON('/admin/import_job_details', {id: job_id}, function(data) {
                    var holder = $('.import-details');
                        
                    holder.find('.status').text(data.job.status);
                    holder.find('.num-inserted').text(data.job.num_inserted);
                });
            });

            $('.import-btn').on('click', function(e) {
                e.preventDefault();
                var lnk = $(this);

                if(!confirm('Import Logotypes from this folder?'))
                    return false;

                $.post(lnk.prop('href'), {id: <?php echo $cat->id;?>}, function(data) {
                    if(data.success)
                    {
                        job_id = data.job_id
                        lnk.remove();

                        var holder = $('.import-details');
                        
                        holder.find('.status').text(data.status);
                        holder.find('.num-inserted').text('-');

                        holder.removeClass('hidden');
                    }
                    else
                    {
                        alert('Server Error');
                    }
                }, 'json');
            });
        <?php endif;?>

        $('[add-more-cat]').on('click', function(e) {
            e.preventDefault();

            var sel = $('.c-holder select:first').clone();
        //    sel.val('');
            sel.find('option:selected').removeAttr("selected");

            var holder = $('<div class="margin-top-5"></div>');
            holder.append(sel);
            holder.append('<a href="#" title="Remove" class="btn btn-action btn-danger remove-cat"><i class="fa fa-trash"></i></a>');

            $('.c-holder').append(holder);

        });

        $(document).on('click', '.remove-cat', function(e) {
            e.preventDefault();
            $(this).parent().remove();
        })
    });
</script>








