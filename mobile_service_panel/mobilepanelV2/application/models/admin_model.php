<?php
class Admin_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	function get_admin() {

		$query = $this -> db -> get("admin");
		//echo $this->db->last_query();exit;
		return $query -> row_array();
	}
	function get_ocr()
	{
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
		}else{
			$id=0;
		}
		$this->db->where("id",$id);
		$query = $this -> db -> get("ocr_apps");
		return $query -> row_array();
	}

	function save_profile($id = "0") {
$id =  $this->session->userdata('id');
		$this -> db -> select('*');
		$this -> db -> where("id ='" . $id . "' AND password='" . md5($_POST['password']) . "' ");
		$query = $this -> db -> get('admin');

		if ($query -> num_rows() > 0) {

			$arr_field = array("username" => $_POST['username'], "password" => md5($_POST['newpassword']));
		 
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('admin', $arr_field);

			return $query;
		}

	}
	
		function save_user($filename=0) {
			 
			 
$id =  $_POST['id'];
		 
		$this -> db -> where("id",$id);
		$query = $this -> db -> get('device_info');

		if ($query -> num_rows() > 0) {
$datetime = get_gmt_time();
if($filename==0){
			$arr_field = array("device_name" => $_POST['username'], "updatedon" =>$datetime);
}else{
	$arr_field = array("device_name" => $_POST['username'], "updatedon" =>$datetime,"image" => $filename);
}
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('device_info', $arr_field);

			return $query;
		}
		return false;

}
		function device_delete()
	{
		 
		$datetime = get_gmt_time();
		$id = $_REQUEST['id'];
		$this->db->where("id",$id);
		$arr_field = array("is_delete" =>1, "updatedon" => $datetime);
return	$query =	$this->db->update("device_info",$arr_field);
	}
	function ocr_submit() {
 $id = $_POST['id'];
		$this -> db -> where("id",$id);
		$query = $this -> db -> get('ocr_apps');
$arr_field = array("package_name" => $_POST['package_name'], "app_name" =>  $_POST['app_name']
			, "is_track" =>  $_POST['track'] );
		if ($query -> num_rows() > 0) {

			
		 
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('ocr_apps', $arr_field);

			return $query;
		}else{
			$query = $this -> db -> insert('ocr_apps', $arr_field);
			return $query;
		}

	}
	
	function toggleStatus($id){
	$query=$this->db->query(" update ocr_apps set is_track=1-is_track where id='$id'");
	 $this->db->where('id',$id);
        $userqry = $this->db->get("ocr_apps");
		$row =$userqry->row();
	return $row->is_track;
}
	function get_a_user()
	{
		$id=$_REQUEST['id'];
		$this->db->where("id",$id);
	$query	= $this->db->get("device_info");
	return $query->row_array();
	}
	function delete_ocrapp()
	{
		$id = $_POST['id'];
		$this -> db -> where('id', $id);
			$query = $this -> db -> delete('ocr_apps');
			return $query;
	}
	function get_total_users()
	{
		$this -> db -> where('is_delete', '0');
		$query =$this->db->get("device_info");
		return $query->num_rows();
	}
 

}
?>