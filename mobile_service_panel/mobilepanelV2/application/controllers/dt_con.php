<?php
class Dt_con extends CI_Controller
{

    function Dt_con()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('dt_model');        
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
    }

    function get_userlist_dt()
    {
         
		$user = $this->dt_model->get_userlist_dt();
		echo json_encode($user); 
    }
	
	function get_applist_dt()
    {
         
		$user = $this->dt_model->get_applist_dt();
		echo json_encode($user); 
    }
	function get_file_exp_dt()
	{
		$user = $this->dt_model->get_file_exp_dt();
		echo json_encode($user); 
	}
	function get_recording_dt()
	{
		$user = $this->dt_model->get_recording_dt();
		echo json_encode($user); 
	}
	
	function get_microphone_dt()
	{
		$user = $this->dt_model->get_microphone_dt();
		echo json_encode($user); 
	}
	
		function get_ocr_file_dt()
	{
		$user = $this->dt_model->get_ocr_file_dt();
		echo json_encode($user); 
	}
	  function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    } 
	  
}
?>