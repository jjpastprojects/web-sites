<?php
class PopUp_Domination {

	/**
	* Setting up all objects needed throughout the classes. 
	*/
	
	var $options = array();
	var $loaded = false;
	var $table = '';
	var $themes = array();
	var $base_name = '';
	var $plugin_url = '';
	var $plugin_path = '';
	var $theme_url = '';
	var $theme_path = '';
	var $site_url = '';
	var $prefix = '';
	var $cookie_path = '';
	var $natypes = array('.original.php','.original.htm','.original.html','.original.css','.original.txt');
	var $atypes = array('.php','.htm','.html','.css','.txt');
	var $is_preview = false;
	var $config = array();
	var $campid = '';
	var $ab = false;
	var $form = '';
	var $saved = false;
	var $facebook = '';
	var $user = '';
	var $fb_plugin_v = 's-a';
	
	/**
	* init();
	*
	* Setting up objects we may need throughout the plugin.
	*/
	
	function init($popup_config){
		$this->plugin_url = $popup_config['url'];
		$this->plugin_path = $popup_config['path'];
		$this->theme_url = $this->plugin_url.'themes/';
		$this->theme_path = $this->plugin_path.'themes/';
		$this->site_url = $popup_config['siteurl'];
		$this->cookie_path = preg_replace('|https?://[^/]+|i','', $this->site_url.'/');
		$this->prefix = $popup_config['prefix'];
		$this->table = $this->prefix.'options';
		$this->config = $popup_config;
		$this->version = "3.4.7.5";
		define('POPUP_DOM_PATH',$this->plugin_path);
	}
	
	/**
	* verify_token();
	*
	* Check token data in DB with passed token.
	*/
	
	function verify_token($token){
		return true;
		if($token == $this->option('_token'))
			return true;
		return false;
	}
	
	/**
	* write_db()
	*
	* Generic database write code, used all over the shop to write data to the main 3 PopDom tables.
	*/
	
	function write_db($table, $values = NULL, $update = NULL, $where = NULL, $equals = NULL){
		global $popup_config;
		$fields = '';
		$dbval = '';
		$columns = '';
		$num = count($values);
		$i = 1;
		if($update == NULL){
			foreach($values as $k => $a){
				$c = $i++;
				$fields .= '`'.$k.'`';
				$dbval .= $this->escape($a);
				if($c<$num){
					$fields .= ',';
					$dbval .= ',';
				}
			}
			$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$dbval.");";
			mysql_query($sql);
			return $id = array('id'=>mysql_insert_id());
		}else{
			foreach($values as $k => $a){
				$c = $i++;
				$columns .= '`'.$k.'` = '.$this->escape($a);
				if($c<$num){
					$columns .= ',';
				}
			}
			$sql = "UPDATE ".$table." SET ".$columns." WHERE ".$where."=".$this->escape($equals).";";
			mysql_query($sql);
		}
	}
	
	/**
	* get_db()
	*
	* Generic database retreval code, used all over the shop to grab data from the main 3 PopDom tables.
	*/
	
	function get_db($from,$where = NULL, $value = NULL,$select = NULL){
		$result = array();
		$wherestr = '';
		$select = is_null($select) ? '*' : $select;
		if(!is_null($where)){
			if(is_array($where)){
				foreach($where as $a => $b){
					$wherestr .= $a.'='.$this->escape($b);
				}
			}
		}
		$sql = "SELECT ".$select." FROM `".$from."`".($wherestr==''?'':' WHERE '.$wherestr);
		$result = mysql_query($sql);
		if($result && mysql_num_rows($result) > 0){
			while($row = mysql_fetch_assoc($result)){
				$results[] = $row;
			}
		}else{
		    if(mysql_num_rows($result)==0){
		    	$results = array(0 => '');
		    }else if(!$checkresults){
				echo 'There has been an error saving to the database, please try again later';
			}else{
				$results = array(0 => '');
			}
		}
		return $results;
	}
	
	/**
	* delete_db()
	*
	* Generic database delete code, used all over the shop to delete data to the main 3 PopDom tables.
	*/
	
	function delete_db($from,$where){
		if(!is_null($where)){
			if(is_array($where)){
				foreach($where as $a => $b){
					$wherestr .= '`'.$a.'`='.$this->escape($b);
				}
			}
		}
		echo $sql = "DELETE FROM `".$from."` WHERE ".$wherestr;
		$result = mysql_query($sql);
	}
	
	/**
	* toggle_db()
	*
	* Generic database delete code, used all over the shop to delete data to the main 3 PopDom tables.
	*/

	function toggle_db(){
    $id = $_POST['id'];
    $table = 'popup_domination'.$_POST['table'];
    $records = $this->get_db($table,'id = '.$id);
    $togglestate = 1;
    if (!empty($records)){
      $record = $records[0];
      $togglestate = $record->active;
    }
    if ($togglestate){
      $this->write_db($table,array('toggled'=> 0),array('%d'),true, array('id' => $id), array('%d'));
    } else {
      $this->write_db($table,array('off'=> 1),array('%d'),true, array('id' => $id), array('%d'));
    }
    echo $togglestate;
    die();
  }
	
	
	/**
	* token_field()
	*
	* Generates a token for security, acts liwk wp_nonce.
	*/
	
	
	function token_field(){
		static $_token;
		if(!isset($_token)){
			$_token = md5($this->generate_salt(10));
			$this->option('_token',$_token);
		}
		return '<input type="hidden" name="_token" id="_token" value="'.$_token.'" />';
	}
	
