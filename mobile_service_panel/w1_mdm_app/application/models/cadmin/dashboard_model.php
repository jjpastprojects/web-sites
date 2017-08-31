<?php
/**
 * 
 */
class Dashboard_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	
	
		function checkUsername($input_method)
	{
		$this->db->select('username');
		
		if($input_method['id']>0){
		$this->db->where('id !=',$input_method['id']);	
		}
	 
		$this->db->where('username',$input_method['username']);
		$query = $this->db->get('admin');
		if($query->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function checkEmail($input_method)
	{
		$this->db->select('email');
		
		if($input_method['id']>0){
		$this->db->where('id !=',$input_method['id']);	
		}
		
		$this->db->where('email',$input_method['email']);
		$query = $this->db->get('admin');
		if($query->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}		
	}
	///// delete data
			function device_delete()
	{
		$datetime = get_gmt_time();
		$id = $_REQUEST['id'];
		$this->db->where("id",$id);
		$arr_field = array("is_delete" =>1, "updatedon" => $datetime);
return	$query =	$this->db->update("device_info",$arr_field);
	}
	
			function user_delete()
	{
		$datetime = get_gmt_time();
		$id = $_REQUEST['id'];
	$this->db->where('id',$id);
$this->db->delete('users');
return	1;
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
	 	$this->deviceDeleteRecord($uuid);
$this->db->where('uuid',$uuid);
$this->db->delete('device_general');
	 
$this->db->where('uuid',$uuid);
$this->db->delete('device_events');

$this->db->where('device_id',$uuid);
$this->db->delete('device_contact');


$this->db->where('uuid',$uuid);
$this->db->delete('data_request');


$this->db->where('device_id',$uuid);
$this->db->delete('device_gps');

 

$this->db->where('device_id',$uuid);
$this->db->delete('media');


$this->db->where('device_id',$uuid);
$this->db->delete('ocr_media');
 

$this->db->where('uuid',$uuid);
$this->db->delete('tb_ready');	

$this->db->where('uuid',$uuid);
$this->db->delete('device_setting');	

//unlink('./upload/userimg/'.$spydata->image); 
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
	
	///delete data
	function getCadminDetail($id)
	{
		$this->db->select('*');
		$this->db->where("id",$id);
		$query = $this->db->get("admin");
		//print_r($this->db->last_query());exit;
		return $query->row_array();
	}
	
	function getCadminimage() {
 $user_id = $this->session->userdata('id');
        $this->db->where("company_admin_id",$user_id);
		$this->db->order_by("id","desc");
		$this->db->limit(1);
		$query = $this -> db -> get("company_admin");
		//echo $this->db->last_query();exit;
		if($query->num_rows()>0){
		$row = $query -> row_array();
			return $row['profile_photo'];
		}else{
			return "";
		}
	}
	
	
	
	//// deleted device ////
	
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
	
	
	///end of deleted device ///
	
	
	function updateProfile($fileupload)
	{
		 $user_id = $this->session->userdata('id');
		 $this->db->where("id",$user_id);	
		  $this->db->where("password",md5($_POST['password']));	
		 $chkquery = $this->db->get("admin");
		 if($chkquery->num_rows()>0){
		$req_array = array(
			"name"=>$_POST['name'],
			"email"=>$_POST['email'],
			"username"=>$_POST['username']
			);
		$this->db->where("id",$user_id);	
		$query = $this->db->update("admin",$req_array);
		if($fileupload>0){
			$this->db->where("company_admin_id",$user_id);
			$this->db->delete("company_admin");
			$req_array = array(
			"created_on"=>get_gmt_time(),
			"profile_photo"=>$fileupload,
			"company_admin_id"=>$user_id
			);
		$this->db->insert("company_admin",$req_array);
			$comp_id = $this->db->insert_id();
		}
	
		if($query)
		{
			return 1;
		}else{
			return 0;
		}	
		 }else{
		 	return 0;
		 }
	}
	function name_device()
	{
		$req_array = array(			 
			"device_name"=>$_POST['name']
			);
			$this->db->where("id",$_POST['id']);	
		 $query = $this->db->update("device_info",$req_array);
		 if($query){
		 	return true;
		 }else{
		 	return false;
		 }
	}
	
	function get_permission($id)
	{
		$sql = "SELECT GROUP_CONCAT(permission_id) as 'perm_id' FROM company_admin_permission WHERE cadmin_id='$id'";
		$query=$this->db->query($sql);
		$data= $query->row_array();
		$data = explode(",", $data['perm_id']);
		return $data;
	}
	function get_device_count($id)
	{
		$sql = "SELECT COUNT(*) as 'rows' FROM users WHERE cadmin_id = '$id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	function getUserList($id)
	{
	 	$requestData = $_REQUEST;
		$columns = array(
		// datatable column index  => database column name
			0 => 'users.id', 
			1 => 'users.name', 
			2 => 'users.phone',
			3 => 'device_info.status'
			);

		// getting total number records without any search
		$sql = "SELECT users.id FROM `users` where is_deleted = '0' AND cadmin_id='$id' ";

		$query = $this -> db -> query($sql);
		$totalData = $query -> num_rows();
		$totalFiltered = $totalData;
		// when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT users.*,device_info.uuid,device_info.status FROM `users`
		left join device_info on device_info.user_id = users.id
		 where users.is_deleted = '0' AND users.cadmin_id='$id' ";
		if (!empty($requestData['search']['value'])) {// if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql .= " AND ( users.name LIKE '" . $requestData['search']['value'] . "%' ";
			$sql .= " OR users.phone LIKE '" . $requestData['search']['value'] . "%' )";
		}
		$query = $this -> db -> query($sql);
		$totalFiltered = $query -> num_rows();
		// when there is a search parameter then we have to modify total number filtered rows as per search result.
		$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
		/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
		//echo $sql;

		$query = $this -> db -> query($sql);

		$data = array();

		// preparing an array
		$i = ($requestData['start'] + 1);
		foreach ($query->result() as $row) {
			$device_more = '';
				$nestedData = array();

			$id = $row -> id;
			date_default_timezone_set('UTC');
	 		if(strlen($row -> uuid)>0){
		 $device_more = '<a   style=" cursor:pointer;"     href="'.site_url("user/index")."?id=".$row -> uuid.'" > <i class="fa fa-fw  fa-eye"></i>View Data </a>&nbsp;';
			if($row -> status=='ONLINE'){
		$status = '<i class="fa fa-circle text-success"></i>&nbsp;Online';	
		}else{
		$status = 	'<i class="fa fa-circle text-danger"></i>&nbsp;Offline';
		}		
		}else{
			$status = '<i class="fa fa-ban text-danger"></i>&nbsp;No device assign';
		} 
		 
			$nestedData[] = $i;
 
				 $username =	$row -> name;
				 
				if(strlen($row -> photo)>0){
				$userimage =	'upload/userimg/'.$row -> photo;
				}else{
			$userimage = 'images/user.png';
				}
				
				 
		$nestedData[] = $username.'<a onclick="delete_user('."'".$row -> id."'".')"  >'.'<span class="label label-danger pull-right"><i class="fa fa-trash"></i></span>'.'</a>';;
			$nestedData[] = '<div class="row">
 <div class="col-md-6"><img class="img-thumbnail" style="height:80px;" src="'.base_url().$userimage.'"/>
 </div>

 <div class="col-md-6">'.$username.'</div></div>
 <div class="row">
 <div class="col-md-12 ">
 '.$device_more.'  
<a href="'.site_url("cadmin/dashboard/manageUser")."?id=".$row -> id.'" style="display:none; color:green;cursor:pointer;"> <i class="fa fa-fw fa-edit"></i>Edit User </a>&nbsp;
 
 <a onclick="device_delete('."'".$row -> id."'".')" style="color:red;display:none; cursor:pointer;"><i class="fa fa-fw fa-trash"></i>Delete User</a>
 </div></div>
 ' ;
			 
			$nestedData[] = $row -> phone;
			 

	 
			 	$nestedData[] = $status;
            $data[] = $nestedData;
			$i++;
		}
		
		$json_data = array("draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
		"recordsTotal" => intval($totalData), // total number of records
		"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
		"data" => $data // total data array
		);
		//print_r($json_data);
		return $json_data;
		//echo json_encode($json_data);  // send data as json format		
	}
	function saveUserData($input_method)
	{
		$req_array = array(
			"name"=>$input_method['name'],
			"phone"=>$input_method["phone"],
			"cadmin_id"=>$input_method["cadmin_id"],
			"created_on"=>get_gmt_time()
		);
		$this->db->insert("users",$req_array);
		$user_id = $this->db->insert_id();
		if($user_id){
			return array("message"=>"User added Successfully","status"=>"1");
		} else{
			return array("message"=>FAIL,"status"=>0);
		}
		
	}
}

?>