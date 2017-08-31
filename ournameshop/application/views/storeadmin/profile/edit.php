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
                    <li class="active"><span>Profile</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                My Profile
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
                    My Profile
                </div>
                <div class="panel-body">
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
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    
                    <div class="line line-dashed line-lg pull-in"></div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>