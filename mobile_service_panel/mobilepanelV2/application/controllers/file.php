<?php
class File extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        /*$this->load->helper(array(
            'url','constants_helper','number'));*/
        $this->load->helper(array('form', 'url'));    
        $this->load->library(array('session'));
        $this->load->library('upload');
    
        $this->load->library('image_lib');
        $user = $this->session->userdata('logged_in');
        if (!$user) {
            redirect('login/index');
        }
    }
    public function upload_image()
    {
        $fileupload=$_POST['file_upload_name'];
        $source=$_POST['source'];
        $orig_name=$_FILES[$fileupload]['name'];
        $FileName			= strtolower($_FILES[$fileupload]['name']); //uploaded file name
    	$FileTitle			= uniqid(); // file title
    	$ext			    = pathinfo($FileName, PATHINFO_EXTENSION);
    	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
    	$NewFileName        = $FileTitle.'_'.$RandNumber.'.'.$ext;
        
        if($source=='catimage'){
            $config['upload_path'] = './upload/images/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
        }
        
        
        $this->load->library('upload', $config);
        
        $error_flag=0;
         
        $config['file_name']=$NewFileName;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($fileupload))
		{
            $error_flag=1;
            $response=array('upload_flag'=>0,"message"=>$this->upload->display_errors());
            echo json_encode($response);
            exit;
            //echo "<pre>";
            //print_R($error);
		}
		else
		{
			$data=$this->upload->data();
            /*$data = array('upload_data' => $this->upload->data());
            $image_file = $data['upload_data']['file_name'];
            
            $thumb['image_library'] = 'gd2';
            $thumb['source_image'] = './app_images/screen/'.$NewFileName;
            $thumb['new_image'] = './app_images/screen/thumbs/' . $NewFileName;
            $thumb['maintain_ratio'] = true;
            $thumb['create_thumb'] = false;         // for remove _thumb from file name
            $thumb['width'] = 150;
            $thumb['height'] = 150;

            $this->image_lib->initialize($thumb);

           
            
            $this->image_lib->resize();*/
            
            //$this->image_lib->initialize($thumb);
            
		}
         
        if($error_flag){
            $response['upload_flag']=0;
            echo json_encode($response);
            exit;
        }
        else{
            $response=array('upload_flag'=>1,"image_name"=>$NewFileName,"orig_name"=>$orig_name);
            echo json_encode($response);
            exit;
        }
    }
    

   function for_remove_screen()
    {
        $img_id= $_POST['img_id'];
        $this->app_manage_model->remove_screenShot($img_id);
    }
}
?>