	/**
	* clear_cookie()
	*
	* clears the cookies set when a popup has been closed.
	*/
	
	function clear_cookie(){
		global $in;
		if($this->verify_token($in['_token'])){
			if($in['id'] == 0){
				$id = 'zero';
			}else if($in['id'] == 1){
				$id = 'one';
			}else if($in['id'] == 3){
				$id = 'three';
			}else if($in['id'] == 4){
				$id = 'four';
			}else{
				$id = $in['id'];
			}
			$name = 'popup_domination_hide_lightbox'.$id;
			setcookie($name,'',time()-60*60*24*100,$this->cookie_path);
			echo '{"done":"done"}';
		} else {
			echo '{"error":"Verification failed, please refresh the page and try again."}';
		}
		exit;
	}
	
	/**
	* activate()
	*
	* function that sets the db variable to turn the plugin on.
	*/
	
	function activate(){
		global $in;
		if($this->verify_token($in['_token'])){
			$update = $in['todo'] == 'turn-on' ? 'Y' : 'N';
			$this->option('enabled',$update);
			echo '{"active":"'.$update.'"}';
		} else {
			echo '{"error":"Verification failed, please refresh the page and try again."}';
		}
		exit;
	}
	
	/**
	* check_image()
	*
	* checks that the upload images are either a gif, jpeg or png format.
	*/
	
