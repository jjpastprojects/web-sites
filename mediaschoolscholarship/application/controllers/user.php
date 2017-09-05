<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//user level : admin,leader, agent : 1, leader : 2, admin : 3

class User extends CI_Controller
{
    
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');
		
		$this->load->config('tank_auth', TRUE);
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
                $this->load->model('tank_auth/users');
            
                
                $action=$this->uri->segment(2, 0);
                 
                if (($action==="webformregister") || ($action==="agentregister") || ($action==="update_user") || ($action==="update_goal") || ($action==="report")){
                  
                }
                else{                    
                      if (!$this->tank_auth->is_logged_in())
                    {
                        
                        redirect('/auth/login/');
                    }  
                }
		
		
	}

	function _remap($method) {
               $action=$this->uri->segment(2, 0);
                 
                if (($action==="webformregister") || ($action==="agentregister") || ($action==="update_user") || ($action==="update_goal") || ($action==="report")){
                  $this->{$method}();
                }
                else{
                    $this->load->view('header_v');
		$this->{$method}();
		$this->load->view('footer_v');
                }
		
	}
        

        function report()
	{
           header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=score.csv");
        
        ini_set('auto_detect_line_endings', TRUE);

            $agents=$this->users->list_agents(AGENT,null);
              $leader_list=$this->users->list_leaders();
                foreach($leader_list as $leader ){
                    $leaders[$leader->id]=$leader;
                    
                }
		
           $output = fopen('php://output', 'w');
            fputcsv($output, array(
                "Agent","Email","Score","Active","Leader","Password"
            ));
            foreach ($agents as $agent) {
                $status="No";
                if ($agent->status==ENABLED)
                    $status="Yes";
                    
                $row= array(
                    "name"=>$agent->name,
                    "email"=>$agent->email,
                    "score"=>$agent->score,
                    "status"=>$status,
                    "leaders"=>$leaders[$agent->leader_id]->name,
                    "password"=>$agent->password,
                );
                
                fputcsv($output, $row);
            }
          
	}
        
	function index()
	{
            $id=$this->session->userdata('user_id');
           
            $user= $this->users->get_specific_data($id, "users");
            $data['user'] = $user;
                    
            /*
             * user level : agent : 1, leader : 2, admin : 3
             */
            $data['totalscore']=$this->users->get_score(null);
            $data['goal']=$this->users->get_goal();
            
             if ($this->session->userdata('level')==AGENT){ //
                 //$this->load->view('user/agent',$data);	
                 $data['leader'] = $this->users->get_specific_data($data['user']['leader_id'], "users");
                 
                 $score=$this->users->get_score($id);
                 
                 $data['score']=$score;
                 $this->load->view('user/agent',$data);	
             }
             else{
              
                 $i=0;
                 
                 if ($this->session->userdata('level')==LEADER){ //
                     $data['pendingagents']=$this->users->list_pending_users(AGENT,$user['id']) ; 
                    $data['teamscore']=$this->users->get_teamscore($user['id']);
                    $data['agentcnt']=$this->users->get_agent_cnt($user['id']); //use leader's id
                    $data['agents']=$this->users->list_agents(AGENT,$user['id']);
                   
                 }
                 else{
                     $data['pendingagents']=$this->users->list_pending_users(AGENT,null) ; 
                     $data['agents']=$this->users->list_agents(AGENT,null);
                     $leaders=$this->users->list_leaders();
                     foreach($leaders as $leader ){
                         $data['leaders'][$leader->id]['score']=$this->users->get_teamscore($leader->id); // 2 leaders
                         $data['leaders'][$leader->id]['obj']=$leader;
                     }
                
                 }
                 
                 $i=0;
                 
                 
                 foreach ($data['agents'] as $ele){
                     
                     $leader= $this->users->get_specific_data($ele->leader_id, "users");                     
                     $data['agentleaders'][$i]=$leader['name'];
                     
                     $i++;
                 }
                 
                 
                 $this->load->view('user/leader_admin',$data);	
             }
		
	}
		
	function user_edit() {		
		$post_id = $this->uri->segment(3, 0);
		if (empty($post_id)) {
			echo "select task!";
			return;
		}
		
		$data = $this->_proc_post_edit($post_id);
		$data['post_key'] = "user";	
		$data['post'] = $this->users->get_specific_data($post_id, "users");
		$this->load->view('user/user_edit_v', $data);
	}
        
        function webformregister() {
            
            if (!isset($_REQUEST['agentid']) || !isset($_REQUEST['name']) || !isset($_REQUEST['email']) || !isset($_REQUEST['phone']) || !isset($_REQUEST['agentid']) ) {
                echo "Please type corret information.";
                return;
            }
               $agent_id=$_REQUEST['agentid'];
            // check whether duplicate
            if (!is_null($user = $this->users->check_webform_by_email($_REQUEST['email']))) {	// login ok without password check
                echo "You already submitted a form.";
                return;
            }
            
         
            //check agent id                        
            if (is_null($agent = $this->users->get_user_by_id($agent_id))) {	// 
                echo "Wrong agent id.";
                return;
            }
            
           
             if ($agent->status==DISABLED) {	// 
                echo "This agent is disabled.";
                return;
            }
            
            if ($agent->status==PENDING) {	// 
                echo "This agent is pending.";
                return;
            }
            
            $data['agent_id']=$_REQUEST['agentid'];
            $data['name']=$_REQUEST['name'];
            $data['email']=$_REQUEST['email'];
            $data['phone']=$_REQUEST['phone'];
            $data['address']=$_REQUEST['address'];            
            
            //create one form in webforms table
            if (is_null($res = $this->users->create_webform($data))) {
                 echo "error";
                 return;
            }
            if (false==$this->users->increase_score($agent_id)){
                echo "error";
                return;
            }
            echo "Success";
            
	}
        
          function update_goal() {
            
            if (!isset($_REQUEST['goal'])) {
                 
                echo ('Specify the Goal');
                return;
            }
            $goal=$_REQUEST['goal'];
            
            //if it is first login update it no_first_login
            if (false==$this->users->update_goal($goal)){
                
                echo 'fail';
                
                return;
            }
             
             echo ('success');
	}
        
         function update_user() {		
             
            if (!isset($_REQUEST['id']) || !isset($_REQUEST['status']) || !isset($_REQUEST['approved'])  ) {
                echo "Please type corret information";                
                return;
            }
            
            $id=$_REQUEST['id'];
            $status=$_REQUEST['status'];
            $approved=$_REQUEST['approved'];
            // check whether duplicate
            if (is_null($user = $this->users->get_user_by_id($_REQUEST['id']))) {	// login ok without password check
                echo "Agent does not exists";                
                return;
            }
            
            
             if ($status==PENDING){
                 $data=array(
                 'status' =>$status,
                 'approved' => $approved,                 
                );
             }
             else{
                 $data=array(
                 'status' =>$status,
                 'approved' => $approved,                 
                );
             }
             
            //if it is first login update it no_first_login
            if (false==$this->users->update_user_by_arr($id, $data)){
                
                echo ('fail');
                return;
            }
                 
            echo ('success');
            return;
	}
        
         function agentregister() {	
             
            if ( !isset($_REQUEST['name']) || !isset($_REQUEST['email']) || !isset($_REQUEST['phone']) || !isset($_REQUEST['address']) 
                    || !isset($_REQUEST['leader_id'])) {
                echo "Please type corret information.";
                return;
            }
            
            $data['leader_id']=$_REQUEST['leader_id'];
            $data['name']=$_REQUEST['name'];
            $data['email']=$_REQUEST['email'];
            $data['phone']=$_REQUEST['phone'];
            $data['address']=$_REQUEST['address'];
            $data['status']=DISABLED;
            $data['level']=AGENT;
            $data['approved']=PENDING;
            $rand= random_string('alnum',8);
            $data['password'] =$rand;
            
            // check whether duplicate
            if (!is_null($user = $this->users->get_user_by_email($_REQUEST['email']))) {	// login ok without password check
                echo "This email address is already registered.";
                return;
            }
            
            // get leader
            if (is_null($leader = $this->users->get_user_by_id($data['leader_id']))) {	// login ok without password check
                echo "Leader does not exist.";
                return;
            }
            
            // get leader
            if (is_null($admin = $this->users->get_user_by_id(1))) {	// login ok without password check
                echo "Leader does not exist.";
                return;
            }
            
            if (!is_null($res = $this->users->create_user($data))) {
      
                $link=WEBFORMURL."?agentid=".$res['id'];
                $upatedata=array(
                  'link'   => $link
                );
                
                if (false==$this->users->update_user_by_arr($res['id'], $upatedata)){
                    
                    echo 'fail';
                    return;
                }
                
                //send mail to leader
                $subject = 'New Agent added'; // 
                $message ='New agent name of ' . $data['name'] . " added to you. ";		
                $headers = "From: No-Reply \r\n" .                         
                        'Content-Type: text/html; charset=UTF-8'.
                        "Cc: ".$admin->email . "\r\n";;

                mail($leader->email, $subject, $message, $headers);

                echo "Success";
            }
            
                 
	}
		
	 function user_add() {
            $data = $this->_proc_post_add();
            $data['post_key'] = "user";
            $this->load->view('user/user_add_v', $data);
	}
        
	private function &_proc_post_add() {
		$this->load->library('upload');
		
		$this->form_validation->set_rules('femail', 'Email', 'trim|required|valid_email|xss_clean');                
		$this->form_validation->set_rules('fpassword', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fconfirm', 'Confirm', 'trim|required|xss_clean');
		
		$qry = array();
		$data = array();
		
		if ($this->form_validation->run())
		{
			if( !$this->users->confrim_email($this->input->post('femail')) )
			{
				$data['show_errors'] = $this->config->item('duplicate_mail');
				return $data;
			}
			
			$tbl_name = "users";
			$new_idx = $this->users->get_next_insert_idx($tbl_name);
		
			if ( empty($data['show_errors']) || count($data['show_errors'])==0 ) {
				
				if ( $this->input->post('fpassword') != $this->input->post('fconfirm') ) {
					$data['show_errors'] = "Invalid Password";
				} else {
					
					$hasher = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth') );
					$hashed_password = $hasher->HashPassword($this->input->post('fpassword'));				//}
					
					$qry = array_merge(	
						$qry,
						array(
							'id'		=> $new_idx,													
							'email'		=> $this->input->post('femail'),
							'password'	=> $hashed_password,
							
						)
					);
					
					if($this->db->insert($tbl_name, $qry)){
					//	$data['show_message'] = "Successfully added!";
						redirect("user");
					}
				}
			}			
		}//end run
		
		return $data;
    }
     function user_del() {
            $post_id = $this->uri->segment(3, 0);
            if (empty($post_id)) {
                    echo "select task!";
                    return;
            }
          
            $this->_proc_post_del($post_id);
            redirect("user");
        }
        
    private function &_proc_post_edit($new_idx) { 
    	$this->load->library('upload');
    	             
        $this->form_validation->set_rules('femail', 'Email', 'trim|required|valid_email|xss_clean');
        
        $this->form_validation->set_rules('fpassword', 'Password', 'trim');
	$this->form_validation->set_rules('fconfirm', 'Confirm', 'trim|required|xss_clean');
        
		$qry = array();
		$data = array();
		
		if ($this->form_validation->run())
		{	
                    $suffix = " and id != ".$this->input->post('fid');
                            
                    if( !$this->users->confrim_email($this->input->post('femail'),$suffix ))
                    {
                            $data['show_errors'] = $this->config->item('duplicate_mail');
                            return $data;
                    }
                    
			$tbl_name = "users";	
                        if ( $this->input->post('fpassword') != $this->input->post('fconfirm') ) {
					$data['show_errors'] = "Invalid Password";
                                        
                        } 
                        else if ( empty($data['show_errors']) || count($data['show_errors'])==0 ) {
				//if (strlen(trim($this->input->post('fpassword')))>0) {

				$hasher = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'), $this->config->item('phpass_hash_portable', 'tank_auth') );
				$hashed_password = $hasher->HashPassword($this->input->post('fpassword'));				//}

				$qry = array_merge(	
					$qry,
					array(
						'id'		=> $new_idx,						
						'username'  => $this->input->post('fusername'),
						'email'		=> $this->input->post('femail'),
						'password'	=> $hashed_password
					)
				);
				
				$this->db->where('id', $new_idx);
				$this->db->update($tbl_name, $qry);
				
				$data['show_message'] = "Successfully updated!";

			}			
		}//end run	
			
		return $data;	
		
    } //end function
        
    private function _proc_post_del($idx) {  
         
		$strSql = "DELETE FROM users WHERE id='$idx' ";
		$this->db->query($strSql);		
    }
 }
?>
