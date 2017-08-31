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
                    <li class="active"><span>Your Profile</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Your Profile
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-6 col-md-7 col-sm-8">
            <div class="hpanel hgreen">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Your Profile
                </div>
                <div class="panel-body">
                    <?php if(isset($err)):?>
                        <div class="alert alert-danger">
                        <?php echo $err;?>
                        </div>
                    <?php endif;?>
                    <form role="form" action="" method="post">
                        <input type="hidden" name="action" value="profile" />

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" required value="<?php echo form_prep($user->first_name);?>" placeholder="" name="first_name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value="<?php echo form_prep($user->last_name);?>" required placeholder="" name="last_name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input autocomplete="off" type="email" class="form-control" value="<?php echo form_prep($user->email);?>" required placeholder="" name="email">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>