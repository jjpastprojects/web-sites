<!-- <div class="social-events"></div> -->
<div style="display: none;" id="social-login-popup" class="row">
	<a href="#" class="close-btn" onclick="$.fancybox.close(); return false;"><span class="glyphicon glyphicon-remove"></a>

	<form action="#" method="post" class="social-login" style="display: none;">
		<input type="hidden" name="uid">
		<input type="hidden" name="provider">
		<input type="hidden" name="email">
		<input type="hidden" name="first">
		<input type="hidden" name="last">
	</form>

	<div class="col-sm-6 col-xs-12 email-login-holder">
		<form action="/auth/signin" method="post" class="signin-form">
			<h1>Sign in to your account</h1>

			<div class="text-danger text-center"></div>

			<div class="form-group has-feedback has-feedback-right">
				<input type="email" class="form-control input-lg" name="email" placeholder="Email" required="required">
				<i class="form-control-feedback glyphicon glyphicon-envelope"></i>
			</div>

			<div class="form-group has-feedback has-feedback-right">
		      	<input type="password" class="form-control input-lg" name="password" placeholder="Password" required="required">
		      	<i class="form-control-feedback glyphicon glyphicon-lock"></i>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success-custom btn-block">Sign In</button>
			</div>

			<div class="checkbox">
			    <label>
			      <input type="checkbox" name="remember" value="TRUE"> Remember Me
			    </label>
		    </div>
		    <div class="link">
			    <a href="javascript:;" class="forgot-lnk">Forgot Password?</a>
		    </div>
	    </form>

	    <form action="/auth/signup" method="post" class="signup-form hidden">
	    	<h1>Sign Up</h1>

			<div class="text-danger text-center"></div>

			<div class="form-group has-feedback has-feedback-right">
				<input type="text" class="form-control input-lg" name="first_name" placeholder="First Name" required="required">
				<i class="form-control-feedback glyphicon glyphicon-user"></i>
			</div>

			<div class="form-group has-feedback has-feedback-right">
				<input type="email" class="form-control input-lg" name="email" placeholder="Email" required="required">
				<i class="form-control-feedback glyphicon glyphicon-envelope"></i>
			</div>

			<div class="form-group has-feedback has-feedback-right">
		      	<input type="password" class="form-control input-lg" name="password" placeholder="Password" required="required">
		      	<i class="form-control-feedback glyphicon glyphicon-lock"></i>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success-custom btn-block">Sign Up</button>
			</div>

			<div class="link">
			    <a href="javascript:;" class="btn-register">Sign In</a>
		    </div>
		</form>

		<form action="/auth/forgot" method="post" class="forgot-form hidden">
			<h1>Reset your Password</h1>

			<div class="text-danger text-center" style="display: none;"><p></p></div>

			<div class="form-group has-feedback has-feedback-right">
				<input type="email" class="form-control input-lg" name="email" placeholder="Email" required="required">
				<i class="form-control-feedback glyphicon glyphicon-envelope"></i>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success-custom btn-block">Reset Password</button>
			</div>

			<div class="link">
			    <a href="javascript:;" class="back-to-login">Back</a>
		    </div>
		</form>
	</div>

	<div class="col-sm-1 col-xs-12 sep">
		<div class="hori-sep"></div>
	</div>

	<div class="col-sm-5 col-xs-12 social-btns">
		<h5>Don`t have an account? <a href="javascript:;" class="btn-register">Sign Up!</a></h5>
		<?php if(is_main_shop($shop) || !$shop->custom_domain || !empty($shop->options['fb_app_id']->option_value)):?>
			<a class="btn2 blue soicon-fb" href="#" data-network="facebook"><i class="fa fa-facebook"></i>Sign In with Facebook</a>
		<?php endif;?>

		<?php if(is_main_shop($shop) || !$shop->custom_domain || !empty($shop->options['g_client_id']->option_value)):?>
			<a class="btn2 pink soicon-gp" href="#" data-network="google"><i class="fa fa-google-plus"></i>Sign In with Google+</a>
		<?php endif;?>

		<?php if(is_main_shop($shop) || !$shop->custom_domain || !empty($shop->options['li_api_key']->option_value)):?>
			<a class="btn2 sky soicon-in" href="#" data-network="linkedin"><i class="fa fa-linkedin"></i>Sign In with LinkedIn</a>
		<?php endif;?>
		<a class="btn2 lime myicon soicon-mail margin-top hidden" href="#">Emaill</a>
	</div>
</div>


<?php return;?>
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('auth.update_buttons', function(){
			if(window.user_id)
			{
				$('.auth-disabled').hide();
				$('.auth-enabled').show();
			}
			else
			{
				$('.auth-disabled').show();
				$('.auth-enabled').hide();
			}
		}).trigger('auth.update_buttons');

		hello.init({ 
			google: '<?php echo $this->config->item('g_api_key');?>',
			facebook: '<?php echo $this->config->item('fb_api_key');?>',
			linkedin: '<?php echo $this->config->item('li_api_key');?>'
		}, {
			oauth_proxy : 'https://auth-server.herokuapp.com/proxy',
			redirect_uri: '<?php echo $this->config->item('oauth_redirect');?>'
		});

		$('.social-events').on('auth_popup.loggedin', function() {
			window.location.reload();
		});

		$('.social-events').on('auth_popup.error', function(e, data){
			alert(data.error);
		});

		$('.customer-login, .reseller-login, .signM a.signIn').on('click', function(e) {
			e.preventDefault();
			var lnk = $(this);
			
			$.fancybox.open({
				padding: 0,
				href: '#social-login-popup',
				closeBtn: false,
				afterShow: function() {
					var holder = $('#social-login-popup');

					holder.find('.close-btn').on('click', function(){
						$.fancybox.close();
						return false;
					});

					holder.find('a[data-network]').on('click', function(e) {
						e.preventDefault();
						var network = $(this).data('network');
						hello.login(network, {
							scope: 			'email'
						}, function(data) {
							
							if(data.error)
							{
								$('.social-events').trigger('auth_popup.error', {error: data.error.message});
							}
							else
							{
								hello( network ).api( '/me' ).success(function(r){
									holder.find('form.social-login').find('[name="uid"]').val(r.id);
									holder.find('form.social-login').find('[name="provider"]').val(network);

									holder.find('form.social-login').find('[name="email"]').val(r.email);
									holder.find('form.social-login').find('[name="first"]').val(r.first_name);
									holder.find('form.social-login').find('[name="last"]').val(r.last_name);

									$.post(('/customer/social_login'), holder.find('form.social-login').serialize(), function(r){
										if(r.success)
										{
											window.user_id = r.user_id;
											$('.social-events').trigger('auth.update_buttons');
											$('.social-events').trigger('auth_popup.loggedin', r);
										}
										else
										{
											$('.social-events').trigger('auth_popup.error', {error: r.msg});
										}
									}, 'json');
								});
							}
						});
						
					});
				}
			})
		});

		$(document).on( 'click','#social-login-popup a.email', function(e) {
			e.preventDefault();
			$(this).parent().find('.email-forms').toggle();
			return false;
		});
		$(document).on('click', '#social-login-popup .btn-signin', function(){
			$('.email-forms form').hide();
			$('.email-forms form.email-login').show();
			return false;
		});
		$(document).on('click', '#social-login-popup .btn-register', function(){
			$('.email-forms form').hide();
			$('.email-forms form.email-regiter').show();
			return false;
		});

		$(document).on('submit', '#social-login-popup form.email-login', function(){
			var $frm = $(this);
			$frm.find('[type="submit"]').data('last_text', $('[type="submit"]').val());
			$frm.find('[type="submit"]').val('Please wait...');
			$.post($(this).attr('action'), $(this).serialize(), function(r) {
				if(r.success)
				{
					window.user_id = r.user_id;
					$('.social-events').trigger('auth.update_buttons');
					$('.social-events').trigger('auth_popup.loggedin', r);
				}
				else
				{
					$('.social-events').trigger('auth_popup.error', {error: r.msg});
				}
				$frm.find('[type="submit"]').val($frm.find('[type="submit"]').data('last_text'));
			}, 'json');

			return false;
		});

		$(document).on('submit', '#social-login-popup form.email-regiter', function(){
			var $frm = $(this);
			$frm.find('[type="submit"]').data('last_text', $('[type="submit"]').val());
			$frm.find('[type="submit"]').val('Please wait...');
			$.post($(this).attr('action'), $(this).serialize(), function(r){
				if(r.success)
				{
					window.user_id = r.user_id;
					$('.social-events').trigger('auth.update_buttons');
					$('.social-events').trigger('auth_popup.loggedin');
				}
				else
				{
					$('.social-events').trigger('auth_popup.error', {error: r.msg});
				}
				$frm.find('[type="submit"]').val($frm.find('[type="submit"]').data('last_text'));
			}, 'json');

			return false;
		});

		$(document).on('click', '#social-login-popup .btn-popup-forgot-pwd', function(){
			$('.email-forms form').hide();
			$('.frm-restore-password').show();
		});

		$(document).on('submit', '#social-login-popup .frm-restore-password', function(){
			var $frm = $(this);
			$frm.find('[type="submit"]').data('last_text', $('[type="submit"]').val());
			$frm.find('[type="submit"]').val('Please wait...');
			$.post($(this).attr('action'), $(this).serialize(), function(r){
				if(r.success)
				{
					$frm.find('[type="submit"]').hide();
					$('[name="restore_email"]').replaceWith('<div class="alert alert-success">We\'v sent a new password to your email</div>');
				}
				else
				{
					$('.social-events').trigger('auth_popup.error', {error: r.msg});
				}
				$frm.find('[type="submit"]').val($frm.find('[type="submit"]').data('last_text'));
			}, 'json');
			return false;
		});

	});
</script>
