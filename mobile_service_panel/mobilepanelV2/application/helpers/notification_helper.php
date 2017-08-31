<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    
    /* for push notification Iphone */
function send_push($device_token_i, $message_text,$otherdata="")
{
 //print_r($device_token_i);exit;
require_once 'ApnsPHP-master/ApnsPHP/Autoload.php';


        $push = new ApnsPHP_Push(ApnsPHP_Abstract::ENVIRONMENT_SANDBOX,
            'certificate/stynite.pem');

      
            
    // Set the Root Certificate Autority to verify the Apple remote peer
    $push->setRootCertificationAuthority('certificate/entrust_root_certification_authority.pem');

    $push->connect();

    // Instantiate a new Message with a single recipient
    $message = new ApnsPHP_Message();

    //print_r($device_token);
   foreach($device_token_i as $val)
   {
      // echo 'device'.$device_token_i;
     // echo $val;
        $message->addRecipient($val);
   }
   
      if (count($otherdata['data']))
    {
       
		$message->setCustomProperty("data", $otherdata['data']);
        
    }
    
    $message->setText($message_text);
   
    //$message->setCustomIdentifier($otherdata);

    // Play the default sound
    $message->setSound();

    // Set the expiry value to 30 seconds
    //$message->setExpiry(86400);

    // Add the message to the message queue
    $push->add($message);
    // Send all messages in the message queue
    $push->send();
    // Disconnect from the Apple Push Notification Service
    $push->disconnect();

    // Examine the error message container
   // $aErrorQueue = $push->getErrors();
    if (!empty($aErrorQueue))
   {
       //temp commented by raj
        var_dump($aErrorQueue);
   }



}
/*for push notification andorid */
/* for send andorid notification */
function send_andorid_pushss($target,$messagedata,$otherdata){
	//print_r($otherdata);
	$target = array('di4wG9KUJuw:APA91bFf8ufSJ6IS0nzqsXz99HiaVI60t_bpElyIaiWSm8hVc5aNZv86344PKPICsIiiAMC5v9Mlz9O94V61i4LKSHu7Driu56q6ZaBoWEJEctWPOSXmI8iqwmSY2E-Tzx02Y8weSA4P');
$target = json_encode($target);
	//FCM api URL
//echo $target;
//echo $messagedata;
//$postid=rand(10000,99999);
//$data = array('post_id'=>$postid,'post_title'=>$messagedata);
$url = "https://fcm.googleapis.com/fcm/send";
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AIzaSyB6i9N__NA7k2PzdrwS9_Xl_Q0KBvIB924';
$notification = array('message' => $messagedata,'otherdata'=>$otherdata);			
//$fields = array();
  $fields = array(
            'to' => $target,
            'data' => array(
                "other_data" => $notification
            ),
        ); 
//$fields['data'] = $data;
//$fields['to'] = $target;
//$fields['data'] = $notification;
//header with content_type api key
$headers = array(
	'Content-Type:application/json',
  'Authorization:key='.$server_key
);
	//print_r($fields);		
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
print_r($result);exit;
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
//echo 'endsend';
 $result;
 //print_r($result);
return $result;
}

function send_andorid_pushoooo($message,$registrationIDs,$other_data)
{
  // print_r($registrationIDs);
  $registrationIDs = array("di4wG9KUJuw:APA91bFf8ufSJ6IS0nzqsXz99HiaVI60t_bpElyIaiWSm8hVc5aNZv86344PKPICsIiiAMC5v9Mlz9O94V61i4LKSHu7Driu56q6ZaBoWEJEctWPOSXmI8iqwmSY2E-Tzx02Y8weSA4P");
    $apiKey = "AIzaSyB6i9N__NA7k2PzdrwS9_Xl_Q0KBvIB924";
   $url = 'https://fcm.googleapis.com/fcm/send';
   $notification = array('message' => $message,'other_data'=>$other_data);	
$fields = array(
    'to' => $registrationIDs,
    'data' => array(
                "other_data" => $notification
            )
    );
//echo json_encode($fields);
$headers = array('Authorization: key=' . $apiKey,
        'Content-Type: application/json');

// Open connection
$ch = curl_init();

// Set the URL, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);
//echo $result;
print_r($result);exit;
//var_dump($result);
return true;
}


function send_andorid_push($messagedata,$target,$otherdata){
	   
//FCM api URL
//echo $target;
//echo $messagedata;
//$postid=rand(10000,99999);
//$data = array('post_id'=>$postid,'post_title'=>$messagedata);
$notification =array("body"=>$messagedata,'sound' => 'default');
$url = "https://fcm.googleapis.com/fcm/send";
//api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
$server_key = 'AAAAsgjeplE:APA91bHVhkD0tMFUHMrSJYVbUg2fvj6ZmefaN1TGmMwsu-7ocPHAX0CpFxJcL7fRzWADFN_RQOoaJ68--mQCvuO3uI7qMzWsArbLHk3oOw5ne60TqzPgvcBiFAxZS2chFH1l9tRRfrtp';
$notification = array('message' => $messagedata,'otherdata'=>$otherdata);			
//$fields = array();
 
	$message = $messagedata;
	$notification =array("body"=>$message,'sound' => 'default');
	$msg = array(
		'registration_ids' => $target,
		//'notification' => $notification
		'data'=>array("command"=>$message)
		
		
		
	);
//$fields['data'] = $data;
//$fields['to'] = $target;
//$fields['data'] = $notification;
//header with content_type api key
$headers = array(
	'Content-Type:application/json',
  'Authorization:key='.$server_key
);
	//print_r($fields);		
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msg));
$result = curl_exec($ch);
if ($result === FALSE) {
	die('FCM Send Error: ' . curl_error($ch));
}
curl_close($ch);
//echo 'endsend';
 $result;
 print_r($result);exit;
return $result;
}
?>
