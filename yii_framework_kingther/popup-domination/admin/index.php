<?php
session_start();
define('POPUP_DOM_PATH',dirname(dirname(__FILE__)).'/');
define('IS_ADMIN',true);

$cpath = POPUP_DOM_PATH.'admin/';
require_once POPUP_DOM_PATH.'popup-domination.php';
$popdom = new PopUp_Domination();
$popdom->admin = new PopUp_Domination_Admin;
$popdom->check_installed(true);
require POPUP_DOM_PATH.'config.php';
$in = $popdom->in();
$error = '';

if(isset($in['action']) && $in['action'] == 'logout'){
	$popdom->admin->logout();
}

if($popdom->admin->logged_in()){
	/* cases here just like in wordpress version */
	$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$url = explode($popdom->plugin_url.'admin/index.php?',$url);
		
	if(isset($_GET['section'])){
		$section = $_GET['section'];
		if(isset($_GET['action'])){
			$action = $_GET['action'];
		}
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
	}else{
		$var ='';
		$section = '';
	}
	switch ($section) {
	    case 'campaigns':
	    	switch($action){
	    		case 'edit':
	    			$popdom->admin->load_camp($in);
	    			break;
	    		case 'save':
	    			$popdom->admin->save_camps($in);
	    			break;
	    		default:
	    			$popdom->admin->list_camps();
	    			break;
	    	}
	        break;
	    case 'analytics':
    		switch($action){
    			case 'view':
    				$popdom->admin->show_analytics();
    				break;
    			default:  
    				$popdom->admin->load_analytics();
    				break;
    		}	
	        break;
	    case 'absplit':
	    	switch($action){
	    		case 'edit':
	    			$popdom->admin->abpanel($in);
	    			break;
	    		case 'save':
	    			$popdom->admin->saveab($in);
	    			break;
	    		default:
	    			$popdom->admin->load_abtesting();
	        		break;
	        }
	        break;
	    case 'mailinglist':
	    	switch($action){
		    	case 'save':
		    		$popdom->admin->save_mailing($in);
		    		break;
		    	default:
		    		$popdom->admin->mailing_settings($in);
		        	break;
	        }
	        break;
	   	case 'promote':
	        $popdom->admin->promote($in);
	        break;
	   	case 'uploader':
	        $popdom->admin->uploader($in);
	        break;
	    case 'ajax':
	    	if(isset($_GET['action'])){
				if($_GET['action'] == 'ajax')
					$file = 'ajax';
				elseif($_GET['action'] == 'settings')
					$file = 'settings';
			}
	    	require POPUP_DOM_PATH.'admin/'.$file.'.php';
	    	break;
	    default:
	    	$file = 'campaigns/index';
	    	$popdom->admin->list_camps();
	        break;
	}
}else if(isset($_GET['pwreset'])){
	if(isset($_POST['submit'])){
		if($popdom->admin->check_reset_code()){
			echo '	
			<script type="text/javascript">
			<!--
			window.location = "'.$popdom->plugin_url.'?msg=reset"
			//-->
			</script>';
		}else{
			$error = 'You code has not matched. Your code now has timed out, please head back to the login screen, to try again';
		}
	}
	$to = $popdom->option('admin_email');
	$code = $popdom->resetcode();
	$popdom->option('resetcode',$code);
	$subject = "PopUp Domination Password Reset";
	$message = "PLEASE DON'T REPLY TO THIS EMAIL
	
	A password reset request has been requested for your PopUp Domination Stand-Alone install at: ".$popdom->plugin_url.". 
	
	Your reset code is: ".$code." 
	
	If you did not request this, please delete this email as your password will remain the same if this code is unused.";
	$from = "noreply@popupdomination.com";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);	

	$file = 'resetpassword';
 	require POPUP_DOM_PATH.'admin/'.$file.'.php';
} else {
 	$file = 'login';
 	require POPUP_DOM_PATH.'admin/'.$file.'.php';
}

?>