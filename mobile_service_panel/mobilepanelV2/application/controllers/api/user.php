<?php   defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';


class User extends REST_Controller
{
    function __construct()
    {
    	
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url','constant_helper'));
        $this->load->model('user_model');
        $this->load->model('admin_model');
		$this->load->library('email');
		$this->load->library('S3');
		
    }
    
    function saveFormData()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('save-userdata',$input_method);
            $userdata=$this->user_model->saveFormData($input_method);
           
            if(!$userdata)
            {
            	
				
               $this->response(array('message' => "Error occur! Try againg", 'status' => 0), 200);
            }else{
              $information = $this->admin_model->get_information($userdata);
		    	 $user_info = $this->admin_model->get_user_info($userdata);       
		        $data['information'] = $information;
				$data['user_info'] = $user_info;
		       
		        $html=$this->load->view('mailview',$data,true);
				$subject = 'New Customer Enquiry by Custom Colonial Painting App';
				$this->colonial_send_mail($html,$subject);  
                 $this->response(array('message' => "Your detail saved", 'status' => 1), 200);
            }
           
    }
	
	    function sendUserInfo()
    {
    	
		
            $input_method = $this->webservices_inputs();
            $this->validate_param('send-user-info',$input_method);
            
           
            if(count($input_method)>0)
            {
              //name,phone_no,address,email,
             if(($input_method['name']!='')||($input_method['phone_no']!='')||($input_method['address']!='')||($input_method['email']!='')){
				$data['user_info'] = $input_method;
		       
		      $html=$this->load->view('user_registermail',$data,true);
				$subject="Customer completed 1st step of enquiry";
				$this->colonial_send_mail($html,$subject);  				
                 $this->response(array('message' => "User information mailed", 'status' => 1), 200);
			 }else{
			 	 $this->response(array('message' => "No action perform", 'status' => 0), 200);
			 }
            }
           
    }
	function usermailtest()
	{
		 $user_info = $this->admin_model->get_user_info(1);  
		 echo "<pre>";
		 print_r($user_info);exit;     
		        $data['information'] = array();
				$data['user_info'] = $user_info;
		 $html=$this->load->view('user_registermail',$data);
	}
	
	function userEnquiry()
	{
		 $input_method = $this->webservices_inputs();
		  $this->validate_param('send-user-info',$input_method);
         $this->validate_param('user-enquiry',$input_method);
		 if(($input_method['phone_no']!='')||($input_method['email']!=''))
			{
		
		 $user_id =$this->user_model->saveUserInfo($input_method);
		 if(!$user_id)
		 {
		 	$this->response(array('message' => "Error occur! Try againg", 'status' => 0), 200);
		 }
		 $input_method['user_id']=$user_id;
		  $userdata=$this->user_model->userEnquiry($input_method);
           
            if(!$userdata)
            {
            	
				
               $this->response(array('message' => "Error occur! Try againg", 'status' => 0), 200);
            }else{
              $information = $this->admin_model->get_information($userdata);
		    	 $user_info = $this->admin_model->get_user_info($userdata);       
		        $data['information'] = $information;
				$data['user_info'] = $user_info;
		       
		        $html=$this->load->view('mailview_enquiry',$data,true);
				$subject = 'New Customer Enquiry by Custom Colonial Painting App';
				$this->colonial_send_mail($html,$subject);  
                 $this->response(array('message' => "Your detail saved", 'status' => 1), 200);
            }
		}else{
				$this->response(array('message' => "Contact info required, please return to previous page", 'status' => 0), 200);	
		}		
				
	}
    
   	
   function photoUpload()
    {
        $input_method = $this->webservices_inputs();
       
	  // print_r($_FILES['image']);
		if(!(isset($_FILES['image']))){
			$this->response(array('message' => NO_FILE_ERROR, 'status' => 0), 200);
		}
        //----------------------------------------------------------------
        $num = rand();
	     $file_name = substr(str_shuffle("0123456789a".$num."bcdefghijklm".$num."nopqrstuvwxyzABCDEFGH".$num."IJKLMNOPQRSTUVWXYZ"),
                    0, 30);
		$ext =pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);	
      $upload_result='';
		//$this->load->library('upload', $config);
		$uri=$file_name.'.'.$ext;
		  if (S3::putObject(S3::inputFile($_FILES['image']['tmp_name']), BUCKET_NAME, $uri, S3::ACL_PUBLIC_READ)) {
        //echo "File uploaded.".$uri;
			  $upload_result='1';
    } else {
       // echo "Failed to upload file.";
		$upload_result='0';
    }
  

		/*if ( ! $this->upload->do_upload('image'))
		{
	 $this -> response(array(
						'message' => strip_tags($this -> upload -> display_errors()),
						'status' => 0
					), 200);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
           // print_r($data);
			//$this->load->view('upload_success', $data);
		}*/
        ///----------------------------------------------------------------------------
        if($upload_result=='1')
        {
         $input_method['image_name']=$uri; 
        }else{
         $this->response(array('message' => NO_FILE_ERROR, 'status' => 0), 200);
		 
        }
         
        $photo_id =$this->user_model->savePhoto($input_method);
		
      if($photo_id)
      {
       
         $this->response(array('message' => PHOTO_UPLOAD_SUCCESS,'photo_id'=>$photo_id,
         'status' => 1), 200);   
        
         
      }else{
         $this->response(array('message' => FILE_UPLOAD_ERROR, 'status' => 0), 200);
      }
    }
   
   
      function colonial_send_mail($message,$subject)
   {
     		$mailfrom = "customcolonialpaintingapp@gmail.com";
		
		$mailto = "customcolonialpainting@gmail.com";
		$cc = array("gdachman@gmail.com","sbtestuser87@gmail.com"); 
		
		$this -> load -> library('email');
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_user'] = $mailfrom;
		$config['smtp_pass'] = MAIL_PASSWORD;
		$config['smtp_port'] = 465;
		$config['newline'] = "\r\n";
		$this -> email -> initialize($config);
		$this -> email -> from($mailfrom, 'Custom Colonial Painting');
		$this -> email -> to($mailto);
		$this -> email -> cc($cc);
		$this -> email -> subject($subject);

		
		//&registerid=$registrationcode
		$this -> email -> message($message);
		$this -> email -> send();
		//$this -> email -> print_debugger();
		//show_error($this -> email -> print_debugger());
	
   }	
   
   
   
   function colonial_send_mailold($message)
   {
   	 /*   $to="ramsample1@gmail.com";
		$subject="Colonial customer mail";
   		$headers = 'From: no-replay@colonial.com' . "\r\n";
		$config['protocol'] = 'mail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = true;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this -> email -> initialize($config);
		//$ci -> email -> from(ADMINMAIL_FROM, 'Colonial');
		$this -> email -> to($to);
		$this -> email -> cc("priyanka@foxinfosoft.com");
		$this -> email -> subject($subject);
		$this -> email -> message($message);
		$this -> email -> send();
	echo	$this -> email -> print_debugger();
	*/
	$to      = 'customcolonialpainting@gmail.com';


$subject = 'Colonial customer mail';


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Frave.com <noreply@fravo.com.au>' . "\r\n"; customcolonialpainting.com/
$headers .= 'From: info@customcolonialpainting.com' . "\r\n";
$headers .= 'Cc: gdachman@gmail.com' . "\r\n";


 mail($to, $subject, $message, $headers);
	
   }	
function colonial_send_mail2($message)
   {
   	    $to="ramsample1@gmail.com";
		$subject="Colonial customer mail";
   		$headers = 'From: no-replay@colonial.com' . "\r\n";
		$config['protocol'] = 'mail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = true;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this -> email -> initialize($config);
		//$ci -> email -> from(ADMINMAIL_FROM, 'Colonial');
		$this -> email -> to($to);
		$this -> email -> cc("priyanka@foxinfosoft.com");
		$this -> email -> subject($subject);
		$this -> email -> message($message);
		$this -> email -> send();
	echo	$this -> email -> print_debugger();
		exit;
   }	
   
} 

?>
