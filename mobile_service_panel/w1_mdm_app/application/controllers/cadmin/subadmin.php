<?php

class Subadmin extends CI_Controller
{

    function Subadmin()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('cadmin/dashboard_model');        
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('admin');
		if(isset($_GET['id'])){
			$this->session->set_userdata('id', $_GET['id']);
			
		}
        if (!$user) {
            redirect('login/login');
        }
    }
	function index()
	{
		$data['active_page']="index";
		$id= $this->session->userdata("id");
		$response['device_count'] = $this->dashboard_model->get_device_count($id);
		//print_r($response);exit;
		$this->load->view('header', $data);
        $this->load->view('cadmin/dashboard.php',$response);
	}
	 function devices()
	 {
	 	$data['active_page'] = 'devices';
	 	 $this->load->view('header', $data);
        $this->load->view('pages/adminusers',$data);
	 }
	function editprofile()
	{
		$data['active_page']="cadmin_dashboard";
		$id=$this->session->userdata("id");
		$response["cadmin"]=$this-> dashboard_model ->getCadminDetail($id);
		$response["cadmin_image"]=$this-> dashboard_model ->getCadminimage($id);
		$this->load->view('header', $data);		
		$this->load->view("cadmin/editprofile.php",$response);
	}
	function update_profile()
	{
		//$id = $_POST['id'];
		//print_r($_POST);
		//print_r($_FILES);exit;
		
		$fileupload = $data = 0;
		if(isset($_FILES['image'])){
		if(strlen($_FILES["image"]['name'])>0){
		 
    	$fileupload = $this->upload_image();
		}else{
			$fileupload = 0;
		}
		}else{
			$fileupload = 0;
		}
		if($fileupload===2){
			$data = 2; 
		}else{
	 
		
		$response = $this->dashboard_model->updateProfile($fileupload);
		
		}
		echo  $response;
	}
	function checkUsername()
	{
		$response = $this->dashboard_model->checkUsername($_POST);
		if($response==TRUE)
		{
			$responseArr = array("message"=>"Username is already exists.","status"=>"1");
			echo json_encode($responseArr);
		}
	}
	function checkemail()
	{
		$response = $this->dashboard_model->checkEmail($_POST);
		if($response==TRUE)
		{
			$responseArr = array("message"=>"Email is already exists.","status"=>"1");
			echo json_encode($responseArr);
		}		
	}
	function users()
	{
		$data['active_page']="users";
		$id=$this->session->userdata("id");
		$response['permission'] =$this->dashboard_model->get_permission($id);
		$this->load->view('header', $data);		
		$this->load->view("cadmin/subadminuser_list.php",$response);
	}
	function get_user_list()
	{
		$id= $this->session->userdata("id");
		$response = $this->dashboard_model->getUserList($id);
		echo json_encode($response);
	}
	function manageUser()
	{
		$data['active_page']="add_user";
		
		if(isset($_REQUEST['id'])){
			
		}
		
		$this->load->view('header', $data);
		$this->load->view("cadmin/add_user.php");		
		
	}
		 function device_delete()
    {
        $admin = $this->dashboard_model->device_delete();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
	
	   function deleteDeviceData()
    {
    	 
        $id = $_REQUEST['id'];	 
       $res = $this->dashboard_model->deleteDeviceData($id);
          
    }
	function saveUser(){
		$_POST['cadmin_id'] = $this->session->userdata("id");
		$response = $this->dashboard_model->saveUserData($_POST);
		echo json_encode($response);
	}

    	public function upload_image()
    {
        $fileupload="image";
        $source="user";
          $orig_name=$_FILES[$fileupload]['name'];
        $FileName			= strtolower($_FILES[$fileupload]['name']); //uploaded file name
    	$FileTitle			= uniqid(); // file title
    	$ext			    = pathinfo($FileName, PATHINFO_EXTENSION);
    	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
    	$NewFileName        = $FileTitle.'_'.$RandNumber.'.'.$ext;
        
        if($source=='user'){
            $config['upload_path'] = './profile_photo/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
        }
        
        
        $this->load->library('upload', $config);
        
        $error_flag=0;
         
        $config['file_name']=$NewFileName;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($fileupload))
		{
            $error_flag=1;
            $response=array('upload_flag'=>0,"message"=>$this->upload->display_errors());
			return 2;
           // echo json_encode($response);
           /// exit;
            //echo "<pre>";
            //print_R($error);
		}
		else
		{
			$data=$this->upload->data();
           
            
		}
         
        if($error_flag){
            $response['upload_flag']=0;
            //echo json_encode($response);
           // exit;
           return 2;
        }
        else{
            $response=array('upload_flag'=>1,"image_name"=>$NewFileName,"orig_name"=>$orig_name);
           // echo json_encode($response);
            //exit;
            return $NewFileName;
        }
    }

	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}

?>