<?php 
if ( ! defined('POPUP_DOM_PATH')):
	exit('{"error":"No direct script access allowed"}');
else:
	if(!$popdom->admin->logged_in()){
		exit('{"error":"You are not authorized to view this page."}');
	}
	/**
	* loads up functions depending on fata passed through ajax.
	*/
	if(isset($in['do'])){
		$do = strtolower($in['do']);
		/**
		* activates the plugin
		*/
		if($do == 'activation'){
			$popdom->activate();
		/**
		* fires the function for file uploading
		*/
		} elseif($do == 'file_upload'){
			$popdom->upload_file();
		/**
		* Starts the clear cookies function
		*/
		} elseif($do == 'clear_cookie'){
			echo $popdom->clear_cookie();
		/**
		* Fires the preview functionality
		*/
		} elseif($do == 'preview'){
			$popdom->admin->preview();
		/**
		* Starts the theme upload functionality
		*/
		} elseif($do == 'themeupload'){
			$popdom->admin->upload_theme();
		/**
		* Gets the functions that load the mailing list from the apis
		*/
		} elseif($do == 'mailinglist'){
			$popdom->admin->mailing_ajax();
		/**
		* Fires the checkname functionality to make sure campaigns don't have conflicting names
		*/
		} elseif($do == 'checkcampname'){
			$popdom->admin->checkcampname($_POST['name'], $_POST['type']);
		/**
		* Clears the aweber cookies incase users are hvaing problems connecting to API
		*/
		} elseif($do == 'awebercookiesclear'){
			$popdom->admin->awebercookies();
		/**
		* Clears the aweber cookies incase users are hvaing problems connecting to API
		*/
		} elseif($do == 'checkabname'){
			$popdom->admin->checkcampname($_POST['name'], $_POST['type']);
		/**
		* starts the functionality which deletes a campaign from the database
		*/
		} elseif($do == 'deletecamp'){
			$popdom->admin->deletecamp($_POST['campid']);
		/**
		* starts the functionality which deletes a campaign from the database
		*/
		} elseif($do == 'togglecamp'){
			$popdom->admin->togglecamp($_POST['id']);
		/**
		* starts the functionality which deletes a campaign's analytics from the database
		*/
		}else if($do == 'deletestats'){
			$popdom->admin->deletestats($_POST['campname']);
		/**
		* starts the functionality which deletes an a/b campaign's data from the database
		*/
		} elseif($do == 'deleteab'){
			$popdom->admin->deleteab($_POST['campid']);
		}
	}
endif;
?>