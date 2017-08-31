<?php
/**
 * 
 */
class permissionDashboard extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('cadmin/permissiondashboard_model');        
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('admin');
        if ($user) {
            redirect('login/login');
        }			
	}
	
	function index()
	{
		$data['active_page'] = "welcome";
		if(isset($_GET['id'])){
			$user_id = $_GET['id'];
		}
		$id= $this->session->userdata("id");
		$data["permissions"] = $this->permissiondashboard_model->get_permissions($id);
		if(isset($_GET['id'])){
			$data['user_id'] = $user_id;
		}
		$this->load->view('header2.php',$data);
		$this->load->view('cadmin/welcome.php');
	}
	function set_custom_avater()
	{
		$data['active_page'] = "welcome";
		$id= $this->session->userdata("id");
		$user_id = $_GET['user_id'];
		$data["permissions"] = $this->permissiondashboard_model->get_permissions($id);
		$data['user_id']=$user_id;
		
		$this->load->view('header2.php',$data);
		$this->load->view('cadmin/set_custom_avater.php');
	}
	function save_custom_avater()
	{
		//print_r($_FILES);
		//print_r($_POST);exit;
		$path = UPLOAD_PATH	;
		$file_name = uniqid();
		if ($_FILES['cuetom_avater']['error']==0) {
				$responeses = FileUpload('cuetom_avater', $file_name, $path);
		if ($responeses['status'] == 1) {
			$_POST['cuetom_avater'] = $responeses['file_name'];
		} else {
			echo json_encode(array('status' => "0", 'message' => $responeses['message']));
		}
		}else{
			$_POST['cuetom_avater'] = $_POST['image'];	
		}
		 $response= $this->permissiondashboard_model->saveCustomeAvater($_POST);
		 echo json_encode($response);
	}
	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }	
}
