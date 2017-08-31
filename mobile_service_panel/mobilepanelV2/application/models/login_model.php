<?php
class Login_model extends CI_Model {
    
    public function __construct()
	{
		$this->load->database();
	}

	function validate_login()
    {
	   
        $password = md5($_POST['password']);
    		$this->db->select('*');
    		$this->db->where("( username ='".$_POST['username']."'   AND password ='".$password."')");
    		$query = $this->db->get('admin');
        
     
    		if ($query->num_rows() > 0){
    		   return $query->row_array();
    		}else
    			return FALSE;
        
	}
    
   
    
    function update_login($id){
    	$gmdate = get_gmt_time();
        $this->db->update('admin',array('last_login'=>$gmdate,'last_activity'=>$gmdate,),array('id'=>$id));
    }
}
?>