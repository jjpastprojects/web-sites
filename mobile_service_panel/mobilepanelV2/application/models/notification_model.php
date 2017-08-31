<?php
class Notification_model  extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

  /* notification */
function fetch_device($device_type)
{
    $fetch=$this->db->query("select * from users where device_type='$device_type'");
    $count=$fetch->num_rows();
    if($count)
    {
      return $fetch->result_array();
    }
 
}
function fetch_device_selecteduser($usersids)
{
    $fetch=$this->db->query("select * from device_info where uuid = '$usersids'");
    $count=$fetch->num_rows();
    if($count)
    {
      return $fetch->result_array();
    }
 
}
function fetch_all_device($type="")
{
	$morequery = "";
	$iphone = $andorid=array();
	if($type=="PRICE_DROP"){
		$morequery = " and user_setting.price_drop='1'";
	}
	if($type=="SALE"){
		$morequery = " and user_setting.offer_sale='1'";
	}
	
    $fetch=$this->db->query("select devices.* from devices 
    left join user_device on user_device.device_id = devices.id
    left join users on users.id = user_device.user_id
    left join user_setting on user_setting.user_id = users.id
    where device_platfrom='Ios' and users.is_logout='0' ".$morequery." group by devices.uuid ");
	
    $count=$fetch->num_rows();
    if($count)
    {
      $iphone=$fetch->result_array();
    }
    $fetch_data=$this->db->query("select devices.* from devices
        left join user_device on user_device.device_id = devices.id
    left join users on users.id = user_device.user_id
    left join user_setting on user_setting.user_id = users.id
     where device_platfrom='Android' and users.is_logout='0'  ".$morequery." group by devices.uuid");
    $counts=$fetch_data->num_rows();
    $andorid=array();
    if($counts)
    {
      $andorid=$fetch_data->result_array();
    }
    
    return array("iphone"=>$iphone,"andorid"=>$andorid);
}
    
}