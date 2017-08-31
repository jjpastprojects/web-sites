<div class="row margin-top padding-bottom-30">
  <div class="col-lg-4 col-lg-offset-4">
    <h4>New Affiliate</h4>

    <form role="form" action="" method="post" class="request-form">
      <div class="alert alert-success" style="display: none;">
        Thank You. We'll notify about your request by email.
      </div>
      <div class="form-group">
        <label>First Name</label>              
        <input required class="form-control" name="firstname" />
      </div>
      <div class="row">
        <div class="col-lg-7">
          <div class="form-group">
            <label>Subdomain</label>              
            <input required class="form-control" name="domain" value="" />
          </div>
        </div>
        <div class="col-lg-5 domain-suffix">
          .<?php echo $this->config->item('domain');?>
        </div>
      </div>

      <div class="form-group">
        <label>Email</label>              
        <input required type="email" class="form-control" name="email" />
      </div>

      <div class="form-group">
        <label>Password</label>              
        <input required class="form-control" type="password" name="password" />
      </div>

      <button type="submit" class="btn btn-success">Send</button>
    </form>
  </div>  
</div>