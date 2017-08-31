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
                    <li><span>Product Types</span></li>
                    <li class="active"><span>Edit Product Type</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Edit Product Type / <?php echo $surface->name; ?>
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
                    Product Type Details
                </div>
                <div class="panel-body">
                    <form role="form" class="product-form form-horizontal" method="post" action="">
                        <input type="hidden" name="id" value="<?php echo $surface->id;?>" />
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Name:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <input type="text" class="form-control" name="name" value="<?php echo form_prep($surface->name);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Extra Price:</label>
                                    <div class="col-sm-8 col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon income-type-addon">$</div>
                                            <input type="number" class="form-control" name="extra_price" value="<?php echo form_prep($surface->extra_price);?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Default Product:</label>
                                    <label class="col-sm-8 col-md-6" style="padding-top: 7px; font-weight: normal;">
                                        <?php echo $surface->product_name ? $surface->product_name : '-';?>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8 col-md-6 col-sm-offset-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3" style="border-left: dashed 1px #ebeff6;">
                                <p class="text-center">
                                    Listings image
                                </p>
                                <p>
                                    <img class="surface bordered" src="<?php echo surface_thumb($surface);?>" />
                                </p>
                                <p class="text-center">
                                    <input type="file" data-url="/admin/upload_surface_img/listing" class="hidden" name="img" />
                                    <a href="#" class="btn btn-warning" id="img-change">Change</a>
                                </p>
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
        $('#img-change').on('click', function(e) {
            e.preventDefault();

            var lnk = $(this);
            var inp = lnk.prev();

            inp[0].click();
        });

        $('input:file').fileupload({
            dataType: 'json',

            formData: function (form) {
                return form.serializeArray();
            },

            start: function(e) {
                $(this).next().text('Please wait...');
            },

            done: function (e, data) {
                var input = data.fileInputClone;
                var frm = data.form;
                data    = data.result;
                
                input.next().text('Change');

                if(data.success)
                {
                    input.parent().prev().find('img').attr('src', data.img);
                }
                else
                    alert(data.msg);
            }
        });
    });
</script>