<?php 
if ( ! defined('POPUP_DOM_PATH')):
	exit('No direct script access allowed');
else:
	if(isset($in['login'])){
		$email = isset($in['login']['email']) ? $in['login']['email'] : '';
		$pass = isset($in['login']['pass']) ? $in['login']['pass'] : '';
		$error = $popdom->admin->check_admin($email,$pass);
		if(isset($_GET['msg']) && $_GET['msg'] == 'reset'){
			$error = 'Your password has been reset, please login with your new password.';
		}
	}else {
		if(isset($_GET['msg']) && $_GET['msg'] == 'reset'){
			$error = 'Your password has been reset, please login with your new password.';
		}
		$email = '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PopUp Domination</title>
        <link href="../admin/css/campaigns.css"  rel='stylesheet' id='install-css' />
	</head>
	<body>
    <br/>
    <br/>	
    	<div class="wrap popdom-login-panel" id="popup_domination">
			<div class="popup_domination_top_left">
				<img class="logo" src="../admin/css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
				<div class="clear"></div>
			</div>
			<form action="" method="post"> 
			<div class="clear"></div>
			<div id="popup_domination_container" class="has-left-sidebar">
			<div class="notices" style="display:none;">
				<p class="message"></p>
			</div>
			<div class="flotation-device login_panel">
                <div class="mainbox" id="popup_domination_tab_look_and_feel">
                    <div class="popdom_contentbox_inside">
                      <div class="login-panel">
                          <div class="error"><?php echo $error ?></div>
                          <div>
                              <h3>Email:</h3>
                              <input type="text" name="login[email]" id="email" value="<?php $popdom->input_val($email) ?>" />
                          </div>
                          <div>
                              <h3>Password:</h3>
                              <input type="password" name="login[pass]" id="pass" value="" />
                          </div>
                          <input type="submit" class="savecamp save-btn" name="submit" value="Login" />
                      </div>
                      <br/>
                      <div class="forgotpass">
                          Forgot Password? <a href="index.php?pwreset=true">Click here to reset</a>
                      </div>  
                    </div>                  
                    <div class="clear"></div>
                </div>
			</div>
			<div class="clear"></div>
            <div id="popup_domination_form_submit">						
            </div>
			<div class="clear"></div>
			</form>
		</div>
        </div>
    	</body>
</html> 
<?php endif; ?>