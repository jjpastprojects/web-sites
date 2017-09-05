<?php 
	$provider = $_POST['provider'];
	$mailingapi = unserialize(base64_decode($this->option('formapi')));
	//print_r($mailingapi);
	$provider  = $mailingapi['provider'];
	$api = $mailingapi['apikey'];
	if($provider == 'mc'){
		include 'mc/subscribe.php';
	}else if($provider == 'cm'){
		include 'campmon/subscribe.php';
	}else if($provider == 'aw'){
		include 'aweber_api/subscribe.php';
	}else if($provider == 'cc'){
		include 'concon/subscribe.php';
	}else if($provider == 'ic'){
		include 'icon/subscribe.php';
	}else if($provider == 'gr'){
		include 'getre/subscribe.php';
	}else if($provider == 'nm'){
		include 'email.php';
	}
	
	die();
?>