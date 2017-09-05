<?php 

/**
* loads a function based on information passed through from ajax.
*/


if(isset($dothis)){
	if($dothis == 'show'){
		$popdom->do_analytics($id);
	}else if($dothis == 'optin'){
    	$popdom->do_anayltics_optin($id);
   	}else if($dothis == 'ab_show'){
   		$popdom->do_ab_analytics($id, $abid);
	}else if($dothis == 'ab_optin'){
   		$popdom->do_ab_optin($id, $abid);
   	}else if($dothis == 'mailing'){
   		$popdom->mailing($_POST);
   	}else{
   		exit('{"error":"No direct script access allowed"}');
   	}
} else {
	exit('{"error":"No direct script access allowed"}');
}
?>
