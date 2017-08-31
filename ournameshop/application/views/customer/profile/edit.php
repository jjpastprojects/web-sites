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
                Your Profile
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
                    Your Profile
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
                    Shipping Info
                </div>
                <div class="panel-body">
                    <form role="form" action="" method="post">
                        <input type="hidden" name="action" value="shipping" />
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country" class="form-control" data-required="true">
                                <?php foreach($this->countries->get_all() as $country):?>
                                <option value="<?php echo $country->code;?>"<?php if($user->country == $country->code || !$user->country && $country->code == 'US') echo ' selected';?>>
                                <?php echo $country->name;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <select name="state" class="form-control">
                                <?php foreach($this->config->item('states_f') as $state):?>
                                <option value="<?php echo $state;?>"<?php if($state == $user->state) echo ' selected';?>>
                                <?php echo $state;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                            <input value="<?php echo form_prep($user->state);?>" name="state" class="form-control hidden" data-required="true" />
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input name="city" value="<?php echo form_prep($user->city);?>" type="text" class="form-control" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label>Address Line 1</label>
                            <input name="address" value="<?php echo form_prep($user->address);?>" type="text" class="form-control" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label>Address Line 2</label>
                            <input name="address2" value="<?php echo form_prep($user->address2);?>" type="text" class="form-control" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label>Zip</label>
                            <input name="zip" value="<?php echo form_prep($user->zip);?>" type="text" class="form-control" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" value="<?php echo form_prep($user->phone);?>" type="text" class="form-control" placeholder="" />
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(function() {
    $('select[name=country]').on('change', function() {
      if($(this).val() == 'US')
      {
        $('select[name=state]').removeClass('hidden').prop('disabled', false);
        $('input[name=state]').addClass('hidden').prop('disabled', true);
      }
      else
      {
        $('select[name=state]').addClass('hidden').prop('disabled', true);
        $('input[name=state]').removeClass('hidden').prop('disabled', false);
      }
    }).trigger('change');
  });
</script>