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
                    <li><span>Templates</span></li>
                    <li class="active"><span>Edit Template</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Edit Template / <?php echo $template->name; ?>
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
                    Edit Template
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $template->id;?>" />
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Name:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input required type="name" required name="name" class="form-control" value="<?php echo set_value('name', $template->name);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Category:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <select name="category_id" class="form-control">
                                            <?php foreach($this->categories->get_all() as $c):?>
                                                <option value="<?php echo $c->id;?>"<?php if($c->id == $template->category_id) echo ' selected';?>>
                                                    <?php echo $c->name;?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Price:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input required type="number" required name="price" class="form-control" value="<?php echo set_value('name', $template->price);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Print Designer:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input type="hidden" name="print_designer" value="0" />
                                        <input type="checkbox" class="i-checks" name="print_designer" value="1"<?php if($template->print_designer) echo ' checked';?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Black Image low res:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input type="file" data-url="/admin/upload_template/low_res_b" name="template" />
                                        <div class="margin-top-10">
                                            <img id="low_res_b" style="width: 150px; background: #fff;" src="<?php echo tpl_thumb($template, 'low_res_b');?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Black Image hi res:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input type="file" data-url="/admin/upload_template/hi_res_b" name="template" />
                                        <div class="margin-top-10">
                                            <img id="low_res_b" style="width: 150px; background: #fff;" src="<?php echo tpl_thumb($template, 'hi_res_b');?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8 col-md-6 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('input:file').fileupload({
            dataType: 'json',

            formData: function (form) {
                return form.serializeArray();
            },

            start: function(e) {
                $(this).addClass('loading');
            },

            done: function (e, data) {
                var input = data.fileInputClone;
                var frm = data.form;
                data    = data.result;
                
                if(data.success)
                {
                    input.next().find('img').attr('src', data.img);
                }
                else
                    alert(data.msg);
            }
        });
    });
</script>