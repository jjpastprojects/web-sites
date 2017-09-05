<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Users extends CI_Model
{
	private $table_name = 'users';			// user accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_id($user_id)
	{
		$this->db->where('id', $user_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by login (username or email)
	 *
	 * @param	string
	 * @return	object
	 */ 
	function get_user_by_login($login)
	{
		$this->db->where('LOWER(username)=', strtolower($login));
		$this->db->or_where('LOWER(email)=', strtolower($login));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	
        
      

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_email($email)
	{
            
            $this->db->where('LOWER(email)=', strtolower($email));

            $query = $this->db->get($this->table_name);
            if ($query->num_rows() == 1) return $query->row();
            return NULL;
        }

	/**
	 * Check if username available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(username)=', strtolower($username));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}
        
        /**
	 * Check if FaceBook ID available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_fb_id_available($fb_id)
	{
            if ($fb_id=="")
                return false;
            $this->db->select('1', FALSE);
            $this->db->where('LOWER(fb_id)=', strtolower($fb_id));
            
            $query = $this->db->get($this->table_name);
            return $query->num_rows() == 0;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data, $activated = TRUE)
	{
            
            if ($this->db->insert($this->table_name, $data)) {
                    $user_id = $this->db->insert_id();
                    //if ($activated)	$this->create_profile($user_id);
                    return array('id' => $user_id);
            }
            return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activate_user($user_id, $activation_key, $activate_by_email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('id', $user_id);
			$this->db->update($this->table_name);

			$this->create_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function purge_na($expire_period = 172800)
	{
		$this->db->where('activated', 0);
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			//$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_password_key($user_id, $new_pass_key)
	{
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function can_reset_password($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}
        

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function set_new_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'new_email' : 'email', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		$this->db->set('email', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	
     
        /**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_session_info($user_id, $session_id,$d_token)
	{
		$this->db->set('session_id', $session_id);
                $this->db->set('device_token', $d_token);
		
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}
        
        /**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function increase_score($user_id)
	{
           $strSql =  "UPDATE `users` SET `score` = `score` + 1 WHERE `id` = '$user_id'";
           
	    
           if (!$this->db->query($strSql)) return FALSE;
                       
            return TRUE;
	}
       
        
	/**
	 * Ban user
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function ban_user($user_id, $reason = NULL)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	/**
	 * Unban user
	 *
	 * @param	int
	 * @return	void
	 */
	function unban_user($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	
	function &get_object_list($tbl_name, $banned=-1, $start=0, $count=1000, $search_option='') {

		$strSql = "SELECT COUNT(*) AS cnt FROM $tbl_name";
		$query = $this->db->query($strSql);		
		$row = $query->row_array();
		$return_arr['total'] = $row['cnt'];
		
		if ($tbl_name != "users")
			$strSql = "SELECT * FROM $tbl_name WHERE 1=1 ORDER BY nID DESC LIMIT $start, $count";
		else
			$strSql = "SELECT * FROM $tbl_name WHERE 1=1 ORDER BY id DESC LIMIT $start, $count";
                
		$return_arr['rows'] = $query->result_array();
		
		return $return_arr;
	}
	
	function &get_specific_data($idx, $tbl_name) {
            if ($tbl_name != "users") 
                    $strSql = "SELECT * FROM $tbl_name WHERE nID='$idx'";
            else 
                    $strSql = "SELECT * FROM $tbl_name WHERE id='$idx'";
            $query = $this->db->query($strSql);
            $row = $query->row_array();
            return $row;
	}
	
	function confrim_email( $email, $suffix='') {
            $strSql = "SELECT * FROM users WHERE email='$email'".$suffix;

            $query = $this->db->query($strSql);

            if ($query->num_rows() == 1) return FALSE;
            return TRUE;		
	}
	
	function confirm_barcode( $barcode ) {
		$strSql = "SELECT * FROM product WHERE barcode='$barcode'";
		$query = $this->db->query($strSql);
		
		if ($query->num_rows() == 1) return FALSE;
		return TRUE;
	}
	
	function get_next_insert_idx($tbl_name) {

		$next_increment = 0;
		$strSql = "SHOW TABLE STATUS WHERE Name='$tbl_name'";
		$query = $this->db->query($strSql);
		$row = $query->row_array();
		$next_increment = $row['Auto_increment'];
		
		return $next_increment;
	}
	
	
	
	function update_goal($goal)
	{	
            $strSql = "UPDATE users SET goal = $goal where id=1 ";
            
             if (!$this->db->query($strSql)) return FALSE;
                       
            return TRUE;
	}
        
        //arr is array of information
        function update_user_by_arr($userID, $arr)
	{	
            $strSql = "UPDATE users SET ";
            $i=0;
            
            foreach ($arr as $key => $value) {
                $i++;
                $strSql.=$key."='".$value."' ";
                if ($i<  sizeof($arr))
                    $strSql.=" , ";
                
            }
            $strSql.=" where id=".$userID;
          
           
             if (!$this->db->query($strSql)) return FALSE;
           
            
            return TRUE;
	}
        
	
	function login_user($session_id, $user_id) {
		$strSql = "UPDATE users SET session_id='$session_id' WHERE id=".$user_id;
		$this->db->query($strSql);
	}
	
	function logout($session_id) {
		$this->db->query("DELETE FROM ci_sessions WHERE session_id='$session_id'");
	}
        
        function is_valid_session($user_id, $session_id){
            $strSql = "SELECT * FROM users WHERE id=".$user_id. " and session_id='".$session_id."'";
            
            $query = $this->db->query($strSql);
            if ($query->num_rows() >= 1) return true;

            return false;
        }
	
	function generate_password($pw_length = 8, $use_caps = true, $use_numeric = true, $use_specials = true) {
		$caps = array();
		$numbers = array();
		$num_specials = 0;
		$reg_length = $pw_length;
		$pws = array();
		for ($ch = 97; $ch <= 122; $ch++) $chars[] = $ch; // create a-z
		if ($use_caps) for ($ca = 65; $ca <= 90; $ca++) $caps[] = $ca; // create A-Z
		if ($use_numeric) for ($nu = 48; $nu <= 57; $nu++) $numbers[] = $nu; // create 0-9
		$all = array_merge($chars, $caps, $numbers);
		if ($use_specials) {
			$reg_length =  ceil($pw_length*0.75);
			$num_specials = $pw_length - $reg_length;
			if ($num_specials > 5) $num_specials = 5;
			for ($si = 33; $si <= 47; $si++) $signs[] = $si;
			$rs_keys = array_rand($signs, $num_specials);
			foreach ($rs_keys as $rs) {
				$pws[] = chr($signs[$rs]);
			}
		}
		$rand_keys = array_rand($all, $reg_length);
		foreach ($rand_keys as $rand) {
			$pw[] = chr($all[$rand]);
		}
		$compl = array_merge($pw, $pws);
		shuffle($compl);
		return implode('', $compl);
	}
	
    /**
	 * Change user password by Email and remove password key field
	 *
	 * @param	useremail
	 * @param	new password
	 * @return	bool
	 */
	function change_password_by_passkey($pass_key, $new_pass)
	{
		$this->db->set('password', $new_pass);
                $this->db->set('new_password_key', '');
		$this->db->where('new_password_key', $pass_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}
	
	function productInfo($barcode) {
		$strSql = "SELECT * FROM product WHERE barcode='$barcode'";
		$query = $this->db->query($strSql);
		
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	
	     
         /**
	 * get list of all users         
	 * @return	array
	 */
        
	 function list_agents($level,$leader_id)
	 {
             
                $strSql = "SELECT * FROM users where approved = ". APPROVED;

               if ($level!=null)
                   $strSql.=" and level=$level";
               if ($leader_id!=null)
                   $strSql.=" and leader_id=$leader_id";
               $strSql.=" order by score desc";    
               $query = $this->db->query($strSql);

               $list=array(); $i=0;

               return $query->result();
            
	}
        
//         /**
//	 * get list of all users         
//	 * @return	array
//	 */
//        
//	 function list_agents($level,$leader_id)
//	 {
//             
//            $strSql = "SELECT webforms.agent_id id, u.status status, u.password password, u.name name, u.leader_id leader_id, "
//                    . "COUNT(webforms.id) score FROM webforms, users u WHERE agent_id=u.id AND u.approved=".APPROVED;
//            
//            if ($level!=null)
//                $strSql.=" and u.level=$level";
//            
//            if ($leader_id!==null)
//                $strSql.=" and u.leader_id=$leader_id";
//            
//            $strSql.=  "  GROUP BY webforms.agent_id ORDER BY score desc";
//            
//            $query = $this->db->query($strSql);
//                    
//            $list=array(); $i=0;
//            
//            return $query->result();
//            
//	}
        
          /**
	 * get list of all users         
	 * @return	array
	 */
        
	 function list_leaders()
	 {
             
            $strSql = "SELECT * from users where level=".LEADER;
            
            
            $query = $this->db->query($strSql);
                    
            $list=array(); 
            
            return $query->result();
            
	}
        
       
         /**
	 * get list of all users         
	 * @return	array
	 */
        
	 function list_pending_users($level,$leader_id)
	 {
             
            $strSql = "SELECT * FROM users where approved = ". PENDING;
            
            if ($level!=null)
                $strSql.=" and level=$level";
            if ($leader_id!=null)
                $strSql.=" and leader_id=$leader_id";
            
            $query = $this->db->query($strSql);
                    
            $list=array(); $i=0;
            
            return $query->result();
            
	}
        
        /**
	 * Create webform record
	 
	 */
	function create_webform($data)
	{
		if ($this->db->insert("webforms", $data)) {
			$user_id = $this->db->insert_id();
			//if ($activated)	$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
                
		return NULL;
	}
        
        /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_webform_by_email($email)
	{
            
            $this->db->where('LOWER(email)=', strtolower($email));
            
            $query = $this->db->get('webforms');
           
            if ($query->num_rows() == 1) return $query->row();
            return NULL;
        }
        
        /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function check_webform_by_email($email)
	{
            
            $this->db->where('LOWER(email)=', strtolower($email));
            
            $query = $this->db->get('webforms');
           
            if ($query->num_rows() >= 1) return $query->row();
            return NULL;
        }
        
         /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_score($agent_id)
	{
          
            $strSql="SELECT SUM(score) cnt FROM users WHERE 1=1";
            if ($agent_id!=null)
                $strSql.=" and id=$agent_id";
            
            $query = $this->db->query($strSql);		
            $row = $query->row_array();
            return  $row['cnt'];      
        }
        
            /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_goal()
	{
            $strSql="SELECT goal FROM users WHERE id=1";
            
            
            $query = $this->db->query($strSql);		
            $row = $query->row_array();
            return  $row['goal'];      
        }
          /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_teamscore($leader_id)
	{
            
            $strSql="SELECT SUM(score) cnt FROM users u WHERE u.leader_id=$leader_id ";
            
            $query = $this->db->query($strSql);		
            $row = $query->row_array();
            if ( $row['cnt']==null)
                return 0;
            else
                return $row['cnt'];
        }
        
        /**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_agent_cnt($leader_id)
	{
            
            $strSql="SELECT COUNT(id) cnt FROM users WHERE users.leader_id=$leader_id and users.approved=1 and users.level=1";
            
            $query = $this->db->query($strSql);		
            $row = $query->row_array();
            return  $row['cnt'];        
        }
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */