<?php
class Download_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}
 function download_folder()
 {
 	$pre='root/';
 	$filearray = array();
	$filepath = array();
	if(isset($_REQUEST['dir'])){
		if($_REQUEST['dir']!="root"){
	$this->db->like("filepath",$_REQUEST['dir']);	
	}}
	
	$this->db->where("module",'MEDIA');
 	$this->db->where("device_id",$_REQUEST['id']);
	$query = $this->db->get("media");
	if($query->num_rows()>0){
		foreach ($query->result_array() as $filedata) {
			$filepath [] = $pre.$filedata['filepath']."/".$filedata['file_name'];
		$filearray[] = $filedata['file_name'];
		}
		$this->createZip( $filearray,$filepath);
	}
 }
	function createZip( $filearray,$filepath)
	{
		//print_r($filearray);
		//print_r($filepath);
		//exit;
		$filepathdir = "./upload/media/";
		 
		
		$unique = uniqid();
		 
		$zip_directory = "./upload/";
		$zipfile_name =  'devicedata_' . $unique . '.zip';
		$zip = new ZipArchive();
		 if ($zip->open($zip_directory . $zipfile_name, ZIPARCHIVE::CREATE) !== true)
                {
                   echo $error = "* Sorry ZIP creation failed at this time<br/>";exit;
                    // Opening zip file to load files
                    return;
                }else{
                	  for ($k = 0; $k < count($filearray); $k++)
                   {
                    $zip->addFile($filepathdir . $filearray[$k], $filepath[$k]);
                    }
                	 $tmp_file= $zip_directory . $zipfile_name;
					//echo $tmp_file= $zip_directory . $zipfile_name;
					# close zip
$zip->close();
	// ob_clean();
# send the file to the browser as a download
header('Content-disposition: attachment; filename="'.$zipfile_name.'"');
header('Content-type: application/zip');
readfile($tmp_file);
unlink($tmp_file);
                }
		
	}
	
	///-------------------end media-------------------///
 

}
?>