<?php   defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';


class Media extends REST_Controller
{
    function __construct()
    {
    	
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url','constant_helper','function_helper'));
         $this->load->model('spy_model');
    }
 
    
   	
   function mediaUpload()
    {
          $input_method = $this->webservices_inputs();
            $this->validate_param('media-upload',$input_method);

		if(!(isset($_FILES['file']))){
			$this->response(array('message' => "Please select a file to upload", 'status' => 0), 200);
		}
        //----------------------------------------------------------------
        $num = uniqid();
	     $file_name = substr($num,
                    0, 30);
		$config['upload_path'] = './upload/media/';
		$config['allowed_types'] = '*';
	    $config['file_name'] = '"'.$file_name.'"';	

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			
   $this -> response(array(
						'message' => strip_tags($this -> upload -> display_errors()),
						'status' => 0
					), 200);
			 
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//// Image data ////
			
		if(isset($data))
        {
         $input_method['file_name']=$data['upload_data']['file_name']; 
		
		$device=$this->spy_model->mediaUpload($input_method);
        }
			
			//// end of image data ///
			
		  $this -> response(array(
						'message' => "Media uploaded",
						'status' => 1
					), 200);
					
		
		}
		
    }
    
      function ocrMediaUpload()
    {
          $input_method = $this->webservices_inputs();
            $this->validate_param('ocr-media-upload',$input_method);

		if(!(isset($_FILES['file']))){
			$this->response(array('message' => "Please select a file to upload", 'status' => 0), 200);
		}
        //----------------------------------------------------------------
        $num = uniqid();
	     $file_name = substr($num,
                    0, 30);
		$config['upload_path'] = './upload/ocr_media/';
		$config['allowed_types'] = '*';
	    $config['file_name'] = '"'.$file_name.'"';	

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('file'))
		{
			
   $this -> response(array(
						'message' => strip_tags($this -> upload -> display_errors()),
						'status' => 0
					), 200);
			 
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//// Image data ////
			
		if(isset($data))
        {
         $input_method['file_name']=$data['upload_data']['file_name']; 
		
		$device=$this->spy_model->ocrMediaUpload($input_method);
        }
			
			//// end of image data ///
			
		  $this -> response(array(
						'message' => "Ocr Media uploaded",
						'status' => 1
					), 200);
					
		
		}
		
    }
   
    
} 

?>
