<?php
class Login extends CI_Controller
{

    function Login()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->library('session');
        $this->clear_cache();
    }

    function index()
    {
          
            $this->load->view("login");
      

    }
    function intagramlogin()
    {
         $this->load->view('success');
    }
    
    

    function submit()
    {
    	  $loginDetail = $this->validate_login();	
          if ($loginDetail['status']=='1') {
                $data = array(
					"status"=>"1",
					"message"=>"Login Success",
					"role"=>$loginDetail['role'],
					"admin_dashboard"=>$loginDetail['admin_dashboard'],
					"cadmin_dashboard"=>$loginDetail['cadmin_dashboard']
				);
            } else {
                $data = array(
					"status"=>0,
					"message"=>"Login Fail"
				);
            }
            echo json_encode($data);
    }

    function success()
    {
        //echo $this->session->userdata['logged_in'];
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
            redirect('admin');
        //$this->load->view('templates/footer');
    }
    

    function validate_login()
    {

        $result = $this->login_model->validate_login();
		//print_r($result);exit;
        if ($result == false) {
            return false;
        } else {
        	if($result['role']=="ADMIN"){
            $admin_session = array(
            "super_admin_id" => $result['id'],
                "id" => 0,
                "username" => $result['username'],
                "admin" => true,
                "logged_in" => true);
            $this->session->set_userdata($admin_session);
			}
			else{
				$cadmin_session = array(
				"super_admin_id"=>0,
					"id"=>$result['id'],	
					"username"=>$result['username'],
					"admin"=>false,
					"loggin_in"=>true);
					$this->session->set_userdata($cadmin_session);
			}
			return array("status"=>"1","admin_dashboard"=>site_url("admin"),"cadmin_dashboard"=>site_url("cadmin/dashboard"),"role"=>$result['role']);
        }
    }
    
    public function is_logged_in()
    {
        $user = $this->session->userdata('logged_in');
        return $user;
    }
    function logout()
    {
        $session_data = array(
            "username" => "",
            "id" => "",
            'logged_in' => false);
        $this->session->unset_userdata($session_data);
        $this->session->sess_destroy();
        redirect(base_url());
    }

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
?>