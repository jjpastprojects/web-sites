<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url', 'notification_helper'));
		$this -> load -> model('notification_model');
		$this -> load -> library(array('session'));

		$user = $this -> session -> userdata('logged_in');
		if (!$user) {
			redirect('login/index');
		}

	}

	public function index() {

		$this -> load -> view('site-nav/header', TRUE);
		$this -> load -> view('send_notification');
		$this -> load -> view('site-nav/footer');
	}
    
	 
	/*send push notification function */
	
	
    function push_notify() {

		$uuid = $_POST['id'];
		$message_text = $_POST['message'];
		$device_tokens_i = array();
		$registration = $otherdata = array();
	 
		 
			$device = $this -> notification_model -> fetch_device_selecteduser($uuid);
 
			 

				

				foreach ($device as $device_tokens) {
					$registration[] = $device_tokens['device_token'];

				}
				try {
				//print_r($registration);
				send_andorid_push($message_text, $registration,$otherdata);
				} catch (Exception $e) {
  //alert the user.
// var_dump($e->getMessage());
}
			 
			echo 1;
	 
		
		/*
		else if ($device_type == 'SPECIFIC') {

			$usersids = implode(",", $_POST['selected_users']);
			/////
			$device = $this -> notification_model -> fetch_device_selecteduser($usersids);

			foreach ($device as $device_tokens) {
				if ($device_tokens['device_type'] == 'A') {
					$registration[] = $device_tokens['device_token'];
					send_andorid_push($message_text, $registration);
				} else if ($device_tokens['device_type'] == 'I') {
					$registration[] = $device_tokens['device_token'];
					send_push($registration, $message_text);
				}
				$registration = array();

			}

			echo 1;

			///
		}
		

		$device = $this -> notification_model -> fetch_device($device_type);

		$device_typ = $device[0]['device_type'];

		if ($device_typ == 'A') {
			foreach ($device as $device_tokens) {
				$registration[] = $device_tokens['device_token'];

			}
			send_andorid_push($message_text, $registration);
			echo 1;
		} elseif ($device_typ == 'I') {

			foreach ($device as $device_tokens) {
				$device_tokens_i[] = $device_tokens['device_token'];

			}
			send_push($device_tokens_i, $message_text);
			echo 1;
		}*/
	}

}
