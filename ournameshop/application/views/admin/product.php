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
                    <li><span>List</span></li>
                    <li class="active"><span>Edit Product</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Edit Product / <?php echo $product->model; ?>
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
                    Product Details
                </div>
                <div class="panel-body">
                    <form role="form" class="product-form form-horizontal" method="post" action="">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="hidden" name="id" value="<?php echo $product->id;?>" />
                                <div class="form-group">
                                    <label class="control-label col-md-3">Description:</label>
                                    <div class="col-md-8">
                                        <textarea style="min-height: 150px;" class="form-control" name="description"><?php echo form_prep($product->description);?></textarea>
                                        <small>(Variables %product_type%, %lastname%, %model_name%)</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Views:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="number" name="num_views" value="<?php echo form_prep($product->num_views);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Sales:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="number" name="num_sales" value="<?php echo form_prep($product->num_sales);?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-3">
                                        <input type="hidden" name="enabled" value="0" />
                                        <input type="checkbox" class="i-checks" name="enabled" value="1" <?php if($product->enabled) echo ' checked';?> /> Enabled
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-3">
                                        <input type="hidden" name="default" value="0" />
                                        <input type="checkbox" class="i-checks" name="default" value="1"<?php if($surface->default_product == $product->id) echo ' checked';?> /> Default
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center" style="border-left: dashed 1px #ebeff6;">
                                <p class="text-center">
                                    Listings image
                                </p>
                                <div class="relative listing-image">
                                    <img style="width: 287px;" class="surface bordered<?php if(!$product->listing_thumb) echo ' border-red';?>" src="<?php echo product_thumb($product, 'listing');?>" />
                                    <div class="logo-preview2 <?php echo $surface->css_class;?>"></div>
                                </div>

                                <p class="text-center margin-top-10">
                                    <input type="file" data-url="/admin/upload_product_img/listing" class="hidden" name="img" />
                                    <a href="#" class="btn btn-warning">Change</a>
                                </p>
                            </div>
                            <div class="col-lg-4 text-center">
                                <p class="text-center">
                                    Product's page image (png mask)
                                </p>
                                <div class="inner">
                                    <p>
                                        <img style="width: 287px;" class="surface bordered<?php if(!$product->preview_thumb) echo ' border-red';?>" src="<?php echo product_thumb($product, 'product');?>" />
                                    </p>
                                </div>
                                <p class="text-center">
                                    <input type="file" data-url="/admin/upload_product_img/preview" class="hidden" name="img" />
                                    <a href="#" class="btn btn-warning">Change</a>
                                </p>
                            </div>
                            <div class="col-sm-12 col-lg-4 text-center margin-top-10">
                                <input type="submit" value="Save" class="btn btn-primary btn-w100" />
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
        $('.btn-warning').on('click', function(e) {
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