<?php
class Admin extends CI_Controller
{

    function Admin()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','constant_helper'));
        $this->load->model('admin_model');        
        $this->load->library('session');
        $this->clear_cache();
        $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
    }

    function index()
    {
        @$pics = "";
       
      
        $data['active_page'] = 'users';
	
        $this->load->view('templates/header', $data);
        $this->load->view('details',$data);
    }
	 

	function get_details_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_details_dt();
		echo json_encode($user); 
	}
	
    function information()
    {
    	$information='';
    	 if ($this->uri->segment(3) === false) {
            $id = 0;
        } else {
            $id = $this->uri->segment(3);
           $information = $this->admin_model->get_information($id);
          $user_info = $this->admin_model->get_user_info($id);
        }
      
        $data['active_page'] = 'user';
        $data['information'] = $information;
		$data['user_info'] = $user_info;
        $this->load->view('templates/header', $data);
        $this->load->view('information');
    }
	    function testinformation()
    {
    	$information='';
    	 if ($this->uri->segment(3) === false) {
            $id = 0;
        } else {
            $id = $this->uri->segment(3);
           $information = $this->admin_model->get_information($id);
          $user_info = $this->admin_model->get_user_info($id);
        }
      
        $data['active_page'] = 'user';
        $data['information'] = $information;
		$data['user_info'] = $user_info;
       
        $this->load->view('mailview',$data);
    }
	function get_all_user_dt()
	{
		$user = $this->admin_model->get_all_user_dt();
		echo json_encode($user); 
	}
	function group_pics()
    {
    	@$pics = "";
        if ($this->uri->segment(3) === false) {
            $group = 0;
        } else {
            $group = $this->uri->segment(3);
            $group_detail = $this->admin_model->group_type($group);
            
        }
        
        $data['active_page'] = 'pics';
		$data['group']=$group;
		$data['group_detail']=$group_detail;
        $data['user'] = $pics;
        $this->load->view('templates/header', $data);
        $this->load->view('group_pics');
    }
	function get_all_group_pic_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_all_group_pic_dt($group);
		echo json_encode($user); 
	}
	function view_comment()
    {
    	@$pics = "";
        if ($this->uri->segment(3) === false) {
            $group = 0;
        } else {
            $image = $this->uri->segment(3);
           $image_detail = $this->admin_model->image_detail($image);
            
        }
        
        $data['active_page'] = 'pics';
		$data['image']=$image;
		$data['image_detail']=$image_detail;
        $data['user'] = $pics;
        $this->load->view('templates/header', $data);
        $this->load->view('photo_comment');
    }
	function get_all_comment_pic_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_all_pic_comment_dt($group);
		echo json_encode($user); 
	}
	function user_like()
    {
    	@$pics = "";
        if ($this->uri->segment(3) === false) {
            $group = 0;
        } else {
            $image = $this->uri->segment(3);
           $image_detail = $this->admin_model->image_detail($image);
            
        }
        
        $data['active_page'] = 'pics';
		$data['image']=$image;
		$data['image_detail']=$image_detail;
        $data['user'] = $pics;
        $this->load->view('templates/header', $data);
        $this->load->view('user_like');
    }
	function get_all_userlike_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_all_userlike_dt($group);
		echo json_encode($user); 
	}
	function view_follower()
    {
    	@$user = "";
        if ($this->uri->segment(3) === false) {
            $group = 0;
        } else {
            $user = $this->uri->segment(3);
           $user_detail = $this->admin_model->user_detail($user);
            
        }
        
        $data['active_page'] = 'pics';
		$data['user']=$user;
		$data['user_detail']=$user_detail;
      
        $this->load->view('templates/header', $data);
        $this->load->view('users_follower');
    }
	function get_all_follower_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_all_follower_dt($group);
		echo json_encode($user); 
	}
	function view_follow()
    {
    	@$user = "";
        if ($this->uri->segment(3) === false) {
            $group = 0;
        } else {
            $user = $this->uri->segment(3);
           $user_detail = $this->admin_model->user_detail($user);
            
        }
        
        $data['active_page'] = 'pics';
		$data['user']=$user;
		$data['user_detail']=$user_detail;
      
        $this->load->view('templates/header', $data);
        $this->load->view('users_follow');
    }
	function get_all_follow_dt()
	{
		$group = $this->uri->segment(3);
		$user = $this->admin_model->get_all_follow_dt($group);
		echo json_encode($user); 
	}
	
     function finishing()
    {
        $finishing = $this->admin_model->get_finishing();
        $data['active_page'] = 'finishing';
        $data['finishing'] = $finishing;
        $this->load->view('templates/header', $data);
        $this->load->view('finishing');
    }
    function get_dept_employee()
    {
        $id = $_POST['department'];
        $sales = $this->admin_model->get_dept_employee();
         $depatment_name = $this->admin_model->department($id);
            $data['active_page'] = 'department_employee';
        $data['sales'] = $sales;
        $data['department_name'] = $depatment_name;
        $this->load->view('templates/header', $data);
        $this->load->view('employeelist');
    }
    function add_group()
    {
        @$group = "";
        if ($this->uri->segment(3) === false) {
            $id = 0;
        } else {
            $id = $this->uri->segment(3);
            $group = $this->admin_model->group_type($id);
            
        }
        
        $data['group']= $group;
 
           $data['active_page'] = 'add_group';
        $this->load->view('templates/header', $data);
        $this->load->view('add_group');
    }
	 function edit_user()
    {
        @$group = "";
        if ($this->uri->segment(3) === false) {
            $id = 0;
        } else {
            $id = $this->uri->segment(3);
            $point = $this->admin_model->edit_user($id);
            
        }
        
        $data['point']= $point;
 
           $data['active_page'] = 'user';
        $this->load->view('templates/header', $data);
        $this->load->view('edit_user');
    }

    function add_employee()
    {
        @$employee = "";
        if ($this->uri->segment(3) === false) {
            $id = 0;
        } else {
            $id = $this->uri->segment(3);
            $employee = $this->admin_model->get_employee($id);
        }
        $department = $this->admin_model->temp_department();
        $data['department']= $department;
       $data['employee']= $employee;
        $data['active_page'] = 'add_employee';
        $this->load->view('templates/header', $data);
        $this->load->view('employee');
    }
	  function send_notification()
    {
       
        $data['active_page'] = 'send_notification';
        $this->load->view('templates/header', $data);
        $this->load->view('notification');
    }
	function submitNotification()
	{
		echo 1;
	}

    function save_employee()
    {
        $id = $_POST['id'];
        $res = $this->admin_model->employee_save($id);
        if ($res) {
           $data = array("IsValid" => 1);
        } else {
            // set the message that show the data is not save;
           $data = array("IsValid" => 0);
        }
              echo json_encode($data);
    }


    function remove_group_image()
    {
        $id = $_POST['id'];
		$image = $_POST['image'];
        $res = $rcp = $this->admin_model->delete_group_image($id,$image);
        echo $res;

    }
	function remove_pic_comment()
	{
		$id = $_POST['id'];
		
        $res = $rcp = $this->admin_model->remove_pic_comment($id);
        echo $res;
	}
	function remove_pic_like()
	{
		$id = $_POST['id'];
		
        $res = $rcp = $this->admin_model->remove_pic_like($id);
        echo $res;
	}
    function remove_group()
    {
        $id = $_POST['id'];
        $res = $rcp = $this->admin_model->delete_group($id);
        echo $res;

    }
	function remove_user_and_data()
    {
        $id = $_POST['id'];
        $res = $rcp = $this->admin_model->remove_user_and_data($id);
        echo $res;

    }
     function save_group()
    {
        $id = $_POST['id'];
        $res = $this->admin_model->group_save($id);
        if ($res) {
           redirect('admin/index');
        } else {
            // set the message that show the data is not save;
          redirect('admin/index');
        }
              
    }
	 function save_user()
    {
        $id = $_POST['id'];
        $res = $this->admin_model->user_save($id);
        if ($res) {
           redirect('admin/all_users');
        } else {
            // set the message that show the data is not save;
          redirect('admin/all_users');
        }
              
    }
    
    function changepassword()
    {
        @$admin[0]->username = $admin[0]->email = $admin[0]->password = "";

        $admin = $this->admin_model->get_admin();
        $data['admin'] = $admin;
        $data['active_page'] = 'admin';
        $this->load->view('templates/header', $data);
        $this->load->view('editprofile');

    }
    function update_profile()
    {
        $admin = $this->admin_model->save_profile();
        if ($admin) {

            $data = array("IsValid" => 1);
        } else {
            $data = array("IsValid" => 0);
        }
        echo json_encode($data);

    }
    
    

    function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
}
?>