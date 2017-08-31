<?php
/**
 * 
 */
class permissiondashboard_model extends CI_Model {
	
	function __construct() {
		$this->load->database();
	}
	function get_permissions($id){
		$sql = "SELECT GROUP_CONCAT(permission_id) as 'perm_id' FROM company_admin_permission WHERE cadmin_id='$id'";
		$query=$this->db->query($sql);
		$data= $query->row_array();
		$data = explode(",", $data['perm_id']);
		return $data;		
	}
	function saveCustomeAvater($input_method)
	{
		$req_array = array(
			"photo"=>$input_method['cuetom_avater']
		);
		$this->db->where("id",$input_method['id']);
		$query=$this->db->update("users",$req_array);
		if($query){
			return array("message"=>"Avater Saved Successfully","status"=>"1");
		}else{
			return array("message"=>FAIL,"status"=>0);
		}	
	}
}

?>