<?php
/**
* js.php
* 
* linked php file which creates all the javascript needed to animate and create the popup.
*/
header('Access-Control-Allow-Origin: *');
$ab = false;
include dirname(__FILE__).'/popup-domination.php';
if(isset($_GET['type'])){
	$ab = true;
}else{
	if(isset($_GET['popup'])){
		$id = $_GET['popup'];
	}
}
if(isset($_POST['action']) && $_POST['action'] == 'ajax'){
	/**
	* does the ajax front stuff is called from ajax.
	*/
	$popdom = new PopUp_Domination_Front();
	$dothis = $_POST['dothis'];
	if($dothis != 'mailing'){
		$id = $_POST['campaignid'];
		$abid = $_POST['popupid'];
	}
	$id = (!empty($id))?$id:$abid;
	require $popdom->plugin_path.'ajax.php';
} else {
	/**
	* gets front class, sets up facebook stuff, generates javascript and may do analytics.
	*/
	$popdom = new PopUp_Domination_Front();
	if($popdom->option('facebook_enabled') == 'Y'){
		require $popdom->plugin_path.'inc/facebook/facebook.php';
		$popdom->facebook = new Facebook(array(
		  'appId'  => $popdom->option('facebook_id'),
		  'secret' => $popdom->option('facebook_sec'),
		  'cookie' => true,
		));
	}
	$popdom->ab = $ab;
	$popdom->get_javascript();
}
//echo memory_get_usage(true) . "\n";