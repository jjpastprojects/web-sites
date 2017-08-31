<?php
class Login extends CI_Controller
{

    function Login()
    {
        parent::__construct();
         $this->load->helper(array('form', 'url','constant_helper','function_helper'));
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
          if (!$this->validate_login()) {
                $data = 0;
            } else {
                $data = 1;
            }
            echo $data;
        
        
          
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
        if ($result == false) {
            return false;
        } else {
  $loginactivity = $this->login_model->update_login($result['id']);
            $admin_session = array(
                "id" => $result['id'],
                "username" => $result['username'],
                "admin" => true,
                "logged_in" => true);
            $this->session->set_userdata($admin_session);
            return true;
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