<?php

if(strstr($_POST['email'],'@')) {

	$to = $_POST['master'];
	$subject = "PopUp Domination Sign Up";
	if(isset($_POST['name']) && !empty($_POST['name'])){
		$name_field = $_POST['name'];
	}else{
		$name_field = '';
	}
	$email_field = $_POST['email'];
	 
	$body = "Name: $name_field\n E-Mail: $email_field\n";
	 
	mail($to, $subject, $body);
	$url= $_POST['redirect'];
	echo "<meta http-equiv=\"refresh\" content=\"1;URL=$url\" />";
} else {

echo "Failed";

}
?> 