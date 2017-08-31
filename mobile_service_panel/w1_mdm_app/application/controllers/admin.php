<?php
class Admin extends CI_Controller
{

    function Admin()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('admin_model');        
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('admin');
        if (!$user) {
            redirect('login/index');
        }
    }	
    function index()
    {
       // $usercount = $this->admin_model->get_total_users();
      	//$data['usercount'] = $usercount;
        $data['active_page'] = 'index';
       	$this->load->view('header', $data);
        $this->load->view('index',$data);
    }
	 function users()
	 {
	 	$data['active_page'] = 'users';
	 	 $this->load->view('header', $data);
        $this->load->view('pages/users',$data);
	 }
    function editprofile()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password =  "";

        $admin = $this->admin_model->get_admin();
        $data['admin'] = $admin;
        $data['active_page'] = 'admin';
        $this->load->view('header', $data);
        $this->load->view('pages/editprofile');
    }
    function update_profile()
    {
        $admin = $this->admin_model->save_profile();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;
    }
	   function update_password()
    {
        $admin = $this->admin_model->update_password();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;
    }
	function get_company_admin_detail()
	{
		$reponse=$this->admin_model->getCompanyAdminDetail();
		echo json_encode($reponse);
	}
	function Add_Company_Admin()
	{
		$data['active_page'] = 'admin';
		$this->load->view('header',$data);
		$this->load->view('add_company_admin');
	}
	function addCompantAdmin()
	{
		//print_r($_POST);exit;
		$id= $_POST['id'];
		if(!$id)
		{
			$response = $this->admin_model->saveCompanyAdmin($_POST);
			echo json_encode($response);
		}else{
			$response = $this->admin_model->updateComapanyAdmin($_POST);
			echo json_encode($response);
		}
	}
	function DeleteUser()
	{
		$id= $this->uri->segment(3);
		$response = $this->admin_model->deleteCompanyAdmin($id);
		if($response['status']==1){
			echo '1';
		}else{
			echo '0';
		}
		
	}
	
	function checkUsername()
	{
		$response = $this->admin_model->checkUsername($_POST);
		if($response==TRUE)
		{
			$responseArr = array("message"=>"Username is already exists.","status"=>"1");
			echo json_encode($responseArr);
		}
	}
	function checkemail()
	{
		$response = $this->admin_model->checkEmail($_POST);
		if($response==TRUE)
		{
			$responseArr = array("message"=>"Email is already exists.","status"=>"1");
			echo json_encode($responseArr);
		}		
	}
	function EditCompanyUser()
	{
		$data['active_page'] = 'admin';
		$id = $this->uri->segment(3);
		$Cadmin['cadmin']=$this->admin_model->get_CadminDetail($id);
		$this->load->view('header',$data);
		$this->load->view('add_company_admin',$Cadmin);
	}
	function ShowPermission()
	{
		$id = $this->uri->segment(3);
		$permissionData['id']=$id;
		$permissionData['cname']=$this->admin_model->getCadminname($id);
		$permissionData1=$this->admin_model->getAssignedPermission($id);
		$permissionData['assign_permission'] = explode(",",$permissionData1['perm_id']);
		$permissionData['permissions']=$this->admin_model->getPermissoion();
		//echo "<pre>";
		//print_r($permissionData);exit;
		$data['active_page'] = 'admin';
		$this->load->view('header',$data);
		$this->load->view('assign_permission',$permissionData);
				
	}
	function addCompantAdminPermission()
	{
		$response = $this->admin_model->Save_permission($_POST);
		echo json_encode($response);
	}
    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
?>