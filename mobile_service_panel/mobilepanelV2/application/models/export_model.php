<?php
class Export_model extends CI_Model {

	public function __construct() {
		$this -> load -> database();
	}

	function export_modules() {
		$module = $_REQUEST['module'];
		$uuid = $_REQUEST['id'];
		switch ($module) {
			case 1 :
				$this->deviceinfo_export($uuid);
				break;
			case 2 :
				$this->devicecontact_export($uuid);
				break;
			case 3 :
				$this->devicesms_export($uuid);
				break;
			case 4 :
				$this->devicecalllog_export($uuid);
				break;
			case 5 :
				$this->device_browserhistory_export($uuid);
				break;
			case 6 :
				$this->deviceapplist_export($uuid);
				break;
case 7 :
				$this->device_wifi_export($uuid);
				break;
				case 8 :
				$this->devicemedia_export($uuid);
				break;
			default :
		}
	}
	
	/////----------Export Device Info-------------------//////
	
		function deviceinfo_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_info_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("uuid" ,$uuid );
		$result = $this -> db -> get('device_info');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device= get_unserialize($row['device_detail']);
                    		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Field') 
		 -> setCellValue('B' . $count, 'Value');

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		
		$count++;

foreach ($device as $key => $value) {
								
							if($key!='ACCOUNT'){
			 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count, $key)
			  -> setCellValue('B' . $count,$value)
			 ;
							}else{
								foreach ($value as $raw) {
										$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count, $raw['Name'])
			  -> setCellValue('B' . $count, $raw['Type'])
			 ;
								}
							}

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	////--------------End----------------------------//////
	
	//////------------------Contact ----------------------------//////////////
	
	function devicecontact_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_contact_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
		$result = $this -> db -> get('device_contact');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device= get_unserialize($row['contact_detail']);
                    		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Name') 
		 -> setCellValue('B' . $count, 'Contact No.');

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		
		$count++;

foreach ($device as $row) {
								
						 
			 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count, $row['Name'])
			  -> setCellValue('B' . $count,$row['Number'])
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	////////----------------------------end contact-------------------/////////////
	
	//////-------------------------SMS------------------------------////////
	
		function devicesms_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_sms_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
 
		$result = $this -> db -> get('device_native_sms');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device=   json_decode($row['sms_detail'],true);;
              // echo "<pre>";
			 // print_r($device);//exit;     		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'From') 
		 -> setCellValue('B' . $count, 'Number')
		 -> setCellValue('C' . $count, 'Message')
		 -> setCellValue('D' . $count, 'Type')
		 -> setCellValue('E' . $count, 'Date')
		 ;

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
		     $objPHPExcel->getActiveSheet()->getStyle('E1:F1')->getFont()->setBold(true);
		
		$count++;
 
foreach ($device as $row) {
								
						
			 
$Number = (isset($row['Number']))?$row['Number']:'';
$Address = (isset($row['Address']))?$row['Address']:'';
$Body = (isset($row['Body']))?$row['Body']:'';
$Type = (isset($row['Type']))?$row['Type']:'';	
$Date = (isset($row['Date']))?$row['Date']:'';

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $Address)
			  -> setCellValue('B' . $count,$Number)
			  	->setCellValue('C'.$count, $Body)
				   	->setCellValue('D'.$count, $Type)
            	->setCellValue('E'.$count, $Date)
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	
	
	
	/////---------------------End SMS---------------------/////////
	
	/////--------------------Call Logs-------------------/////////
		
		function devicecalllog_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_calllogs_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
 
		$result = $this -> db -> get('call_log');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device=   json_decode($row['call_detail'],true);;
              // echo "<pre>";
			 // print_r($device);//exit;     		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Contact No.') 
		 -> setCellValue('B' . $count, 'Type')
		 -> setCellValue('C' . $count, 'Date')
		 -> setCellValue('D' . $count, 'Duration') 
		 ;

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
		     
		
		$count++;
 
foreach ($device as $row) {
								
						
			 
$Number = (isset($row['Number']))?$row['Number']:'';
$Type = (isset($row['Type']))?$row['Type']:'';
$Date = (isset($row['Date']))?$row['Date']:'';
$Duration = (isset($row['Duration']))?$row['Duration']:'';	
 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $Number)
			  -> setCellValue('B' . $count,$Type)
			  	->setCellValue('C'.$count, $Date)
				   	->setCellValue('D'.$count, $Duration) 
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	
	
	//////--------------End Call logs-------------------//////
	
	/////--------------Browser history-----------------///
			function device_browserhistory_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "DeviceBrowser_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
 
		$result = $this -> db -> get('device_browser_history');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device= get_unserialize($row['browser_history_detail']);
              // echo "<pre>";
			 // print_r($device);//exit;     		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Name') 
		 -> setCellValue('B' . $count, 'Visit')
		 -> setCellValue('C' . $count, 'Date')
		 -> setCellValue('D' . $count, 'URL') 
		 ;

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
		     
		
		$count++;
 
