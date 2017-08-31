<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_URI extends CI_URI {

    public $_get_params = array();
    public $_query_str = '';

    public function _fetch_uri_string() {
        
      if(isset($_SERVER) &&  isset($_SERVER['QUERY_STRING']) )
      {  
        $this->_query_str = $_SERVER['QUERY_STRING'];
        parse_str($this->_query_str, $this->_get_params);
       
        $_GET = array();
        $_SERVER['QUERY_STRING'] = ''; 
      }
    
    parent::_fetch_uri_string();  
    }

    public function getParam($key) {
        if (isset($this->_get_params[$key])) {
            return $this->_get_params[$key];
        } else {
            return false;
        }
    }

    public function getParams() {
        return $this->_get_params;
    }
    
    public function get_query_str(){
        return $this->_query_str;
    }

}

?>