	function check_image($file){
		$info = @getimagesize($file);
		if(empty($info))
			$result = false;
		elseif (!in_array($info[2],array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG)))
			$result = false;
		else
			$result = true;
		return $result;
	}
	
	/**
	* upload_file()()
	*
	* PHP function which processes uploaded images.
	*/
	
	function upload_file(){
		global $in;
		if($this->verify_token($in['_token']) && isset($in['template']) && $t = $this->get_theme_info($in['template'])){
			if(isset($in['fieldid'])){
				if($field = $this->get_field($t,$in['fieldid'])){
					$uploads = $this->plugin_path.'uploads/';
					$fileobj = $_FILES['userfile'];
					if(!empty($fileobj['tmp_name']) && $this->check_image($fileobj['tmp_name'])){
						require_once $this->plugin_path.'uploads.php';
						$u = new Uploads();
						$chk = $u->check_file('userfile', $uploads, 1048576, 'gif,png,jpeg,jpg');
						if($chk['check']){
							$sizes = array();
							if(isset($field['field_opts'])){
								$opts = $field['field_opts'];
								if(isset($opts['max_w']) && isset($opts['max_h']))
									$sizes = array($opts['max_w'],$opts['max_h']);
							}
							$image_url = $this->plugin_url.'uploads/'.$chk['filename'];
							if(count($sizes) == 2){
								$resized = $u->resize_image($this->plugin_path.'uploads/'.$chk['filename'],$sizes[0],$sizes[1]);
								if($resized){
									$image_url = $this->plugin_url.'uploads/'.$resized;
									@unlink($this->plugin_path.'uploads/'.$chk['filename']);
								}
							}
							echo $image_url.'|';
							exit;
						} else {
							echo 'error|<strong>Upload Error:</strong> '.$chk['error'];
							exit;
						}
					} else {
						echo 'error|<strong>Upload Error:</strong> The file you tried to upload is not a valid image.';
						exit;
					}
				}
			}
		}
		echo 'error|<strong>Upload Error:</strong> There was an error finding the field.';
		die();
	}
	
	/**
	* in()
	*
	* Collect all data passed to the loaded page and stores it in the $in function.
	*/
	
	function in(){
		$in = array_merge($this->doQuotes($_GET),$this->doQuotes($_POST));
		if(isset($in['PHPSESSID']))
			unset($in['PHPSESSID']);
		return $in;
	}
	
	function doQuotes($arr,$top=true){
		$new = array();
		foreach($arr as $a => $b){
			if(!$top){
				$c = stripslashes($a);
				if($c !== $a)
					unset($arr[$a]);
				$a = $c;
			}
			$new[$a] = is_array($b)?$this->doQuotes($b,false):stripslashes($b);
		}
		return $new;
	}
	
	function escape($str,$addq=true){
		if(is_int($str) || is_float($str))
			return $str;
		elseif(is_array($str)){
			foreach($str as &$s){
				if(!is_int($s) && !is_float($s)){
					$s = addcslashes($str,"\000\n\r\\'\"\032");
					$s = $addq ? "'".$s."'":$s;
				}
			}
			return $str;
		}
		$str = addcslashes($str,"\000\n\r\\'\"\032");
		return $addq ? "'".$str."'":$str;
	}
	
	function input_val($str){
		$str = htmlspecialchars($str);
		$str = str_replace(array("'",'"'),array('&#39;','&quot;'),$str);
		return $str;
	}
	
	/**
	* generate_salt()
	*
	* Generates the salt used for encoding the passowrd with md5.
	*/
	
	function generate_salt($max=50){
		$salt = '';
		for($i=0;$i<$max;$i++){
			$salt .= chr(mt_rand(33,126));
		}
		return $salt;
	}
	
	/**
	* validate_email()
	*
	* Checks that a valid email address has bee set during installtion and login.
	*/
	
	function validate_email($email){
		$email = strtolower($email);
		if(!preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i',$email))
			return false;
		return true;
	}
	
	/**
	* update()
	*
	* Updates a database value.
	*/
	
	function update($name,$value){
		global $popup_config;
		$this->load_options();
		if(isset($this->options[$name])){
			$sql = "UPDATE ".$this->table." SET value=".$this->escape($value)." WHERE id=".$this->escape($this->options[$name]['id']).";";
			mysql_query($sql);
			$this->options[$name]['value'] = $value;
		} else {
			$sql = "INSERT INTO ".$this->table." (name,value) VALUES (".$this->escape($name).",".$this->escape($value).");";
			mysql_query($sql);
			$this->options[$name] = array('id'=>mysql_insert_id(),'name'=>$name,'value'=>$value);
		}
	}
	
	/**
	* option()
	*
	* Creates a database value if it doesn't already exsist.
	*/
	
	function option($name,$value=null){
		if(!is_null($value)){
			$this->update($name,$value);
		} else {
			if(isset($this->options[$name])){
				return $this->options[$name]['value'];
			} else {
				$this->load_options();
				if(isset($this->options[$name])){
					return $this->options[$name]['value'];
				}
			}
		}
		return false;
	}
	
	/**
	* load_options()
	*
	* Loads database data from the "options" table.
	*/
	
	function load_options(){
		if($this->loaded){
			return;
		}
		$sql = "SELECT * FROM ".$this->prefix."options";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_assoc($result)){
				$this->options[$row['name']] = $row;
			}
		}
		$this->loaded = true;
	}
	
	/**
	* Test_connection()
	*
	* Tests if we can connect to the database using the details provided.
	*/
	
	function test_connection($config){
		$errormsg = '';
		if(!$con = @mysql_connect($config['host'],$config['user'],$config['pass'])){
			$errormsg = 'Unable to connect.';
		} elseif(!@mysql_select_db($config['name'],$con)){
			$errormsg = 'Unable to connect to db.';
		}
		return array(($errormsg == ''),$errormsg);
	}
	
	/**
	* Check_installed()
	*
	* Checks is the plugin has been installed.
	*/
	
	function check_installed($die=false){
		$msg = '';
		$installed = false;
		$path = dirname(__FILE__).'/';
		if(!file_exists($path.'config.php')){
			$msg = 'The config.php file is missing. Please try running the installer at http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/install/';
		} else {
			include $path.'config.php';
			$this->table = $this->escape($popup_config['prefix'],false).'options';
			$con = $this->test_connection($popup_config);
			if(!$con[0]){
				$msg = $con[1];
			} else {
				$sql = "SELECT COUNT(*) FROM {$this->table}";
				if(!mysql_query($sql)){
					$msg = 'The options table wasn\'t found.';
					return false;
					die();
				} else {
					if(file_exists($path.'install') && is_dir($path.'install')){
						$msg = 'Success! You have installed PopUp Domination, please delete your install folder.';
					} else {
						$installed = true;
						$this->init($popup_config);
					}
				}
			}
		}
		if($die && !$installed){
			die($msg);
		} else {
			return array($installed,$msg);
		}
	}
	
	/**
	* Is_enabled()
	*
	* Checks is the plugin has been turned on.
	*/
	
	function is_enabled(){
		static $enabled;
		if(!isset($enabled)){
			if(!$e = $this->option('enabled'))
				return false;
			if($this->is_mobile()){
				return false;
			}
			$enabled = $e;
		}
		return $enabled == 'Y' ? true : false;
	}
	
	/**
	* Is_mobile()
	*
	* Works out if someone is viewing the popup with a mobile device.
	*/
	
	function is_mobile(){
        return false;
	}
	
	/**
	* get_file_list()
	*
	* Gets a full list of files that are in a directory.
	*/
	
	function get_file_list($dir,$dirs=false,$types=array(),$natypes=array()){
		$t_dir = @opendir($dir);
		if(!$t_dir)
			return false;
		$na = array('','.','..');
		$files = array();
		while(($file = readdir($t_dir)) !== false){
			if(!in_array($file,$na)){
				if($dirs){
					if(is_dir($dir.$file))
						$files[] = $file;
				} else {
					if(!is_dir($dir.$file)){
						if($this->check_file_type($file,$types,$natypes))
							$files[] = $file;
					}
				}
			}
		}
		if($t_dir)
			@closedir($t_dir);
		return $files;
	}
	
	/**
	* check_file_type()
	*
	* checks the file type.
	*/
	
	function check_file_type($file,$types=array(),$natypes=array()){
		if(empty($file))
			return false;
		if(count($types) == 0 && count($natypes) == 0)
			return true;
		$lower = strtolower($file); $fl = strlen($file);
		if(count($natypes) > 0){
			foreach($natypes as $n){
				$nl = strlen($n);
				$tmp = substr($lower,($fl-$nl),$nl);
				if($tmp == $n)
					return false;
			}
		}
		if(count($types) > 0){
			foreach($types as $t){
				$tl = strlen($t);
				$tmp = substr($lower,($fl-$tl),$tl);
				if($tmp == $t)
					return true;
			}
		}
		return false;
	}
	
	/**
	* sort_array()
	*
	* checks the file type.
	*/
	
	function sort_array($a,$b){
		if($a['name'] == $b['name'])
			return 0;
		return ($a['name'] < $b['name']) ? -1 : 1;
	}
	
	/**
	* show_var()
	*
	* unserializes data from the db - out of date function.
	*/
	
	function show_var($backup=false){
		$var = 'show';
		if($backup)
			$var .= '_backup';
		$$var = array();
		if($s = $this->option($var)){
			if(!empty($s)){
				if(is_array($s))
					$$var = $s;
				else
					$$var = unserialize($s);
			}
		}
		return $$var;
	}
	
	/**
	* clean_comment()
	*
	* cleans up data and removes unwanted symbols.
	*/
	
	function clean_comment($str){
		return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
	}
	
	/**
	* encode()
	*
	* makes sure field data doesn't try and inject code.
	*/
		
	function encode($str,$striptags=true){
		if($striptags){
			$str = strip_tags($str,'<b><strong><em><i><br>');
			$str = preg_replace('{<br\s*>}si','<br />',$str);
		}
		return $str;
	}
	
	/**
	* encode2()
	*
	* makes sure field data doesn't try and inject javascript or css.
	*/
	
	function encode2($str){
		$str = preg_replace('{<style[^>]*>.*</style>}si','',$str);
		$str = preg_replace('{<script[^>]*>.*</script>}si','',$str);
		return stripslashes($str);
	}
	
	/**
	* check()
	*
	* security checks that makes sure the popup is safe to appear on screen.
	*/
	
	function check($data){
		if(!$data = unserialize($data[0]['data']))
			return false;
		if(!$enabled = $this->option('enabled'))
			return false;
		if($enabled != 'Y')
			return false;
		if(!$t = $data['template']['template'])
			return false;
		if(!$themeopts = $this->get_theme_info($t))
			return false;
		if(isset($themeopts['colors']) && !($color = $data['template']['color']))
			return false;
		return array('t'=>$t,'themeopts'=>$themeopts,'color'=>$color, 'data'=>$data);
	}
	
	/**
	* get_css()
	*
	* loads the default reset css file.
	*/
	
	function get_css($t){
		$css = file_get_contents($this->plugin_path.'themes/popreset.css').file_get_contents($this->theme_path.$t.'/lightbox.css');
		return $css;
	}
	
	/**
	* get_javascript()
	*
	* creates the JSON file which holds all the data needed to build the popup.
	*/
	
	function get_javascript($is_preview=false){
		$temps = array();
		$fb_auth = false;
		$abcookie = false;
		if(!$this->ab){
			$popupid = $_GET['popup'];
			$data = $this->get_db($this->prefix.'campaigns',array('id' =>$popupid));
			if(!$chk = $this->check($data)){
				return false;
			}
			$abcookie = ', popup_domination_abcookie = "false"';
		}else{
			$abid = $_GET['popup'];
			$data = $this->get_db($this->prefix.'ab',array('id' =>$abid));
			$camps = unserialize($data[0]['campaigns']);
			$datasettings = unserialize($data[0]['absettings']);
			if(!empty($datasettings['absettings']['visitsplit'])){
				$percent = $datasettings['absettings']['visitsplit'];
			}else{
				$percent = '50';
			}
			$finaltemp = $this->split_calculation($camps, $percent);
			$temp = $this->get_db($this->prefix.'campaigns',array('campaign' =>$finaltemp));
			$popname = $temp[0]['campaign'];
			$popupid = $temp[0]['id'];
			foreach ($camps as $index => $name) {
				if ($popname == $name) {
					$popupid = $index;
				}
			}
			$abcookie = ', popup_domination_abcookie = "true"';
			$abcookie .= ', popup_domination_abid = "'.$data[0]['id'].'"';
			if(!$chk = $this->check($temp)){
				return false;
			}
		}
		if($this->option('facebook_enabled') == 'Y'){
			$version = 's-a';
			$a = $this->option('facebook_id');
			$b = $this->option('facebook_sec');
			$app_access = "https://graph.facebook.com/oauth/access_token?client_id=".$a."&client_secret=".$b."&grant_type=client_credentials";
			$app_access_token = file_get_contents($app_access);
			$user = $this->facebook->getUser();
			if ($user) {
			  try {
			    $user_profile = $this->facebook->api('/me');
			    $permissions = $this->facebook->api("/me/permissions");
			    $UserName = $user_profile['name'];
			  } catch (FacebookApiException $e) {
			    error_log($e);
			    $this->user = null;
			  }
			}
			if ($user) {
			  $fb_auth = true;
			  $logoutUrl = $this->facebook->getLogoutUrl();
			  if(!isset($_GET['state'])){
			  	if( array_key_exists('email', $permissions['data'][0]) ) {
					die();
			  	}
			  }else{
			  	echo '';
			  }
			} else {
			  $loginUrl = $this->facebook->getLoginUrl(array(
			    'scope' => 'email,publish_stream',
			    'display' => 'popup'
			  )
			);
			}
		}
		extract($chk);
		$clickbank = '';
		$api = unserialize(base64_decode($this->option('formapi')));
		$clickbank = '';
		if($promote = $this->option('promote')){
			if($promote == 'Y'){
				$clickbank = $this->option('clickbank');
			}
		} else {
			$promote = 'N';
		}
		$target = $this->option('new_window') == 'Y' ? ' target="_blank"':'';
		$inputs = array('email'=>$data['fields']['field_email_default']);
		$api = unserialize(base64_decode($this->option('formapi')));
		$provider = $api['provider'];
		
		$this->custominputs = $this->option('custom_fields');
		for($i = 1; $i<=$this->custominputs; $i++){
			$inputs['custom'.$i.'_box'] = $this->option('custom'.$i.'_box');
		}
		
		
		//echo '<h1>'.$this->option('disable_name').' and '.$api['disable_name'].'</h1>';
		$disable_name = $this->option('disable_name');
		$disable = $api['disable_name'];
		if(isset($disable_name) && $disable_name == 'Y'){
			$disable_name = 'Y';
		} else if(isset($disable) && $disable == 'Y') {
			$disable_name = 'Y';
		} else {
			$disable_name = 'N';
		}
		//echo '<h1>'.$disable_name.' and '.$disable.'</h1>';
				
		
		if($provider != 'aw'){
			if($disable_name != 'N'){
				$inputs['name'] = $data['fields']['field_name_default'];
			}
		}else{
			$inputs['name'] = $data['fields']['field_name_default'];
		}
		$fields = '';		
		if($provider == 'nm' || $provider == 'form'){
			$form = $this->option('action');
			if(!empty($form)){
				$form_action .= $this->option('action');
			}else{
				$form_action .= $api['listsid'];
			} 
		}else{
			if($provider != 'aw'){
				$form_action = '#';
				$fields .= '<input class="listid" type="hidden" name="listid" value="'.$api['listsid'].'" />';
			}else{
				$fields .= '<form method="post" action="http://www.aweber.com/scripts/addlead.pl"><input type="hidden" name="listname" value="'.$api['listname'].'" /><input type="hidden" name="meta_adtracking" value="PopUp Domination" /><input type="hidden" name="meta_message" value="1" /><input type="hidden" name="meta_required" value="name,email" />';
			}
		}
		$fields .= '<input class="provider" type="hidden" name="provider" value="'.$api['provider'].'" />';
		$redirect = $this->option('redirecturl');
		if($provider == 'aw'){
			if(isset($redirect) && !empty($redirect)){
				$fields .= '<input class="redirect" type="hidden" name="redirect" value="'.$redirect.'" />';
			}
		}
		if($provider != 'aw'){
			if(isset($api['custom1']) && !empty($api['custom1'])){
				$fields .= '<input class="custom_id1" type="hidden" name="customf1" value="'.$api['custom1'].'" />';
			}
			if(isset($api['custom2']) && !empty($api['custom2'])){
				$fields .= '<input class="custom_id2" type="hidden" name="customf2" value="'.$api['custom2'].'" />';
			}
		}
		if($provider == 'form'){
			$hidden = $this->option('hidden_fields');				
			if(isset($hidden)){
				$fields .= $hidden;
			}
		}
		if($provider == 'nm'){
			if(isset($redirect) && !empty($redirect)){
				$fields .= '<input class="redirect" type="hidden" name="redirect" value="'.$redirect.'" />';
			}else{
				$fields .= '<input class="redirect" type="hidden" name="redirect" value="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" />';
			}
			$fields .= '<input class="master" type="hidden" name="master" value="'.$api['apikey'].'" />';
		}
		if($f = $campaign['images']){
			if(!empty($f)){
				$fieldsarr = unserialize($f);
				foreach($fieldsarr as $b){
					$fields .= '<div style="display:none"><img src="'.$b.'" alt="" height="1" width="1" /></div>';
				}
			}
		}
		$inputs['hidden'] = $fields;
		$list_items = array();
		if($l = $data['list']){
			if(!empty($l)){
				foreach($l as $litem){
					$list_items[] = $this->encode($litem);
				}
			}
		}
		$fields = array();
		if(isset($themeopts['fields']) && count($themeopts['fields']) > 0){
			foreach($themeopts['fields'] as $a => $b){
				if(isset($b['field_opts']['default_val']) && !empty($b['field_opts']['default_val'])){
					$id = $b['field_opts']['id'];
					$fields[$b['field_opts']['id']] = $b['field_opts']['default_val'];
				}
			}
		}
		$center = $themeopts['center'];
		$delay = $data['schedule']['delay'];
		$delay_hide = ' style="display:none"';
		$button_color = $data['template']['button_color'];
		$cookie_time = $data['schedule']['cookie_time'];
		$base = dirname($this->base_name);
		$theme_url = $this->theme_url.$t;
		$this->currentcss = $this->theme_url.$t;
		$lightbox_id = 'popup_domination_lightbox_wrapper';
		$lightbox_close_id = 'popup_domination_lightbox_close';
		$lightbox_submit_id = 'popup_domination_opt_in';
		$icount = $data['schedule']['impression_count'];
		$show_opt = $data['schedule']['show_opt'];
		$unload_msg = $data['schedule']['unload_msg'];
		$name = $this->option('name_box');
		$email = $this->option('email_box');
		$custom1 = $this->option('custom1_box');
		$custom2 = $this->option('custom2_box');
		if(isset($themeopts['fields']) && count($themeopts['fields']) > 0){
			foreach($themeopts['fields'] as $a => $b){
				$id = $b['field_opts']['id'];
				$fields[$b['field_opts']['id']] = $data['template']['field_'.$id];
				if( empty($fields[$b['field_opts']['id']]) || !isset($fields[$b['field_opts']['id']])){
					$fields[$b['field_opts']['id']] = $b['field_opts']['default_val'];
				}
			}
		}
		$arr = array();
		if($provider != 'form'){
			if($disable_name == 'N'){
				$arr[] = array('class'=>'name','default'=>((isset($fields['name_default'])) ? $fields['name_default'] : 'name'), 'name'=> 'name');
			}
			$arr[] = array('class'=>'email','default'=>((isset($fields['email_default'])) ? $fields['email_default'] : 'email'), 'name'=> 'email');
		}else{
			if($disable_name == 'N'){
				$arr[] = array('class'=>'name','default'=>((isset($fields['name_default'])) ? $fields['name_default'] : 'name'), 'name'=> $name);
			}
			$arr[] = array('class'=>'email','default'=>((isset($fields['email_default'])) ? $fields['email_default'] : 'email'), 'name'=> $email);
		}
		if($data['num_cus'] > 0){
			if(isset($custom1) && !empty($custom1) || isset($api['custom1']) && !empty($api['custom1'])){
				if($provider != 'aw' && $provider != 'form'){
					$arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom1_default'] : ''), 'name' => 'custom1_default');
				}else if($provider == 'aw'){
					$arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom1_default'] : ''), 'name' => 'custom '.$api['custom1']);
				}else{
					$arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom1_default'] : ''), 'name' => $custom1);
				}
			}
			if(isset($custom2) && !empty($custom2) || isset($api['custom2']) && !empty($api['custom2'])){
				if($provider != 'aw' && $provider != 'form'){
					$arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => 'custom2_default');
				}else if($provider == 'aw'){
					$arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => 'custom '.$api['custom2']);
				}else{
					$arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => $custom2);
				}
			}
		}
		$fstr = ''; $js = array();
		foreach($arr as $a){
			if(!empty($a['name']) && !empty($a['default'])){
				$js[$a['name']] = $a['default'];
			}
			$fstr .= '<input type="text" class="'.$a['class'].'" value="'.$a['default'].'" name="'.$a['name'].'" />';
		}
		$promote_link = (($promote=='Y') ? '<p class="powered"><a href="'.((!empty($clickbank))?'http://'.$clickbank.'.popdom.hop.clickbank.net/':'http://www.popupdomination.com/').'" target="_blank">Powered By PopUp Domination</a></p>':'');
		if($promote=='N'){
			$promote_link = '';
		}
		$str = $this->generate_js($delay,$center,$cookie_time,$arr,$show_opt,$unload_msg,$icount,$redirect);	
		header('Content-type: text/javascript');
		$str .= file_get_contents($this->plugin_path.'javascript/lightbox'.(($is_preview)?'-preview':'').'.js');
		header('Cache-Control: must-revalidate');
		header('Last-modified: '.$this->option('last_modified'));
		header('Content-type: text/javascript');
		if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) > strtotime($this->option('last_modified'))){
			header('HTTP/1.1 304 Not Modified');
			exit;
		}		
		ob_start();
		include $this->theme_path.$t.'/template.php';
		$output = ob_get_contents();
		ob_end_clean();
		$fbid = $this->option('facebook_id'); 
		if(isset($fbid) && !empty($fbid)){ $fbjsonvar = ', popup_domination_fb_id = \''.$fbid.'\'';}else{ $fbjsonvar = '';}
		if(isset($fields['video']) && !empty($fields['video'])):
			echo 'document.write(\'<script type="text/javascript" src="'.$this->plugin_url.'inc/flowplayer/example/flowplayer-3.2.6.min.js" ></script>\');';
			echo 'document.write(\'<script type="text/javascript" src="'.$this->plugin_url.'inc/flowplayer/example/flowplayer.ipad-3.2.2.min.js" ></script>\');';
		else:
			echo 'document.write(\'<script>if(typeof $f == "undefined"){console.log("if video theme is selected, a video has not been connected");}</script>\');';
		endif;
		echo 'document.write(\'<link rel="stylesheet" type="text/css" href="'.$this->theme_url.$t.'/lightbox.css" />\');';
		echo 'var popup_domination_output = \''.str_replace(array('\'',"\r\n","\n"),array('\\\'',"'+'","'+'"),$output).'\', popup_domination_cssurl = \''.$this->theme_url.$t.'/lightbox.css\', popup_domination_url = \''.$this->plugin_url.'\''.$fbjsonvar.' , popup_domination_popupid = \''.$popupid.'\''.$abcookie.' ; ';
		echo $str;
	}
	
	/**
	* css_redirect()
	*
	* loads the selected theme's css file.
	*/
	
	function css_redirect(){
		if(!$chk = $this->check()){
			exit;
		}
		extract($chk);
		header('Location: '.$this->theme_url.$t.'/lightbox.css');
		exit;
	}
	
	/**
	* generate_js()
	*
	* returns all the data and produces this on the web page.
	*/
	
	function generate_js($delay,$center,$cookie_time,$opts=array(),$show_opt,$unload_msg,$icount=0,$redirect){
		$js = '';
		if(count($opts) > 0){
			foreach($opts as $o){
				if(!empty($o['default']) && !empty($o['class'])){
					$js .= (($js=='')?'':',').'".'.$o['class'].'":"'.$this->input_val($o['default']).'"';
				}
			}
		}
		return 'var popup_domination_defaults = {'.$js.'}, delay = '.floatval($delay).', popup_domination_cookie_time = '.floatval($cookie_time).', popup_domination_center = \''.$center.'\', popup_domination_cookie_path = \''.$this->cookie_path.'\', popup_domination_show_opt = \''.$show_opt.'\', popup_domination_unload_msg = \''.$this->input_val($unload_msg).'\', popup_domination_impression_count = '.intval($icount).', popup_domination_redirect = \''.$redirect.'\' ;
';
	}
	
	/**
	* get_field()
	*
	* collects the fields data.
	*/
	
	function get_field($theme,$field){
		if(empty($field))
			return false;
		if(!isset($theme['fields']))
			return false;
		foreach($theme['fields'] as $f){
			if($f['field_opts']['id'] == $field)
				return $f;
		}
		return false;
	}
	
	/**
	* get_theme_editor()
	*
	* gets the files for the plugin editor - old needs removing.
	*/
	
	function get_theme_editor(){
		global $in;
		$editable = true;
		if(isset($in['theme']) && ($t = $this->get_theme_info($in['theme']))){
			$cur_theme = $in['theme'];
		} elseif($t = $this->option('template')){
			if($t = $this->get_theme_info($t)){
				$cur_theme = $t['theme'];
			}
		}
		$file_content = $codepress_lang = '';
		$file = '&nbsp;';
		if(isset($cur_theme) && isset($in['file']) && $this->check_file_type($in['file'],$this->atypes,$this->natypes)){
			$file = basename($in['file']);
			$realfile = $this->theme_path.$cur_theme.'/'.$file;
			if(file_exists($realfile)){
				if(isset($in['action']) && $in['action'] == 'restore' && ($f = $this->get_original_file($cur_theme,$file))){
					if($fopen = fopen($realfile,'w')){
						fwrite($fopen,file_get_contents($f));
						fclose($fopen);
						unlink($f);
					}
				}
				$file_content = file_get_contents($realfile);
			}			
		}
		$themes = $this->get_themes();
		$themestr = '';
		if(count($themes) > 0){
			foreach($themes as $t){
				$themestr .= '<option value="'.$t['theme'].'"'.(($cur_theme==$t['theme'])?' selected="selected"':'').'>'.$t['name'].'</option>';
			}
		}
		include $this->plugin_path.'admin/tpl/editor.php';
	}
	
	/**
	* get_original_file()
	*
	* plugin editor functionality - old needs removing.
	*/
	
	function get_original_file($t,$file){
		$path = $this->theme_path.$t.'/';
		$f = explode('.',$file);
		if(count($f) > 1){
			$ext = array_pop($f);
			$f = implode('.',$f).'.original.'.$ext;
			if(file_exists($path.$f) && is_file($path.$f))
				return $path.$f;
		}
		return false;
	}
	
	/**
	* save_theme_file()
	*
	* plugin editor functionality - old needs removing.
	*/
	
	function save_theme_file(){
		global $in;
		if(isset($in['theme']) && ($t = $this->get_theme_info($in['theme']))){
			if(isset($in['file']) && file_exists($this->theme_path.$t['theme'].'/'.$in['file']) && $this->check_file_type($in['file'],$this->atypes,$this->natypes)){
				$f = explode('.',$in['file']);
				$orig = $this->theme_path.$t['theme'].'/'.$f[0].'.original.'.$f[1];
				$filename = $this->theme_path.$t['theme'].'/'.$f[0].'.'.$f[1];
				if(!file_exists($orig)){
					if($fopen = fopen($orig,'w')){
						fwrite($fopen,file_get_contents($filename));
						fclose($fopen);
					}
				}
				if($fopen = fopen($filename,'w')){
					fwrite($fopen,$this->encode(stripslashes($in['newcontent']),false));
					fclose($fopen);
				}
			}
		}		
	}
	
	/**
	* get_theme_info()
	*
	* gets all the settings set in the theme.txt file for the passes theme.
	*/
	
	function get_theme_info($t){
		$files = $this->get_file_list($this->theme_path.$t);
		if(in_array('theme.txt',$files)){
			$template_data = implode( '', file($this->theme_path.$t.'/theme.txt' ));
			$name = '';
			$opts = array();
			if(preg_match('|Template Name:(.*)$|mi', $template_data, $name)){
				$opts['name'] = $this->clean_comment($name[1]);
				$opts['center'] = 'N';
				if(preg_match( '|Center:(.*)$|mi', $template_data, $size))
					$opts['center'] = $this->clean_comment($size[1]);
				if(preg_match( '|Preview Size:(.*)$|mi', $template_data, $size))
					$opts['size'] = array_filter(explode('x',$this->clean_comment($size[1])));
				$opts['ext'] = 'png';
				if(preg_match( '|Preview Ext:(.*)$|mi', $template_data, $ext))
					$opts['ext'] = $this->clean_comment($ext[1]);
				if(preg_match( '|Colors:(.*)$|mi', $template_data, $color)){
					$opts['colors'] = $this->color_opts($t,$opts['ext'],array_filter(explode(' | ',$this->clean_comment($color[1]))));
				} else {
					if(file_exists($this->theme_path.$t.'/preview.'.$opts['ext']))
						$opts['img'] = $t.'/preview.'.$opts['ext'];
				}
				if(preg_match('|Button Colors:(.*)$|mi',$template_data, $colors))
					$opts['button_colors'] = $this->button_colors($t,array_filter(explode('|',$this->clean_comment($colors[1]))));
				if(preg_match( '|List Items:(.*)$|mi', $template_data, $list))
					$opts['list'] = intval($this->clean_comment($list[1]));
				if(preg_match( '|Fields:(.*)$|mi', $template_data, $fields))
					$opts['fields'] = $this->field_opts(array_filter(explode('|',$this->clean_comment($fields[1]))));
				if(preg_match( '|NumberExtraInputs:(.*)$|mi', $template_data, $numfields))
					$opts['numfields'] = intval($this->clean_comment($numfields[1]));
				$opts['theme'] = $t;
				return $opts;
			}
		}
		return false;
	}
	
	/**
	* field_opts()
	*
	* Gets all field options.
	* Used in conjuction with get_theme_info().
	*/
	
	function field_opts($fields=array()){
		if(is_array($fields) && count($fields) > 0){
			$arr = array();
			foreach($fields as $f){
				$tmp_arr = array();
				$f2 = explode('[',$f);
				$tmp_arr['name'] = $f2[0];
				$f2 = explode(']',$f2[1]);
				$f2 = array_filter(explode(',',$f2[0]));
				$tmp_arr['field_opts'] = array();
				foreach($f2 as $a => $b){
					$f3 = explode(':',$b);
					if(count($f3) > 1){
						$tmp_arr['field_opts'][$f3[0]] = $f3[1];
					}
				}
				$arr[] = $tmp_arr;
			}
			return $arr;
		}
		return false;
	}
	
	/**
	* color_opts()
	*
	* Gets all colour options for the templates.
	* Used in conjuction with get_theme_info().
	*/
	
	function color_opts($t,$ext,$colors=array()){
		if(is_array($colors) && count($colors) > 0){
			$arr = array();
			foreach($colors as $c){
				$tmp_arr = array();
				$c2 = explode('[',$c);
				$tmp_arr['name'] = $c2[0];
				$c2 = explode(']',$c2[1]);
				$info = array_filter(explode(':',$c2[0]));
				$file = $t.'/previews/'.$info[0].'.'.$ext;
				if(file_exists($this->theme_path.$file) && is_file($this->theme_path.$file)){
					$info[2] = $file;
				}
				$tmp_arr['info'] =  $info;
				$arr[] = $tmp_arr;
			}
			return $arr;
		}
		return false;
	}
	
	/**
	* resetcode()
	*
	* creates a randomly generated password.
	*/
	
	function resetcode() {
	    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
	    $i = 0;
	    $pass = '' ;
	    while ($i <= 7) {
	        $num = rand() % 33;
	        $tmp = substr($chars, $num, 1);
	        $pass = $pass . $tmp;
	        $i++;
	    }
	    return $pass;
	}
	
	/**
	* button_colors()
	*
	* Gets all button colour options for the templates.
	* Used in conjuction with get_theme_info().
	*/
	
	function button_colors($t,$colors=array()){
		if(is_array($colors) && count($colors) > 0){
			$arr = array();
			foreach($colors as $c){
				$tmp_arr = array();
				$c2 = explode('[',$c);
				$tmp_arr['name'] = $c2[0];
				$c2 = explode(']',$c2[1]);
				$tmp_arr['color_id'] = $c2[0];
				$arr[] = $tmp_arr;
			}
			usort($arr,array(&$this,'sort_array'));
			return $arr;
		}
		return false;
	}
}
if(defined('IS_ADMIN')){
	require_once 'popup-domination.admin.php';
} else {
	require_once 'popup-domination.front.php';
}

?>