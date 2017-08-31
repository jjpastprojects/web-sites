<?php
class Admin_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	function get_admin() {
 $user_id = $this->session->userdata('super_admin_id');
        $this->db->where("id",$user_id);
		$query = $this -> db -> get("admin");
		//echo $this->db->last_query();exit;
		return $query -> row_array();
	}

	function save_profile($id = "0") {
		$id =  $this->session->userdata('super_admin_id');
		$this -> db -> select('*');
		$this -> db -> where("id ='" . $id . "' AND password='" . md5($_POST['password']) . "' ");
		$query = $this -> db -> get('admin');

		if ($query -> num_rows() > 0) {

			$arr_field = array("username" => $_POST['username'],"email" => $_POST['email'] );
		 
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('admin', $arr_field);

			return $query;
		}

	}
	
		function update_password($id = "0") {
		$id =  $this->session->userdata('id');
		$this -> db -> select('*');
		$this -> db -> where("id ='" . $id . "' AND password='" . md5($_POST['currentpassword']) . "' ");
		$query = $this -> db -> get('admin');

		if ($query -> num_rows() > 0) {

			$arr_field = array("password" =>  md5($_POST['newpassword'])  );
		 
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('admin', $arr_field);

			return $query;
		}

	}
	function getCompanyAdminDetail()
	{
		$requestData = $_REQUEST;
		$columns = array(
		// datatable column index  => database column name
		0 => 'id', 1 => 'name', 2 => 'username',3=>'email');

		// getting total number records without any search
		$sql = "SELECT admin.id FROM `admin` where is_deleted='0' and role = 'CADMIN' ";

		$query = $this -> db -> query($sql);
		$totalData = $query -> num_rows();
		$totalFiltered = $totalData;
		// when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT admin.* FROM `admin` where is_deleted='0'  and role = 'CADMIN' ";
		if (!empty($requestData['search']['value'])) {// if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql .= " and ( admin.name LIKE '%" . $requestData['search']['value'] . "%' ";
			$sql .= " OR admin.username LIKE '%" . $requestData['search']['value'] . "%' ";
			$sql .= " OR admin.email LIKE '%" . $requestData['search']['value'] . "%' )";
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
			$nestedData = array();
			$id = $row -> id;	
			$id1 = md5($id);	 
			$nestedData[] = $i;
			$nestedData[] =$row -> name;
			$nestedData[] = $row -> username; 
			$nestedData[] = $row -> email;
			$permissionClick = "assignPermission('$id1')";
			$editUser = "edituser('$id1')";
			$deleteUser = "deleteuser('$id1')";
			$nestedData[] = '<a onclick="'.$permissionClick.'" style="cursor:pointer;">Assign</a>';
			$nestedData[] = '<a title="Users" href="'.site_url("cadmin/subadmin/users").'?id='.$id.'" style="cursor:pointer;"><i class="fa fa-group"></i></a>&nbsp;|&nbsp;<a title="Devices" href="'.site_url("cadmin/subadmin/devices").'?id='.$id.'" style="cursor:pointer;"><i class="fa fa-mobile"></i></a>';
			$nestedData[] = '<a onclick="'.$editUser.'" style="cursor:pointer;"><i class="fa fa-edit"></i></a>&nbsp;!&nbsp;<a onclick="'.$deleteUser.'" style="cursor:pointer;"><i class="fa fa-trash"></i></a>';			  
            $data[] = $nestedData;
			$i++;		
	}
		$json_data = array("draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
		"recordsTotal" => intval($totalData), // total number of records
		"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
		"data" => $data // total data array
		);
		return $json_data;	
}

	function get_total_users(){
		$query =$this->db->get("device_info");
		return $query->num_rows();
	}
	function saveCompanyAdmin($input_method)
	{
		date_default_timezone_set("UTC");

		
				$req_adminArr = array(
				"name"=>$input_method['name'],
				"username"=>$input_method["username"],
				"email"=>$input_method["email"],
				"password"=>md5($input_method['password']),
				"role"=>"CADMIN",
				"created_on"=>get_gmt_time()
			);
			$this->db->insert("admin",$req_adminArr);
			$comp_id = $this->db->insert_id();
		if($comp_id){
	
			return array("message"=>"Company Admin Added Successfully.","status"=>"1");
		}else{
			return array("message"=>FAIL,"status"=>0);
		}
	}
	function updateComapanyAdmin($input_method)
	{
		date_default_timezone_set("UTC");
		$req_array = array(
			"name"=>$_POST['name'],
			"username"=>$_POST['username'],
			"email"=>$_POST['email'],
			"updated_on"=>get_gmt_time()
		);
		$this->db->where("id",$input_method['id']);
		$query = $this->db->update('admin',$req_array);
		if($query){
			return array("message"=>"Company Admin Update Successfully","status"=>"1");
		}else{
			return array("message"=>FAIL,"status"=>0);
		}
	}
	function deleteCompanyAdmin($id)
	{
		//print_r($id);exit;
		date_default_timezone_set("UTC");
		$rea_array = array(
			"is_deleted"=>'1',
			"updated_on"=>get_gmt_time()
		);
		$this->db->where("md5(id)",$id);
		$query= $this->db->update("admin",$rea_array);
	//	print_r($this->db->last_query());exit;
		if($query){
			return array("message"=>"Company admin deleted successfully","status"=>"1");
		}else{
			return array("message"=>FAIL,"status"=>0);
		}
	}
	function getCadminname($id)
	{
		$this->db->select("name");
		$this->db->where("md5(id)",$id);
		$query = $this->db->get('admin');
		return $query->row_array();
	}
	function getAssignedPermission($id)
	{
		// $this->db->select('permission_id');
		// $this->db->where("md5(cadmin_id)",$id);
		// $query = $this->db->get("company_admin_permission");
		$sql = "SELECT GROUP_CONCAT(permission_id) as 'perm_id' FROM company_admin_permission WHERE md5(cadmin_id)='$id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	function getPermissoion()
	{
		$this->db->select('*');
		$query = $this->db->get('permission');
		return $query->result_array();
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
	function get_CadminDetail($id)
	{
		$sql = "SELECT * from admin where md5(id)='$id'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	function Save_permission($input_method)
	{
		//print_r($input_method);exit;
		date_default_timezone_set("UTC");
		$flag = 0;
		$cadmin_detail = $this->getCadminId($input_method['id']);
		$cadmin_permission = $input_method['permision_select'];
		$this->db->select("cadmin_id");
		$this->db->where("cadmin_id",$cadmin_detail['id']);
		$query = $this->db->get('company_admin_permission');
		if($query->num_rows()>0){
			$this->db->where("cadmin_id",$cadmin_detail['id']);
			$this->db->delete("company_admin_permission");
		}
		for($i=0;$i<count($cadmin_permission);$i++)
		{
			$req_array = array(
				"cadmin_id"=>$cadmin_detail['id'],
				"permission_id"=>$cadmin_permission[$i],
				"created_on"=>get_gmt_time()
			);
			$this->db->insert('company_admin_permission',$req_array);
			$cadmin_id= $this->db->insert_id();
			if($cadmin_id)
			{
				$flag=1;
			}else{
				$flag = 0;
			}
		}
		if($flag == 1)
		{
			return array("message"=>"Company Admin Permissions Saved Successfully","status"=>"1");
		}else{
			return array("message"=>FAIL,"status"=>0);
		}
	}
	function getCadminId($id)
	{
		$this->db->select("id");
		$this->db->where("md5(id)",$id);
		$query = $this->db->get('admin');
		return $query->row_array();
	}
}
?>