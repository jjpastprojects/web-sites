<?php

class PopUp_Domination_Front extends PopUp_Domination {
	
	/**
	* Calls back to Popup domination class and checks if the plugin has been installed before continuing.
	*/
	
	function __construct(){
		parent::check_installed();
	}
	
	/**
	* split_calculation();
	*
	* works out of the candidates which should be shown depending on percentage value.
	*/
	
	function split_calculation($data, $percent){
		if(empty($percent)){
			$percent = 50;
		}
		$num = count($data)-1;
		$url = $data[$num];
		unset($data[$num]);
		
		$split_url = $data;
		
		$d_p = $percent; 
		
		$url = $url;
		$percentage = '';
		$total_urls = count($split_url) - 1;
		
		mt_srand ((double) microtime() * 1000000);
		$rand_url_val = mt_rand(0, $total_urls);
		$rand_split_val = mt_rand(1, 100);
		
		if(!$percentage or !ereg("^([0-9]{1, 2})$",  $percentage)) { $percentage = $d_p; }
		if(!$url) { $url = $split_url[$rand_url_val]; }
		if($percentage >= $rand_split_val) { return $url; } else { return $split_url[$rand_url_val];} 
	}
	
	/**
	* do_ab_analytics();
	*
	* adds a value to the view element for the ab analytics.
	*/
	
	function do_ab_analytics($id, $abid){
		if (!is_numeric($id) || !is_numeric($abid)) {
			exit('Illegal operation. Exiting.');
		}
		$data = $this->get_db($this->prefix.'ab',array('id' =>$abid));
		$current = array();
		$current = $data[0]['astats'];
		if(empty($current)){
			$current[$id] = array( date('m') => array('optin' => '0', 'show'=> '0'));
		}else{
			$current = unserialize($current);
		}
		if(array_key_exists($id,$current)){
			$current[$id][date('m')]['show'] = $current[$id][date('m')]['show'] + 1;
		}else{
			$current[$id] = array(date('m') => array('optin' => '0', 'show'=> '0'));
			$current[$id][date('m')]['show'] = 1;
		}
		$popup = serialize($current);
		$update = $this->write_db($this->prefix.'ab',array('astats'=> $popup),'true','id', $data[0]['id']);
	}
	
	/**
	* do_analytics();
	*
	* adds a value to the view element for the analytics.
	*/
	
	function do_analytics($id){
		if (!is_numeric($id)) {
			exit('Illegal operation. Exiting.');
		}
		if($this->is_enabled()){
			$camps = $this->get_db($this->prefix.'campaigns',array('id' =>$id));
			if(count($camps)){
				$name = $camps[0]['campaign'];
				$data = $this->get_db($this->prefix.'analytics',array('campname' =>$name));
				if(isset($data[0]) && !empty($data[0])){
					$analytic = $data[0];
					$analytic['views']++; 
					$update = $this->write_db($this->prefix.'analytics',array('views'=> $analytic['views']), true,'id',$data[0]['id']);
				}else{
					$update = $this->write_db($this->prefix.'analytics',array('views'=> '1', 'conversions'=> '0', 'campname' => $name));
				}
			}
		}
	}
	
	/**
	* do_anayltics_optin();
	*
	* adds a value to the conversion element for the analytics.
	*/
	
	function do_anayltics_optin($id){
		if (!is_numeric($id)) {
			exit('Illegal operation. Exiting.');
		}
		$camps = $this->get_db($this->prefix.'campaigns',array('id' =>$id));
		if(count($camps)){
			$name = $camps[0]['campaign'];
			$data = $this->get_db($this->prefix.'analytics',array('campname' =>$name));
			if(isset($data[0]) && !empty($data[0])){
				$analytic = $data[0];
				$analytic['conversions']++; 
				$update = $this->write_db($this->prefix.'analytics',array('conversions'=> $analytic['conversions']), true,'id',$data[0]['id']);
			}else{
				$update = $this->write_db($this->prefix.'analytics',array('views'=> '0', 'conversions'=> '1', 'campname' => $name));
			}
		}
	}
	
	
	/**
	* split_optin();
	*
	* adds a value to the conversion element for the ab analytics.
	*/
	
	function do_ab_optin($id, $abid){
		if (!is_numeric($id) || !is_numeric($abid)) {
			exit('Illegal operation. Exiting.');
		}
		$data = $this->get_db($this->prefix.'ab', array('id' => $abid));
		$current = array();
		$current = $data[0]['astats'];
		if(empty($current)){
			$current[$id] = array( date('m') => array('optin' => '0', 'show'=> '0'));
		}else{
			$current = unserialize($current);
		}
		if(array_key_exists($id,$current)){
			$current[$id][date('m')]['optin'] = $current[$id][date('m')]['optin'] + 1;
		}else{
			$current[$id] = array(date('m') => array('optin' => '0', 'show'=> '0'));
			$current[$id][date('m')]['show'] = $current[$id][date('m')]['show'] + 1;
		}
		$popup = serialize($current);
		$update = $this->write_db($this->prefix.'ab',array('astats'=> $popup),'true','id', $abid);
	}
	
	/**
	* mailing();
	*
	* loads the file to load up the mailing api.
	*/
	
	function mailing($data){
		include($this->plugin_path.'inc/submitdetails.php');
	}
	
}

$popdom = new PopUp_Domination_Front();
?>