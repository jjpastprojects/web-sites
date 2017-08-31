<?php

require_once(APPPATH . '/libraries/MY_Library.php');
require_once(APPPATH . '/libraries/amazonsdk/aws-autoloader.php');

require 'vendor/autoload.php';

use Aws\Common\Aws;

class s3 extends MY_Library {
	
	public $s3;
	public $ci;

	function __construct()
	{
		$this->ci 	= & get_instance();

		$aws 		= Aws::factory(APPPATH . 'config/amazon_config.php');
		$this->s3 	= $aws->get('s3');

		$this->ci->load->config('amazon_config');
	}

	public function upload_saved_logo($file_path)
	{
		try {
		    $result = $this->s3->putObject(array(
			    'Bucket'       => $this->ci->config->item('bucket'),
			    'Key'          => $this->ci->config->item('saved_logos_folder') . '/' . pathinfo($file_path, PATHINFO_BASENAME),
			    'SourceFile'   => $file_path,
			    'ContentType'  => mime_content_type($file_path),
			    'ACL'          => 'public-read',
			    'StorageClass' => 'REDUCED_REDUNDANCY'
			));
		} catch (\Aws\S3\Exception\S3Exception $e) {
		    $this->set_error($e->getMessage());
		    return FALSE;
		}	
		
		return TRUE;	
	}

	public function _get_processed_path($file_name)
	{
		return $this->ci->config->item('processed_folder'). '/' . $file_name;
	}
	//Cezar
        public function upload_products_image($dest_path, $source_path)
	{
	    try {
		 $result = $this->s3->putObject(array(
		'Bucket'       => $this->ci->config->item('bucket'),
		'Key'          => $dest_path . '/' . pathinfo($source_path, PATHINFO_BASENAME),
		'SourceFile'   => $source_path,
		'ContentType'  => mime_content_type($source_path),
		//'ACL'          => 'public-read',
		'StorageClass' => 'REDUCED_REDUNDANCY'
		));
	    } catch (\Aws\S3\Exception\S3Exception $e) {
		$this->set_error($e->getMessage());
		return FALSE;
	    }
	return $this->ci->config->item('bucket') . '/' . $dest_path . '/' . pathinfo($source_path, PATHINFO_BASENAME);	
	}
        //Cezar_END

	public function upload_processed($file_path, $bucket_path = FALSE)
	{
		try {
		    $result = $this->s3->putObject(array(
			    'Bucket'       => $this->_get_processed_bucket(),
			    'Key'          => $bucket_path ? $bucket_path : $this->_get_processed_path(pathinfo($file_path, PATHINFO_BASENAME)),
			    'SourceFile'   => $file_path,
			    'ContentType'  => mime_content_type($file_path),
			    //'ACL'          => 'public-read',
			    'StorageClass' => 'REDUCED_REDUNDANCY'
			));
		} catch (\Aws\S3\Exception\S3Exception $e) {
		    $this->set_error($e->getMessage());
		    return FALSE;
		}	
		
		return TRUE;
	}

	private function _get_processed_bucket()
	{
		return $this->ci->config->item('processed_bucket');
	}

	function test()
	{
		try {
		    $result = $this->s3->putObject(array(
			    'Bucket'       => 'logodazzle',
			    'Key'          => 'processed/63729.jpg',
			    'SourceFile'   => '/home/yanaizmene/img/63729.jpg',
			    'ContentType'  => 'image/jpg',
			    //'ACL'          => 'public-read',
			    'StorageClass' => 'REDUCED_REDUNDANCY'
			));

			debug($result['ObjectURL']);
		} catch (\Aws\S3\Exception\S3Exception $e) {
		    echo $e->getMessage();
		}
	}

	public function processed_url($file_name)
	{
		return 'http://' . $this->ci->config->item('processed_cloudfront_domain') 
				. '/' . $this->_get_processed_path($file_name);
	}

	public function list_keys($path)
	{
		$bucket = $this->ci->config->item('bucket');
		// $bucket = 'logodazzle';

		$objects = $this->s3->getIterator('ListObjects', array(
			'Bucket' 	=> $bucket,
			'Prefix'	=> $path
			// 'Prefix'	=> 'processed'
		));


		// echo "Keys retrieved!<br />";
		// foreach ($objects as $object) {
		//     echo $object['Key'] . "<br />";
		// }
		// exit;

		return $objects;
	}









}