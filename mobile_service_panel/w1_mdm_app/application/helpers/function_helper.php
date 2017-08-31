<?php
//error_reporting(0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 

function get_gmt_time()
{
    return gmdate("Y-m-d H:i:s");
}

function make_serialize($data)
{
	//$result = serialize($data);
	return $data;
}

function get_unserialize($data)
{
	//$result = unserialize($data);
	$resarr = json_decode($data,true);
	return $resarr;
}

function updateActivity($id)
{
	$gmdate = get_gmt_time();
	
	 $ci = &get_instance();
    $ci->load->database();
 
    $sql="update `admin`  set 	last_activity = '$gmdate' where id = '$id' ";
    $data = $ci->db->query($sql);

    
	return true;
}

function checkDeviceBusyForOcr($uuid){
		 $ci = &get_instance();
    $ci->load->database();  
	
	date_default_timezone_set("UTC");
	 $today = date('Y-m-d');
 
		$chkquery = $ci -> db -> query("SELECT * FROM `ocr_media` WHERE device_id = '".$uuid."'  AND
		DATE(createdon) = '".$today."' AND video_made = '2' ");
		if($chkquery->num_rows()>0){
			return true;
		}else{
			return false;
		}
}

function batteryStatus($uuid){
	$response = array();
		 $ci = &get_instance();
    $ci->load->database();  
	
 	 $ci -> db -> where("is_delete" ,0 );
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> get('device_info');
		if($chkquery->num_rows()>0){
		$row = $chkquery->row();
			$response = array("battery_status"=>$row->battery_level,"battery"=>$row->battery);
			return $response;
	 }else{
			return $response = array("battery_status"=>"");
		}
}

	function isDeviceReady($uuid)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
	
	
	
	
	 $ci -> db -> where("is_delete" ,0 );
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> get('device_info');
		if($chkquery->num_rows()>0){
		$row = $chkquery->row();
			if($row->status=='OFFLINE'){
				return true;
			}
		$ci -> db -> where("uuid" ,$uuid );
		$query = $ci -> db -> get('tb_ready');
		
		 
 if($query->num_rows()>0){
 
	 
 	return true;
 }else{
	 
 
 	return false;
 }
		}else{
			return false;
		}
}
	
 function FileUpload($file, $filename = '', $path) {

	$ci = &get_instance();
	$ci -> load -> library('upload');
	//print_r($_FILES[$file]);
	//print_r($path);exit;
	if ($_FILES[$file]) {
		//print_r($_FILES[$file]);
		$file_name = $filename;
		$config['upload_path'] = $path;
		//$config['allowed_types'] = '*';
		$config['allowed_types'] = 'jpg|jpeg|gif|png|JPG|JPEG|PNG';
		$config['file_name'] = $file_name;
		//$eventid = 'Pacake' . $input_method['package_id'];
		$ci -> upload -> initialize($config);

		//print_r($ci -> upload -> do_upload($file));exit;

		if (!$ci -> upload -> do_upload($file)) {
			//var_dump($_FILES);
			return array('message' => $ci -> upload -> display_errors(), 'status' => 0);
		} else {

			$data = array('upload_data' => $ci -> upload -> data());

			$image_name = $data['upload_data']['file_name'];
			$input_method['profile_image'] = $image_name;
			$src = $config['upload_path'] . $image_name;
			$ext = $data['upload_data']['file_ext'];
			$desc = $config['upload_path'] . $file_name . '_thumb' . $ext;
			$size = 150;
			make_thumb($src, $desc, $size, $ext);
			//$update = $ci -> User_model -> ImageUpdate($input_method);
			//if ($update)
			{
				return array("file_name" => $image_name, "status" => 1);
			}
		}
	}
}
function make_thumb($src, $dest, $desired_height, $ext) {
	if ($ext == 'png' || $ext == 'PNG' || $ext == '.png' || $ext == '.PNG') {
		$source_image = imagecreatefrompng($src);
	} else {
		$source_image = imagecreatefromjpeg($src);
	}
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	list($width, $height) = getimagesize($src);

	if ($width > $height) {
		 $orientation = "landscape";
		$rotate = imagerotate($source_image, 90, 0);
	} else {
		 $orientation = "portrait";
		
	}
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	//	$desired_height = floor($height * ($desired_width / $width));

	$desired_width = floor($width * ($desired_height / $height));

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	/* new function for png*/
	imagealphablending($virtual_image, false);
	imagesavealpha($virtual_image, true);

	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	//* create the physical thumbnail image to its destination */

	if ($ext == 'png' || $ext == 'PNG' || $ext == '.png' || $ext == '.PNG') {
        $rotate = imagerotate($source_image, 90, 0);
		imagepng($virtual_image, $dest);
	} else {
         $rotate = imagerotate($source_image, 90, 0);
		imagejpeg($virtual_image, $dest);
	}

}

function get_thumb($image) {
	//print_r($image);exit;
	$image = explode('.', $image);
	$thumb_img = $image[0] . '_thumb.' . $image[1];
	return $thumb_img;
}	

	function cadminImage($id)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
 
	 $ci -> db -> where("company_admin_id" ,$id );
		$chkquery = $ci -> db -> get('company_admin');
		if($chkquery->num_rows()>0){
		 $row = $chkquery->row();
			if(strlen($row->profile_photo)>0){
	return  PROFILE_PHOTO_PATH.$row->profile_photo;
			}else{
				return PROFILE_PHOTO_PATH."profile.png";
			}
		}else{
			return PROFILE_PHOTO_PATH."profile.png";
		}
}	

  function moduleComplete($uuid,$module,$per)
{
	 
	
	 $ci = &get_instance();
    $ci->load->database();  
		$arr_field = array("module_loading" => $module,"loading_per" => $per );
		 
		 
	 $ci -> db -> where("uuid" ,$uuid );
		$chkquery = $ci -> db -> update('device_info', $arr_field);
 
}	
?>
