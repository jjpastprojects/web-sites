<?php
class Event_cron extends CI_Controller
{

    function Event_cron()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
        $this->load->model('event_action_model'); 
	 
    }

    function checkLastActivity()
    {
    	 
       $res = $this->event_action_model->checkLastActivity();
          
    }
	
	
	   function deleteDeviceData()
    {
    	 
        $id = $_REQUEST['id'];	 
       $res = $this->event_action_model->deleteDeviceData($id);
          
    }
	  
}
?>