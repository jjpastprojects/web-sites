<?php
if ( ! defined('POPUP_DOM_PATH')) exit('No direct script access allowed');
class Uploads {
	
	function check_file($f,$saveto,$maxsize,$exts='*'){
		$pmax_size = ini_get('post_max_size');
		$unit = strtoupper(substr($pmax_size, -1));
		$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
		if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$pmax_size && $pmax_size)
			return array('check'=>false,'error'=>'POST exceeded maximum allowed size.');
			
		if(!isset($_FILES[$f]))
			return array('check'=>false,'error'=>'No upload found for Filedata.');
		elseif(isset($_FILES[$f]['error']) && $_FILES[$f]['error'] != 0)
			return array('check'=>false,'error'=>$this->errorCode($_FILES[$f]['error']));
		elseif(!isset($_FILES[$f]['tmp_name']) || !@is_uploaded_file($_FILES[$f]['tmp_name']))
			return array('check'=>false,'error'=>'Upload failed is_uploaded_file test.');
		elseif(!isset($_FILES[$f]['name']) || empty($_FILES[$f]['name']))
			return array('check'=>false,'error'=>'File has no name.');
		$file = $_FILES[$f];
		
		$size = @filesize($file['tmp_name']);
		if(!$size || $size > $maxsize)
			return array('check'=>false,'error'=>'File exceeds the maximum allowed size.');
		if($size <= 0)
			return array('check'=>false,'error'=>'The file is empty.');
			
		$filename = $file['name'];
		if($exts != '*'){
			$pos = strpos($exts,',');
			if($pos === false)
				$exts = array($exts);
			else
				$exts = array_filter(explode(',',$exts));
			$ext = strtolower(end(explode('.',$filename)));
			if(!in_array($ext,$exts))
				return array('check'=>false,'error'=>'Invalid file extension.');
			if(strtolower($ext) == 'gif')
				$this->remake_gif($file);
			$filename = $this->get_file_name($filename,$saveto);
			if(@copy($file['tmp_name'],$saveto.$filename)){
				return array('check'=>true,'filename'=>$filename);
			} else {
				return array('check'=>false,'error'=>'There was a problem copying the file.');
			}
		}
		return array('check'=>false,'error'=>'There was a problem uploading the file.');
	}
	
	function errorCode($err){
		$uploadErrors = array('There is no error, the file uploaded with success',
							  'The uploaded file exceeds the upload_max_filesize directive in php.ini',
							  'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
							  'The uploaded file was only partially uploaded',
							  'No file was uploaded',
							  'Missing a temporary folder');
		if(isset($uploadErrors[$err]))
			return $uploadErrors[$err];
		else
			return 'Unknown error.';
	}
	
	function remake_gif($file){
		$name = $file['tmp_name'];
		$img = imagecreatefromgif($name);
		$v = $r = $g = $b = '';
		if($fp = @fopen($name,'rb')){
			$result = fread($fp,13);
			$v = substr($result,3,3);
			$r = ord(substr($result,ord(substr($result,11))*3,1));
			$g = ord(substr($result,ord(substr($result,11))*3+1,1));
			$b = ord(substr($result,ord(substr($result,11))*3+2,1));
			fclose($fp);
		}
		imagepng($img,$name);
		$img = imagecreatefrompng($name);
		if($v == '89a')
			imagecolortransparent($img, imagecolorallocate($img,$r,$g,$b));
		imagegif($img,$name);
	}
	
	function get_file_name($filename,$path){
		$special = array(chr(0),'?','[',']','/','\\','=','<','>',':',';',',',"'",'"','&','$','#','*','(',')','|','~','`','!','{','}');
		$filename = str_replace($special,'',$filename);
		$filename = preg_replace('{[\s-]+}','-',$filename);
		$filename = trim($filename,'._');
		$f = explode('.',$filename);
		$ext = strtolower(array_pop($f));
		$exists = true;
		$orig = implode('.',$f);
		$counter = 1;
		while($exists){
			$filename = $orig.(($counter>1)?'_'.$counter:'').'.'.$ext;
			if(!file_exists($path.$filename)){
				$exists = false;
			} else {
				$counter++;
			}
		}
		return $filename;
	}
	
	function resize_image($file,$new_w,$new_h){
		if($new_w <= 0 && $new_h <= 0){
			return false;
		}
		$info = getimagesize($file);
		$image = '';
		
		$final = array(0,0);
		$cur = array($info[0],$info[1]);
		if($new_w == 0){
			$factor = $new_h/$cur[1];
		} elseif($new_h == 0){
			$factor = $new_w/$cur[0];
		} else {
			$factor = min($new_w/$cur[0],$new_h/$cur[1]);
		}
		$final = array(round($cur[0]*$factor),round($cur[1]*$factor));
		switch($info[2]){
			case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
			case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
			case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
			default: return false;
		}
		if($info[2] == IMAGETYPE_GIF){
			$image_resized = imagecreate($final[0],$final[1]);
		} else {
			$image_resized = imagecreatetruecolor($final[0],$final[1]);
		}
		if($info[2] == IMAGETYPE_GIF || $info[2] == IMAGETYPE_PNG){
			$tr_idx = imagecolortransparent($image);
			if($tr_idx >= 0){
				$tr_co = imagecolorsforindex($image,$tr_idx);
				$tr_idx = imagecolorallocate($image_resized,$tr_co['red'],$tr_co['green'],$tr_co['blue']);
				imagefill($image_resized,0,0,$tr_idx);
				imagecolortransparent($image_resized,$tr_idx);
			} elseif($info[2] == IMAGETYPE_PNG){
				imagealphablending($image_resized,false);
				$color = imagecolorallocatealpha($image_resized,0,0,0,127);
				imagefill($image_resized,0,0,$color);
				imagesavealpha($image_resized,true);
			}
		}
		imagecopyresampled($image_resized,$image,0,0,0,0,$final[0],$final[1],$cur[0],$cur[1]);
		
		$f = explode('.',$file);
		$ext = strtolower(array_pop($f));
		$newfile = implode('.',$f).'-'.$new_w.'x'.$new_h.'.'.$ext;
		
		switch($info[2]){
			case IMAGETYPE_GIF: imagegif($image_resized,$newfile); break;
			case IMAGETYPE_PNG: imagepng($image_resized,$newfile); break;
			case IMAGETYPE_JPEG: imagejpeg($image_resized,$newfile); break;
			default: return false;
		}
		imagedestroy($image);
		imagedestroy($image_resized);
		return basename($newfile);
	}
}

?>