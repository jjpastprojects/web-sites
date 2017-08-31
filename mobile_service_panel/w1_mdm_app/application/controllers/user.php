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
		//echo "<pre>";
        // print_r($this->session->userdata);exit;
        $adminuser = $this->session->userdata('logged_in');
        $user = $this->session->userdata('loggin_in');
        if ((!$user)&&(!$adminuser)) {
            redirect('login/index');
        }
		if(!isset($_REQUEST['id'])){
			redirect('admin/index');
		}
		$user_id = $this->session->userdata('id');
		updateActivity($user_id);
	 
		 
    }

    function index()
    {
    	
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
			$contact_count  = count($device['contacts']);
			
        }else{
        	$contact_count = 0;
        }
		 $data['contact_count'] = $contact_count;
		 
		
		 //end contact
		 
		 
		 // app 
		/* $deviceapps = $this->user_model->get_deviceapps($_REQUEST['id']);
		 $check_apps = count($deviceapps); 
		  if($check_apps>0){
        	 
			 $device= get_unserialize($deviceapps[0]['app_detail']);
			$apps_count  = count($device);
        }else{
        	$apps_count = 0;
        }*/
		$apps_count = 0;
		 $data['apps_count'] = $apps_count;
		 //end apps
		 
		 // sms
		  $general = $this->user_model->get_users_general($_REQUEST['id']);
		  $check_general = count($general); 
		  if($check_general>0){
        	$general_info = json_decode($general[0]['detail'],true); 
		 
			 
        }else{
        	$general_info = array();
        } 
	 
		 $data['general_info'] = $general_info;
		  
					
		 
		 
		 //end sms
		 
		 //call log
		/* $calllogs = $this->user_model->get_users_calllogs($_REQUEST['id']);
		  $check_call_log = count($calllogs); 
		  if($check_call_log>0){
         
		 $device= get_unserialize($calllogs[0]['call_detail']);
			$call_log_count  = count($device);
			$call_list = $device;
        }else{
        	$call_log_count = 0;
        }
		*/
		$call_log_count = 0;
		 $data['call_log_count'] = $call_log_count;
		 
		  
		 
		 //end call log
		 
        /// end of dashboad data
		
		  //$data['call_list'] = $call_list;
        $data['active_page'] = 'index';
	
       $this->load->view('user/header2', $data);
        $this->load->view('user/dashboard',$data);
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
	 function recording()
	 {
	 	$data['active_page'] = 'recording';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/recording',$data);
	 }
	 /// OCR Explorer
	 	function cancleRequest()
    {
        $devicedata = $this->user_model->cancleRequest();
      if($devicedata){
      	echo 1;
      }else{
      	echo 0;
      }
    }
	 	 function ocr_explorer()
	 {
	 	
	  
	 	 	$data['active_page'] = 'file_explorer';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/ocr_explorer_grid',$data);
	 }
	 
	 
	 ///end
	 
	    function ocr_screencastvideo()
	 {
	 	 
	  
	 	 	$data['active_page'] = 'ocr_screencastvideo';
			 
	 $this->load->view('user/header2', $data);
        $this->load->view('user/ocr_video_explorer',$data);
	 }
	 
	   function ocr_screendata()
	 {
	 	 
	  
	 	 	$data['active_page'] = 'ocrscreen';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/ocr_file_explorer',$data);
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
	 	 function events()
	 {
	 	     $events = $this->user_model->get_users_events($_REQUEST['id']);
      $data['events'] = $events;
	 	$data['active_page'] = 'events';
	 $this->load->view('user/header2', $data);
        $this->load->view('user/events',$data);
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
				$userlocationarr[] = array("lat"=>$lat,"lng"=>$lng,"timing"=>$timing);
			}
			 }
		echo	 json_encode($userlocationarr);
       
	  //echo "<pre>";
	  //print_r($userlocationarr);exit;
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
           <div class="col-lg-2 col-xs-2">
              <!-- small box -->
              <div class="small-box bg-aqua">
              	 <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <div class="inner">
                	<b><?php echo $dir; ?></b>
            
                  <p><a  onclick="download_folder('<?php  echo $dir?>')" style="cursor: pointer;color:red;">(Download)</a></p>
                  
                </div>
               
                <a style="cursor: pointer" onclick="get_file_explorer_gridchild('<?php echo $dir;?>')" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
              </div>
            </div>
       <?php
			}
		}
	 }
/////////////////OCR GRID DATA///////////////////
	 function get_ocr_explorer_grid(){
	 	$griddata = $this->user_model->get_ocr_explorer_grid($_REQUEST['id']);
		 $directory = array();
		foreach ($griddata as $raw) {
	 
				
			 
       ?>
           <div class="col-lg-2 col-xs-2">
              <!-- small box -->
              <div class="small-box bg-aqua">
              	 <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <div class="inner">
                	<h5>Id:<?php echo $raw['ocr_code']; ?></h5>
            
                  
                </div>
               
                <a style="cursor: pointer" href="<?php echo site_url("user/ocr_screen_list").'?id='.$_REQUEST['id'].'&ocr_code='.$raw['ocr_code'];?>" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
              </div>
            </div>
       <?php
			}
		}
	 


/////// END OCR GRID DATA////////////////




 function get_file_explorer_gridchild(){
	 	$griddata = $this->user_model->get_file_explorer_gridchild($_REQUEST['id'],$_REQUEST['dir']);
		 $directory = array();
		foreach ($griddata as $raw) {
			 
		 $patharr	= array_filter(explode($_REQUEST['dir']."/",$raw['filepath']));
			 
		$patharrcount = 	count($patharr);
			if($patharrcount>0){
				if($patharrcount>=2){ 
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
			}
					
					///end get dir
						 
				}else{
					$pathremain = $patharr[0];
						/// get dir
						 $patharr_remain	= array_filter(explode("/",$pathremain));
			if(count($patharr_remain)>0){
				 foreach ($patharr_remain as $val) {
					 if(strlen($val)>0){
					 	//$directory[] = $val;
						 break;
					 }
				 }
			}
					
					///end get dir
					
				}
			}
		}
		if(count($directory)>0){
		$uniquedir = array_unique($directory);
			foreach ($uniquedir as $dir) {
				
			 
       ?>
           <div class="col-lg-2 col-xs-2">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                	<b><?php  echo $dir?></b>
                   <p><a  onclick="download_folder('<?php  echo $dir?>')" style="cursor: pointer;">(Download All)</a></p>
                  
                </div>
                <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <a style="cursor: pointer" onclick="get_file_explorer_gridchild('<?php echo $dir;?>')" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
               </div>
            </div>
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
	 	        $resdata = $this->user_model->get_data_settings($_REQUEST['id']);
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