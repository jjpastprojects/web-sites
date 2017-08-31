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
                    <li class="active"><span>Meta Tags</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Meta Tags
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-sm-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Index Page (<a href="/">/</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %shop_name%
                    </p>

                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="index" />
                        
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['index']) ? form_prep($meta_tags['index']->title) : '';?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['index']) ? form_prep($meta_tags['index']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control"  value="<?php echo isset($meta_tags['index']) ? form_prep($meta_tags['index']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control"  value="<?php echo isset($meta_tags['index']) ? form_prep($meta_tags['index']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
           </div>
        </div>
        <div class="col-sm-6">
            <div class="hpanel hblue">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Lastname Page (<a href="/Forde">/Forde</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %lastname%
                    </p>
                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="lastname" />
                    
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['lastname']) ? form_prep($meta_tags['lastname']->title) : '';?>">
                        </div>
                    
                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['lastname']) ? form_prep($meta_tags['lastname']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control"  value="<?php echo isset($meta_tags['lastname']) ? form_prep($meta_tags['lastname']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control"  value="<?php echo isset($meta_tags['lastname']) ? form_prep($meta_tags['lastname']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="hpanel hblue">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Lastname Surface Page (<a href="/Forde?surface=MUG">/Forde?surface=MUG</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %lastname%, %surface%
                    </p>

                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="lastname_surface" />

                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['lastname_surface']) ? form_prep($meta_tags['lastname_surface']->title) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['lastname_surface']) ? form_prep($meta_tags['lastname_surface']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control"  value="<?php echo isset($meta_tags['lastname_surface']) ? form_prep($meta_tags['lastname_surface']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control"  value="<?php echo isset($meta_tags['lastname_surface']) ? form_prep($meta_tags['lastname_surface']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Surface Category Page (<a href="/Forde/category/fishing?surface=MUG">/Forde/category/fishing?surface=MUG</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %lastname%, %surface%, %category%
                    </p>

                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="surface_category" />

                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['surface_category']) ? form_prep($meta_tags['surface_category']->title) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['surface_category']) ? form_prep($meta_tags['surface_category']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control"  value="<?php echo isset($meta_tags['surface_category']) ? form_prep($meta_tags['surface_category']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control"  value="<?php echo isset($meta_tags['surface_category']) ? form_prep($meta_tags['surface_category']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Logo Category (<a href="/Forde/category/fishing">/Forde/category/fishing</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %lastname%, %category%
                    </p>
                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="logo_category" />

                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['logo_category']) ? form_prep($meta_tags['logo_category']->title) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['logo_category']) ? form_prep($meta_tags['logo_category']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control" value="<?php echo isset($meta_tags['logo_category']) ? form_prep($meta_tags['logo_category']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control" value="<?php echo isset($meta_tags['logo_category']) ? form_prep($meta_tags['logo_category']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="hpanel hblue">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Products Page (<a href="/Forde/angry-marlyn-2792/t-shirt">Forde/angry-marlyn-2792/t-shirt</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong>  %lastname%, %product_type%, %surface%
                    </p>
                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="products" />

                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['products']) ? form_prep($meta_tags['products']->title) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['products']) ? form_prep($meta_tags['products']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control" value="<?php echo isset($meta_tags['products']) ? form_prep($meta_tags['products']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control" value="<?php echo isset($meta_tags['products']) ? form_prep($meta_tags['products']->header) : '';?>">
                            </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="hpanel hblue">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Product Page (<a href="/Forde/angry-marlyn-2792/t-shirt/7">//Forde/angry-marlyn-2792/t-shirt/7</a>)
                </div>
                <div class="panel-body">
                    <p>
                        <strong>Variables:</strong> %product_type%, %lastname%, %model_name%, %logo_name%, %surface%, %category%
                    </p>
                    <form role="form" action="" method="post">
                        <input type="hidden" name="page" value="product" />

                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control" value="<?php echo isset($meta_tags['product']) ? form_prep($meta_tags['product']->title) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input name="desc" type="text" class="form-control" value="<?php echo isset($meta_tags['product']) ? form_prep($meta_tags['product']->description) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Keywords</label>
                            <input name="keys" type="text" class="form-control" value="<?php echo isset($meta_tags['product']) ? form_prep($meta_tags['product']->keywords) : '';?>">
                        </div>

                        <div class="form-group">
                            <label>Header Text</label>
                            <input name="header" type="text" class="form-control" value="<?php echo isset($meta_tags['product']) ? form_prep($meta_tags['product']->header) : '';?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>