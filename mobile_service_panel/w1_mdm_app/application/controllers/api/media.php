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
         $this->load->model('device_model');
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
		
		$device=$this->device_model->mediaUpload($input_method);
        }
			
			//// end of image data ///
			
		  $this -> response(array(
						'message' => "Media uploaded",
						'status' => 1
					), 200);
					
		
		}
		
    }
    function ocrMediaUploadEnd()
	{
		 $input_method = $this->webservices_inputs();
		if(isset($input_method['ocr_code'])){
			$res=$this->device_model->ocrMediaUploadEnd($input_method);
			if($res){
				$this->response(array('message' => "Success", 'status' => 1), 200);
			}else{
				$this->response(array('message' => "Fail", 'status' => 0), 200);
			}
		}else{
			$this->response(array('message' => "Parrameter missing", 'status' => 0), 200);
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
        $ocr_code = '';
        if(isset($input_method['ocr_code'])){
   	$ocr_code = $input_method['ocr_code'];
   }
         
	     $file_name = uniqid();
		$config['upload_path'] = './upload/ocr_media/';
		$config['allowed_types'] = '*';
	    $config['file_name'] = '"'.$ocr_code."_".$file_name.'"';	

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
		
		$device=$this->device_model->ocrMediaUpload($input_method);
        }
			
			//// end of image data ///
			
		  $this -> response(array(
						'message' => "Ocr Media uploaded",
						'status' => 1
					), 200);
					
		
		}
		
    }
   
   
      function gallerymediaUpload()
    {
          $input_method = $this->webservices_inputs();
            

 

		if (false)
		{
			
   $this -> response(array(
						'message' => strip_tags($this -> upload -> display_errors()),
						'status' => 0
					), 200);
			 
		}
		else
		{
			 
			//// Image data ////
			$filename = uniqid().".jpg";
			$output_file = "./upload/media/".$filename;
			$base64_string = $input_method['image'];
	 $this->base64_to_jpeg($base64_string, $output_file);
         $input_method['file_name']=$filename; 
		
		$input_method['file_type'] = "IMAGE";
		$input_method['app_name'] = "GALLERY";
		$input_method['module'] = "GALLERY";
		$device=$this->device_model->mediaUpload($input_method);
        
			
			//// end of image data ///
			
		  $this -> response(array(
						'message' => "Media uploaded",
						'status' => 1
					), 200);
					
		
		}
		
    }
    function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

   // $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($base64_string)); 
    fclose($ifp); 

    return $output_file; 
}
    
    
} 

?>
