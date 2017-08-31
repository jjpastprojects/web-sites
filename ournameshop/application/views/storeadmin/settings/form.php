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
                    <li class="active"><span>Settings</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Settings
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-md-10 col-xlg-8">
            <div class="hpanel hgreen">
                <form role="form" action="" method="post">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                            <a href="#general-tab" data-toggle="tab">General</a>
                        </li>
                        <li class="">
                            <a href="#payment-tab" data-toggle="tab">Payment</a>
                        </li>
                        <li class="">
                            <a href="#social-tab" data-toggle="tab">Social Networks</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general-tab">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo form_prep($shop->name);?>" placeholder="Shop Name">
                                </div>

                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Domain</label>
                                            <input type="text" name="domain" class="form-control" value="<?php echo form_prep($shop->domain);?>" placeholder="Domain">
                                        </div>
                                    </div>
                                    <div class="col-md-5 domain-suffix" style="<?php if($shop->custom_domain) echo 'display: none;';?>">
                                        .<?php echo $this->config->item('domain');?>
                                    </div>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" class="i-checks" name="custom_domain"<?php if($shop->custom_domain) echo ' checked';?>> Custom Domain
                                    </label>
                                </div>

                                <hr />
                                <h4>
                                    Enabled Categories
                                    <small>
                                        [ <a href="#" class="text-small check-cats" data-unchecked="false">Uncheck All</a> ]
                                    </small>
                                </h4>

                                <div class="row cat-list">
                                    <?php foreach($this->categories->get_all() as $v):?>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="checkbox">
                                            <label class="no-padding">
                                                <input<?php if(!$options['enabled_cats']->option_value || in_array($v->id, $options['enabled_cats']->option_value)) echo ' checked';?> type="checkbox" class="i-checks" name="options[enabled_cats][]" value="<?php echo $v->id;?>" />
                                                <?php echo $v->name;?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>

                                <hr />

                                <div class="form-group">
                                    <label>Shop Logo</label>
                                    <img src="<?php echo logo_url();?>" class="logo-preview" alt="LOGO" onclick="$(this).next()[0].click(); return false;"/>

                                    <input type="file" name="file" class="form-control hidden" id="file" data-url="/<?php echo STORE_ADMIN_URL_PREFIX;?>/settings/upload_logo" />

                                    <a href="#" class="btn btn-sm btn-warning" onclick="$(this).prev()[0].click(); return false;">
                                        <i class="fa fa-image"></i> Change
                                    </a>
                                </div>

                                <!--
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">
                                    Your Logo
                                    </label>

                                    <div class="col-lg-3">
                                        <input type="file" name="file" class="form-control" id="file" data-url="/<?php echo STORE_ADMIN_URL_PREFIX;?>/rshop/upload_logo" />
                                        <img style="display: none;" src="/img/loader26.gif" alt="loading" />
                                    </div>
                                </div>
                                -->
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                        <div class="tab-pane" id="payment-tab">
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    Please enter your PayPal email so we can send you your profit.
                                </div>
                                <div class="form-group">
                                    <label>PayPal Email</label>
                                    <input type="text" name="options[pp_email]" 
                                    value="<?php echo isset($options['pp_email']) ? $options['pp_email']->option_value : '';?>" class="form-control" />
                                </div>

                                <?php /*
                                <h3>Paypal Api</h3>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="options[pp_username]" value="<?php echo isset($options['pp_username']) ? $options['pp_username']->option_value : '';?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="options[pp_password]" value="<?php echo isset($options['pp_password']) ? $options['pp_password']->option_value : '';?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Signature</label>
                                    <input type="text" name="options[pp_signature]" value="<?php echo isset($options['pp_signature']) ? $options['pp_signature']->option_value : '';?>" class="form-control">
                                </div>

                                <h3>Stripe Api</h3>
                                <div class="form-group">
                                    <label>Api Key</label>
                                    <input type="text" name="options[stripe_api_key]" value="<?php echo isset($options['stripe_api_key']) ? $options['stripe_api_key']->option_value : '';?>" class="form-control">
                                </div>
                                */ ?>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                        <div class="tab-pane" id="social-tab">
                            <div class="panel-body">
                                <?php /*
                                <h3>Social Networks API Keys</h3>
                                <div class="form-group">
                                    <label>Facebook App ID</label>
                                    <input type="text" name="options[fb_app_id]" value="<?php echo isset($options['fb_app_id']) ? $options['fb_app_id']->option_value : '';?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Google Client ID</label>
                                    <input type="text" name="options[g_client_id]" value="<?php echo isset($options['g_client_id']) ? $options['g_client_id']->option_value : '';?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Linkedin Api Key</label>
                                    <input type="text" name="options[li_api_key]" value="<?php echo isset($options['li_api_key']) ? $options['li_api_key']->option_value : '';?>" class="form-control">
                                </div>
                                */ ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#file').fileupload({
            dataType: 'json',
            add: function (e, data) {
                if(!(/(\.|\/)(gif|jpg|jpeg|png)$/i).test(data.files[0].name))
                    alert('Please upload image file');
                else
                    data.submit();
            },

            formData: function (form) {
                return form.serializeArray();
            },

            start: function(e) {
                $(e.target).next().text('Please wait...')
            },

            done: function (e, data) {
                var frm = data.form;
                data    = data.result;

                var img_path = '<?php echo $this->config->item('url_path', 'shop_logo');?>';

                if(data.success){
                    $('a.nav-brand img').attr('src', img_path + data.img);
                    $('.logo-preview').attr('src', img_path + data.img);
                }
                else
                    alert('', data.msg);

                $(e.target).next().html('<i class="fa fa-image"></i> Choose');
            }
        });

        $('.check-cats').on('click', function(e) {
            e.preventDefault();

            if($(this).data('unchecked'))
                $('.cat-list input:checkbox').iCheck('check');
            else
                $('.cat-list input:checkbox').iCheck('uncheck');

            $(this).data('unchecked', !$(this).data('unchecked'));
            $(this).text( ($(this).data('unchecked') ? 'Check' : 'Uncheck') + ' All');
        });

        $('[name=custom_domain]').on('ifChanged', function(e){
            if($(this).is(':checked'))
                $('.domain-suffix').hide();
            else
                $('.domain-suffix').show();
        });
    });
</script>