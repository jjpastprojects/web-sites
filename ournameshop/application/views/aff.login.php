<div class="row margin-top padding-bottom-30">
  <div class="col-lg-4 col-lg-offset-4">
    <h4>Affiliate Login</h4>

    <?php if($this->ion_auth->errors()):?>
      <div class="alert alert-danger">
        <?php echo $this->ion_auth->errors();?>
      </div>
    <?php endif;?>

    <form role="form" action="" method="post">
      
      <div class="form-group">
        <label>Email</label>              
        <input required class="form-control" value="<?php echo form_prep($this->input->post('email'));?>" name="email" type="email" />
      </div>

      <div class="form-group">
        <label>Password</label>              
        <input required type="password" class="form-control" name="password" />
      </div>

      <button type="submit" class="btn btn-success">Login</button>
      <small>
        <a href="#" id="fpass">Forgot Password?</a>
      </small>
    </form>

    <form role="form" class="margin-top reset-aff-password-frm hidden" action="" method="post">
      <h4>Get new password</h4>

      <div class="alert alert-success hidden">
        Please check your email
      </div>

      <div class="form-group">
        <label>Email</label>              
        <input required class="form-control" value="" name="email" id="restore-email" type="email" />
      </div>

      <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
  </div>  
</div>

<script>
  $(function() {
    $('#fpass').on('click', function(e) {
      e.preventDefault();
      $('.reset-aff-password-frm').toggleClass('hidden');      
    });

    $('.reset-aff-password-frm').on('submit', function(e) {
      e.preventDefault();
      var frm = $(this);
      
      frm.find('button:submit').text('please wait...').prop('disabled', true);

      $.post('/auth/reset_aff_pwd', {email: frm.find('[name=email]').val()}, function(data) {
        frm.find('button:submit').hide();
        frm.find('.alert').removeClass('hidden');
      }, 'json');
    });
  });
</script>