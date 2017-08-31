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
        $user = $this->session->userdata('logged_in');
        if (!$user) {
    redirect('login/index');
        }
		
		updateActivity();
    }

    function index()
    {
        $usercount = $this->admin_model->get_total_users();
      $data['usercount'] = $usercount;
        $data['active_page'] = 'index';
	
       $this->load->view('header', $data);
        $this->load->view('index',$data);
    }
	
	function ocr_applist()
	{
		   $usercount = $this->admin_model->get_total_users();
      $data['usercount'] = $usercount;
        $data['active_page'] = 'ocr';
	
       $this->load->view('header', $data);
        $this->load->view('pages/ocr_applist',$data);
	}
	
	 function device_delete()
    {
        $admin = $this->admin_model->device_delete();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
	 function users()
	 {
	 	$data['active_page'] = 'users';
	 	 $this->load->view('header', $data);
        $this->load->view('pages/users',$data);
	 }
   function manage_ocrapp()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password = "";

        $ocrdata = $this->admin_model->get_ocr();
        $data['ocrdata'] = $ocrdata;
        $data['active_page'] = 'ocr';
        $this->load->view('header', $data);
        $this->load->view('pages/manage_ocrapp');

    }
    
    function editprofile()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password = "";

        $admin = $this->admin_model->get_admin();
        $data['admin'] = $admin;
        $data['active_page'] = 'admin';
        $this->load->view('header', $data);
        $this->load->view('pages/editprofile');

    }
	function edituser()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password = "";

        $admin = $this->admin_model->get_a_user();
        $data['admin'] = $admin;
        $data['active_page'] = 'users';
        $this->load->view('header', $data);
        $this->load->view('pages/edituser');

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
	function update_user()
    {
    	$data = 0;
		if(strlen($_FILES["image"]['name'])>0){
		 
    	$fileupload = $this->upload_image();
		}else{
			$fileupload = 0;
		}
		if($fileupload===2){
			$data = 2; 
		}else{
        $admin = $this->admin_model->save_user($fileupload);
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
		}
        echo  $data ;

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
            $config['upload_path'] = './upload/userimg/';
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
	
     function ocr_submit()
    {
        $admin = $this->admin_model->ocr_submit();
        if ($admin) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;

    }
    function delete_ocrapp()
	{
		$res = $this->admin_model->delete_ocrapp();
        if ($res) {

            $data = 1;
        } else {
            $data = 0;
        }
        echo  $data ;
	}
    
	
	function toggleStatus()
	{
		$id = $this->uri->segment(3);
		
        $res = $this->admin_model->toggleStatus($id);
        echo $res;
	}
	
	
     function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
?>