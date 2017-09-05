<?php
define('POPUP_DOM_PATH',dirname(__FILE__).'/');
require POPUP_DOM_PATH.'popup-domination.php';
$std = new PopUp_Domination();
$ins = $std->check_installed(true);

if(!$ins){
	header('Location: ./install/');
}else{
	echo '
	<script src="//code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	<!--
	window.location = "./admin/"
	//-->
	</script>
	';
}
exit;
?>
