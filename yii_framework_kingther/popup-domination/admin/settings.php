<?php 
if ( ! defined('POPUP_DOM_PATH')):
	exit('No direct script access allowed');
else:
	$msg = '';
	if(isset($in['do']) && $popdom->verify_token($in['_token'])):
		if(strtolower($in['do']) == 'save'):
			if(isset($in['popup_domination_account'])){
				$error_msg = '';
				$update = $in['popup_domination_account'];
				if($popdom->option('admin_pass') != md5($popdom->config['salt'].$update['cur_pass'])){
					$error_msg = 'Current password, does not match your password.';
				} else {
					if(!empty($update['email'])){
						if(!$popdom->validate_email($update['email'])){
							$error_msg = 'The email address you entered is invalid.';
						} else {
							$popdom->option('admin_email',$update['email']);
						}
					}
					if(!empty($update['new_pass']) && !empty($update['confirm_pass'])){
						if($update['new_pass'] != $update['confirm_pass']){
							$error_msg = 'Confirmation password, must match.';
						} else {
							$popdom->option('admin_pass',md5($popdom->config['salt'].$update['new_pass']));
						}
					}
				}
				$msg = (($error_msg == '')?'
					<div class="updated fade"><p><strong>Settings saved.</strong></p></div>':'');
			}
		endif;
	endif;
	include POPUP_DOM_PATH.'admin/tpl/settings.php';
endif;
?>