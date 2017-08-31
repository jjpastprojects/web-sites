<?php
class Download extends CI_Controller
{

    function Download()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('download_model');        
        $this->load->library('session');
       
            $adminuser = $this->session->userdata('logged_in');
        $user = $this->session->userdata('loggin_in');
        if ((!$user)&&(!$adminuser)) {
            redirect('login/index');
        }
		if(!isset($_REQUEST['id'])){
			redirect('admin/index');
		}
		 
    }

     function download_folder()
	{
		 
		$result= $this->download_model->download_folder();
	}
	
}
?>