foreach ($device['Searches'] as $row) {
								
						
			 
$Title = (isset($row['Title']))?$row['Title']:'';
$visit = "Search";
$Date = (isset($row['Date']))?$row['Date']:'';
$URL = '';	
 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $Title)
			  -> setCellValue('B' . $count,$visit)
			  	->setCellValue('C'.$count, $Date)
				   	->setCellValue('D'.$count, $URL) 
			 ;
							 

			$count++;

		}
foreach ($device['BookMarks'] as $row) {
								
						
			 
$Title = (isset($row['Title']))?$row['Title']:'';
$visit = (isset($row['Visits']))?$row['Visits']:'';
$Date = (isset($row['Date']))?$row['Date']:'';
$URL = (isset($row['Url']))?$row['Url']:'';
 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $Title)
			  -> setCellValue('B' . $count,$visit)
			  	->setCellValue('C'.$count, $Date)
				   	->setCellValue('D'.$count, $URL) 
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	
	
	////-----------end browser history--------------------///
	
	/////------------------Wifi ---------------------/////
	
				function device_wifi_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "DeviceIp_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
		$this->db->order_by('id','desc');
$this -> db -> where("device_id" ,$uuid );
 
		$query = $this -> db -> get('device_wifi_conn');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$result = $query -> result_array();
	
              // echo "<pre>";
			 // print_r($device);//exit;     		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Name') 
		 -> setCellValue('B' . $count, 'Network Address')
		 -> setCellValue('C' . $count, 'State')
		 -> setCellValue('D' . $count, 'IP Address') 
		  -> setCellValue('E' . $count, 'Mac Address') 
		 ;

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1:D1')->getFont()->setBold(true);
		     
		$objPHPExcel->getActiveSheet()->getStyle('E1:F1')->getFont()->setBold(true);
		$count++;
		$connectionname = array();
 	foreach ($result as $row) {
		 
			 $device= get_unserialize($row['wifi_detail']);
$row = $device['ConnectedWifi'] ;  
								
						
			 
$SSID = (isset($row['SSID']))?$row['SSID']:'';

	if (in_array($SSID, $connectionname))
					  {
					  	continue;
					  	}		
	$connectionname [] = 	$SSID;
$NetworkAddress = (isset($row['NetworkAddress']))?$row['NetworkAddress']:'';
$SupplicantStateName = (isset($row['SupplicantStateName']))?$row['SupplicantStateName']:'';
$IpAddress = (isset($row['IpAddress']))?$row['IpAddress']:'';
 $MacAddress = (isset($row['MacAddress']))?$row['MacAddress']:'';

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $SSID)
			  -> setCellValue('B' . $count,$NetworkAddress)
			  	->setCellValue('C'.$count, $SupplicantStateName)
				   	->setCellValue('D'.$count, $IpAddress)    	
				   	->setCellValue('E'.$count, $MacAddress) 
			 ;
		$count++; 					 
	}
			$count++; 

		 

		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Name') 
		 -> setCellValue('B' . $count, 'Type')
		 -> setCellValue('C' . $count, 'BSSID')
		 -> setCellValue('D' . $count, 'Frequency')  
		 ;

		$objPHPExcel -> getActiveSheet() -> getStyle('A'.$count.':B'.$count) -> getFont() -> setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C'.$count.':D'.$count)->getFont()->setBold(true);
		     
		$objPHPExcel->getActiveSheet()->getStyle('E'.$count.':F'.$count)->getFont()->setBold(true);
		$count++;
	$availconnectionname = array();	
foreach ($result as $rowdata) {
	$device= get_unserialize($rowdata['wifi_detail']);
foreach ($device['ScanResult'] as $row) {
								
						
			 
$SSID = (isset($row['SSID']))?$row['SSID']:'';
	
	
			
					  if (in_array($row['SSID'], $availconnectionname))
					  {
					  	continue;
					  	}	 
					  		  $availconnectionname[] = $row['SSID'];
$Capabilities = (isset($row['Capabilities']))?$row['Capabilities']:'';
$BSSID = (isset($row['BSSID']))?$row['BSSID']:'';
$Frequency = (isset($row['Frequency']))?$row['Frequency']:'';
  

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count,  $SSID)
			  -> setCellValue('B' . $count,$Capabilities)
			  	->setCellValue('C'.$count, $BSSID)
				   	->setCellValue('D'.$count, $Frequency)    	
				   
			 ;	 

			$count++;

		}
	}
				// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	
	
	/////-----------------End Wifi-----------------//////////
	
	//////////------------------app list ----------------------//////////
	
		function deviceapplist_export($uuid) {
			
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_applist_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
		$result = $this -> db -> get('device_apps');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$row = $result -> row_array();
			 $device= get_unserialize($row['app_detail']);
                    		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'Name') 
		 -> setCellValue('B' . $count, 'Version')
		 -> setCellValue('C' . $count, 'Install Date');

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel -> getActiveSheet() -> getStyle('C1:D1') -> getFont() -> setBold(true);
		
		$count++;

