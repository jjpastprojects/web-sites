<?php
class Event_action_cron extends CI_Controller
{

    function Event_action_cron()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('event_action_model'); 
		   $this->load->library('session');
		 $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
    }

  
	
	
	   function deleteDeviceData()
    {
    	 
        $id = $_REQUEST['id'];	 
       $res = $this->event_action_model->deleteDeviceData($id);
          
    }
	  
}
?>