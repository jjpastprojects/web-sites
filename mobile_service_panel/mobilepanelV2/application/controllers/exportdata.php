<?php
class Exportdata extends CI_Controller
{

    function Exportdata()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('export_model');        
        $this->load->library('session');
       
        $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
		 
    }

     function export_modules()
	{
		 
		$result= $this->export_model->export_modules();
	}
	
}
?>