foreach ($device as $row) {
								
						 
			 

			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count, $row['AppName'])
			  -> setCellValue('B' . $count,$row['VersionName'])
			  	  -> setCellValue('C' . $count,$row['DateInstall'])
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// always modified
		header('Cache-Control: cache, must-revalidate');
		// HTTP/1.1
		header('Pragma: public');
		// HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter -> save('php://output');
		exit ;
	}
	///////////////-------------end app list ----------------////////
	///////----------------media----------------------////
	function devicemedia_export($uuid) {
			$filearray = array();
		 
		$attachment = false;
		$headers = true;
		$filename = "Device_media_".uniqid();
		//echo "there";
		// $filename = './upload/csv_report/' . $filename;
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('UTC');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		require_once APPPATH . '/libraries/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel -> getProperties() -> setCreator("Export") -> setLastModifiedBy("Export") -> setTitle("Device Info") -> setSubject("Device Info") -> setDescription("Test document for Office 2007 XLSX, generated using PHP classes.") -> setKeywords("office 2007 openxml php") -> setCategory("Test result file");

		//echo $query;
$this -> db -> where("device_id" ,$uuid );
		$result = $this -> db -> get('media');
 
       

		//if ($headers) {
		// output header row (if at least one row exists)
		$resultdata = $result -> result_array();
			  
                    		 
		//if ($row) {
		//unset($row['autocreatestatus']);
		//fputcsv($fp, array_keys($row[0]));
		// reset pointer back to beginning
		//mysql_data_seek($result, 0);
		//}

		//}

		//while ($row = $result->result_array())
		$count = 1;
		//$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel -> setActiveSheetIndex(0)
		 -> setCellValue('A' . $count, 'File Link') 
		 -> setCellValue('B' . $count, 'App Name')
		 -> setCellValue('C' . $count, 'File Type')
		 -> setCellValue('D' . $count, 'File Date')
		 -> setCellValue('E' . $count, 'Updated On');

		$objPHPExcel -> getActiveSheet() -> getStyle('A1:B1') -> getFont() -> setBold(true);
		$objPHPExcel -> getActiveSheet() -> getStyle('C1:D1') -> getFont() -> setBold(true);
		$objPHPExcel -> getActiveSheet() -> getStyle('E1:F1') -> getFont() -> setBold(true);
		
		$count++;

foreach ($resultdata as $row) {
								
						 
			 $filearray [] = $row ['file_name'];
$link = base_url().'upload/media/'.$row ['file_name'];
	$appname = $row ['app_name'];
$filetype = $row ['file_type'];
$filedate = $row ['media_datetime'];
$updateon = $row ['createdon'] ;
			// Add some data
			$objPHPExcel -> setActiveSheetIndex(0)
			 -> setCellValue('A' . $count, $link)
			  -> setCellValue('B' . $count,$appname)
			  	  -> setCellValue('C' . $count, $filetype)
				  -> setCellValue('D' . $count,$filedate)
				   -> setCellValue('E' . $count,$updateon)
			 ;
							 

			$count++;

		}
		// Rename worksheet
		$objPHPExcel -> getActiveSheet() -> setTitle($filename);

		// // Redirect output to a client’s web browser (Excel5)
		// header('Content-Type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment;filename=' . $filename . '.xls');
		// header('Cache-Control: max-age=0');
		// // If you're serving to IE 9, then the following may be needed
		// header('Cache-Control: max-age=1');
// 
		// // If you're serving to IE over SSL, then the following may be needed
		// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		// // Date in the past
		// header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		// // always modified
		// header('Cache-Control: cache, must-revalidate');
		// // HTTP/1.1
		// header('Pragma: public');
		// // HTTP/1.0
		
		//$filearray[] = "589c683a7f21d_5144186126.jpeg";
		//$filearray[] = "589d59779a2c1_4760037390.png";
		///

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$objWriter -> save('php://output');
		$objWriter -> save('./upload/media/'.$filename.".xls");
	       //echo "<script>window.open('download.php?name=file1','_newtab');<script>";
	       $filearray[]=$filename.".xls";
		$this->createZip($filearray);
		//unlink('./upload/userimg/'.$filename.".xls");
		exit ;
	}
	
	function createZip( $filearray)
	{
		$filepath = "./upload/media/";
		 
		
		$unique = uniqid();
		 
		$zip_directory = "./upload/";
		$zipfile_name =  'media_' . $unique . '.zip';
		$zip = new ZipArchive();
		 if ($zip->open($zip_directory . $zipfile_name, ZIPARCHIVE::CREATE) !== true)
                {
                   echo $error = "* Sorry ZIP creation failed at this time<br/>";exit;
                    // Opening zip file to load files
                    return;
                }else{
                	  for ($k = 0; $k < count($filearray); $k++)
                   {
                    $zip->addFile($filepath . $filearray[$k], $filearray[$k]);
                    }
                	echo $tmp_file= $zip_directory . $zipfile_name;
					
					# close zip
$zip->close();
	 
# send the file to the browser as a download
header('Content-disposition: attachment; filename="'.$zipfile_name.'"');
header('Content-type: application/zip');
readfile($tmp_file);
//unlink($tmp_file);
                }
		
	}
	
	///-------------------end media-------------------///
 

}
?>