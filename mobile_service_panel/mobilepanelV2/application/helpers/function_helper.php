<?php
error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 

function get_gmt_time()
{
    return gmdate("Y-m-d H:i:s");
}

function make_serialize($data)
{
	//$result = serialize($data);
	return $data;
}

function get_unserialize($data)
{
	//$result = unserialize($data);
	$resarr = json_decode($data,true);
	return $resarr;
}
	
	
	function updateActivity()
{
	$gmdate = get_gmt_time();
	
	 $ci = &get_instance();
    $ci->load->database();
 
    $sql="update `admin`  set 	last_activity = '$gmdate' where id = '1' ";
    $data = $ci->db->query($sql);

    
	return true;
}
	
	function getGpsLastDate($deviceid)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();
	$ci->db->limit(1);
  $ci->db->order_by("id","desc");
     $ci->db->where("device_id",$deviceid);
    $data = $ci->db->get("device_gps");
   if($data->num_rows()>0){
   $row =	$data->row();
	  $predate =strtotime($row->createdon);
   	$date = date("m/d/Y",$predate);
   }else{
   	 date_default_timezone_set("UTC");
  $date = 	gmdate("m/d/Y");
   }
    
	return $date;
}	


function batteryStatus($uuid){
	$response = array();
		 $ci = &get_instance();
    $ci->load->database();  
	
 	 $ci -> db -> where("is_delete" ,0 );
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> get('device_info');
		if($chkquery->num_rows()>0){
		$row = $chkquery->row();
			$response = array("battery_status"=>$row->battery_level,"battery"=>$row->battery);
			return $response;
	 }else{
			return $response = array("battery_status"=>"");
		}
}



	function isDeviceReady($uuid)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
	
	
	
	
	 $ci -> db -> where("is_delete" ,0 );
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> get('device_info');
		if($chkquery->num_rows()>0){
		$row = $chkquery->row();
			if($row->status=='OFFLINE'){
				return true;
			}
		$ci -> db -> where("uuid" ,$uuid );
		$query = $ci -> db -> get('tb_ready');
		
		 
 if($query->num_rows()>0){
 
	 
 	return true;
 }else{
	 
 
 	return false;
 }
		}else{
			return false;
		}
}
	function deviceImage($uuid)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
	 $ci -> db -> where("is_delete" ,0 );
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> get('device_info');
		if($chkquery->num_rows()>0){
		 $row = $chkquery->row();
			if(strlen($row->image)>0){
	return  "upload/userimg/".$row->image;
			}else{
				return "images/user.png";
			}
		}else{
			return "images/user.png";
		}
}	
	
  function moduleComplete($uuid,$module,$per)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
		$arr_field = array("module_loading" => $module,"loading_per" => $per );
		 
		 
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> update('device_info', $arr_field);
 
}	
?>
