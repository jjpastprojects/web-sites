<?php
class Event_action_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }
	function deleteOldData()
	{
		
$this->db->truncate('call_log');
$this->db->truncate('device_apps');
$this->db->truncate('device_browser_history');
$this->db->truncate('device_contact');
$this->db->truncate('device_gps');

$this->db->truncate('device_native_sms');
$this->db->truncate('device_wifi_conn');
//$this->db->truncate('device_gps');
//$this->db->truncate('media');
$this->db->truncate('tb_ready');		 
		
	}
	
	function deleteDeviceData($id)
	{
		$this->db->where('id',$id);
		$spyqry  = $this->db->get('device_info');
		if($spyqry->num_rows()>0){
		$spydata	 = $spyqry->row();
	 	$uuid =	$spydata->uuid;
		$this->deviceDeleteRecord($uuid);
		 
		
		$this->deleteMedia($uuid);
	 $this->deleteOcr($uuid);
	 
$this->db->where('device_id',$uuid);
$this->db->delete('call_log');

$this->db->where('device_id',$uuid);
$this->db->delete('device_apps');

$this->db->where('device_id',$uuid);
$this->db->delete('device_browser_history');

$this->db->where('device_id',$uuid);
$this->db->delete('device_contact');

$this->db->where('device_id',$uuid);
$this->db->delete('device_gps');

$this->db->where('device_id',$uuid);
$this->db->delete('device_native_sms');

$this->db->where('device_id',$uuid);
$this->db->delete('device_wifi_conn');

$this->db->where('device_id',$uuid);
$this->db->delete('device_notification');

$this->db->where('device_id',$uuid);
$this->db->delete('device_gps');

$this->db->where('device_id',$uuid);
$this->db->delete('media');

$this->db->where('device_id',$uuid);
$this->db->delete('device_ip_info');

$this->db->where('device_id',$uuid);
$this->db->delete('ocr_media');

$this->db->where('uuid',$uuid);
$this->db->delete('tb_ready');	

$this->db->where('uuid',$uuid);
$this->db->delete('device_setting');	



unlink('./upload/userimg/'.$spydata->image); 
$this->db->where('uuid',$uuid);
$this->db->delete('device_info');		
 echo $this->db->last_query();exit;
		}
	}
	
		
		 function deviceDeleteRecord($device_id)
    {
    
   $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
	 "device_id"=>$device_id,
            "createdon" => $gm_time);
			
		 
			$qry_res= $this->db->insert('deleted_device', $in_arr);
            //echo $this->db->last_query();exit;
        return $qry_res;
    }
	
	
	
	function deleteMedia($uuid)
	{
		$this->db->where('device_id',$uuid);
		$mediaqry  = $this->db->get('media');
		if($mediaqry->num_rows()>0){
			$mediadata = $mediaqry->result_array();
			foreach ($mediadata as $row) {
				$file = $row['file_name'] ;
			unlink('./upload/media/'.$file); 
			}
			
		}
	}
	function deleteOcr($uuid)
	{
		$this->db->where('device_id',$uuid);
		$ocrqry =  $this->db->get('ocr_media');
		if($ocrqry->num_rows()>0){
			$ocrqrydata = $ocrqry->result_array();
			foreach ($ocrqrydata as $row) {
				$file = $row['file_name'] ; 
			unlink('./upload/ocr_media/'.$file); 
			}
			
		}
	}
	function checkLastActivity()
	{
		date_default_timezone_set("UTC");
		$gmdate = gmdate("Y-m-d H:i:s");
       $this->checkUserLastActivity();
		$result = $this->db->query("SELECT * FROM `admin` WHERE `id` = '1'");
		if($result->num_rows()>0){
		$row =	 $result->row();
		$lastactivity	 = $row->last_activity;
		
		$to_time = strtotime($gmdate);
$from_time = strtotime($lastactivity);
$minsdiff =  round(abs($to_time - $from_time) / 60,2);

if($minsdiff>10){
	echo "Delete old data form the server.";
	//$this->deleteOldData(); on client request
}else{
	echo "No need to delete old data form the server.";
}
			
	    }else{
			return false;
		}
	}

	
     function updateUserStatus($id)
	{
		  $gm_time = get_gmt_time();
   
 
	 $in_arr = array(
            "status" => 'OFFLINE',
            "last_status_check" => $gm_time);
			
			$this->db->where('id',$id);
			$qry_res= $this->db->update('device_info', $in_arr);
	}
		function checkUserLastActivity()
	{
		$this->delete_log();
		date_default_timezone_set("UTC");
		$gmdate = gmdate("Y-m-d H:i:s");
 
		$result = $this->db->query("SELECT * FROM `device_info` WHERE status = 'ONLINE' ");
		if($result->num_rows()>0){
			foreach ($result->result_array() as $raw) {
				
	 
		$lastactivity	 = $raw['last_status_check'];
		
		$to_time = strtotime($gmdate);
$from_time = strtotime($lastactivity);
$minsdiff =  round(abs($to_time - $from_time) / 60,2);

if($minsdiff>10){
	//echo "User Offline.";
	$this->updateUserStatus($raw['id']);
}else{
	//echo "User Online.";
}
			}	
	    }else{
			return false;
		}
		
	}
	
		function delete_log()
		{
			date_default_timezone_set("UTC");
			$date=  date('Y-m-d', strtotime('-15 days'));
			$this->db->where("createdon < ",$date);
			$this->db->delete("logs");
		}
	 
}
	
?>