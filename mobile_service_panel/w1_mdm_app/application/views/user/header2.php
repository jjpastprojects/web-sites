<?php
$dashboard=$userlist=$message=$wifi=$ocrscreencast=$browser=$ocrscreen=$recording=$deviceinfo=$track=$eventsact=$settings=$file_explorer="";
if($active_page=='index' )
{
    $dashboard='active';
}
else if($active_page=='contact' )
{
    $userlist='active';
}else if($active_page=='message' )
{
	  $message='active';
}else if($active_page=='wifi' )
{
	  $wifi='active';
}
else if($active_page=='recording' )
{
	  $recording='active';
}else if($active_page=='browser' )
{
	  $browser='active';
}else if($active_page=='ocrscreen')
{
$ocrscreen = 'active';	
}else if($active_page=='file_explorer' )
{
	$file_explorer = 'active';
}else if($active_page=='device_info' )
{
	$deviceinfo = 'active';
}else if($active_page=='location' )
{
	  $track='active';
}else if($active_page=='events' )
{
	  $eventsact='active';
}else if($active_page=='settings' )
{
	$settings = 'active';
}
else if($active_page=='ocr_screencastvideo')
{
	$ocrscreencast = 'active';
}
 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/daterangepicker/daterangepicker-bs3.css">
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>dist/imagezoom/hover_zoom_v3.min.js"></script>
  <style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  margin:0 auto;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
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

function cancleRequest()
{
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/cancleRequest");?>', 
                  data: {'id':'<?php echo $_REQUEST['id']?>'},
                  success: function(data){
                  	 
 

}
                });
               
}
//// show loader

function displayOverlay(text) {
  $("<table id='overlay'><tbody><tr><td><lable style='margin-top:-1%;color:red;cursor:pointer;' class='pull-right pull-top' onclick='cancleRequest()' ><small class='label pull-right bg-red'>X</small></lable></td></tr><tr><td>" + text + "</td></tr></tbody></table>").css({
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




	function make_device_ready(uuid)
			{
				//alert(uuid);
				 $.ajax({
                url		:	"<?php echo site_url("user/make_device_Ready")?>",
                type	:	"POST", 
                data	:	{"id":uuid},               
                success	:	function(data){   
                          	//alert();
                 	 window.location.reload();
			
                 }
            
            });

			}



///end loader

$(document).ready(function()
{
	
	var device_ready = 0;
	displayOverlay('<span id="loadingmodule">loading...</span><div class="loader"></div><span id="loadper">0%</span>');
   setInterval('updateClock()', 1000);
    
   <?php 
    $uuid = $_REQUEST['id'];
	 
   if(isDeviceReady($uuid)){
 
   	?>
  removeOverlay();
   	<?php 	
   
   }else{
   	?>
   //	getuserdata('<?php echo $uuid;?>','SEND_DATA');
   	 setInterval('checkDeviceStatus()', 1000);
   	<?php
   } ?>
   
});
////
function checkDeviceStatus()
{
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/checkDeviceStatus");?>', 
                  data: {'id':'<?php echo $_REQUEST['id']?>'},
                  success: function(data){
                  	  moduleloading();
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
////
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
	#reloadbtn{
		margin-left: 35%; margin-top: 5px;
	}
	@media (max-width: 500px) {
   #reloadbtn{
		margin-left: 15%; margin-top: 5px;
	}
}
</style>

  </head>
  <?php $battery_info = batteryStatus($_REQUEST['id']);
  $battery_status = $battery_info['battery_status'];
  $sidecolor = "";
  $lowmsg="";
  if($battery_status=="LOW"){
  	$sidecolor = ' style="background-color: #e43513;"';
	 }
  ?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url("cadmin/dashboard");?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>dmin</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin </b>Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
           <a id="reloadbtn"  onclick="make_device_ready('<?php echo $_REQUEST['id'] ?>')"  class="btn btn-primary">
                    <i class="fa fa-repeat"></i>&nbsp; Reload Panel
                  </a>
                  
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

          
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                     Admin
                      <small>W1 MDM App</small>
                    </p>
                  </li>
                   
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    	<?php
                    	  $is_superadmin = $this->session->userdata('admin');
				if($is_superadmin){
				 ?>
				      <a href="<?php echo site_url('admin/editprofile'); ?>" class="btn btn-default btn-flat">Edit Profile</a>
                
				 <?php
				 	
				 }else{
                    	?>
                      <a href="<?php echo site_url('cadmin/dashboard/editprofile'); ?>" class="btn btn-default btn-flat">Edit Profile</a>
                   <?php
				 }
                   ?>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            <!--  <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" >
          <!-- Sidebar user panel -->
          <div class="user-panel" <?php echo $sidecolor;?>>
            <div class="pull-left image">
              <img src="<?php echo base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>User</p>
             <label>Battery Status:&nbsp;</label><span><?php echo $battery_status;?></span>
             
            <!--  <a href="#"><i class="fa fa-mobile "></i> </a>-->
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div style="color: #fff;padding: 4px;" class="input-group">&nbsp;
            	<i class="fa fa-clock-o"></i>
              <span style="color: #fff;" id="clock"></span>
               
                     &nbsp;
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="<?php echo $dashboard;?>">
              <a href="<?php echo site_url("user/index").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
             
            </li>
            <li class="<?php echo $deviceinfo;?>">
              <a href="<?php echo site_url("user/device_info").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-info"></i> <span>Device Info</span> 
              </a>
             
            </li>
             <li class="<?php echo $userlist;?>">
              <a href="<?php echo site_url("user/contact").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-user"></i> <span>Contacts</span> 
              </a>
             
            </li>
              <li class="<?php echo $track;?>">
              <a href="<?php echo site_url("user/gpsTrack").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-map-pin"></i> <span>GPS Track</span> 
              </a>
             
            </li>
            
                 <li class="<?php echo $eventsact;?>">
              <a href="<?php echo site_url("user/events").'?id='.$_REQUEST['id'];?>">
                <i class="fa  fa-calendar"></i> <span>Events</span> 
              </a>
             
            </li>
              <li class="<?php echo $file_explorer;?>">
              <a href="<?php echo site_url("user/file_explorer").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-file-photo-o"></i> <span>File Explorer</span> 
              </a>
             
            </li>     <li class="<?php echo $recording;?>">
              <a href="<?php echo site_url("user/recording").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-microphone"></i> <span>Recording</span> 
              </a>
             
            </li>
                  <li class="<?php echo $ocrscreen;?>">
              <a href="<?php echo site_url("user/ocr_screendata").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-file-photo-o"></i> <span>OCR data</span> 
              </a>
             
            </li>
               <li class="<?php echo $ocrscreencast;?>">
              <a href="<?php echo site_url("user/ocr_screencastvideo").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-file-movie-o"></i> <span>Screencast Data </span> 
              </a>
             
            </li>
                   <li class="treeview <?php echo $settings;?>">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Device Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li ><a href="<?php echo site_url("user/settings").'?id='.$_REQUEST['id'];?>"><i class="fa fa-asterisk"></i> Settings</a></li>
              <!--  <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i>App Settings</a></li>-->
              
              </ul>
            </li>
          
            <!-- <li class="<?php echo $message;?>">
              <a href="<?php echo site_url("user/messages").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-envelope"></i> <span>Messages</span> 
              </a>
             
            </li>-->
          <!--    <li class="<?php echo $wifi;?>">
              <a href="<?php echo site_url("user/wifi").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-user"></i> <span>Wifi</span> 
              </a>
             
            </li>
              <li class="<?php echo $browser;?>">
              <a href="<?php echo site_url("user/browser").'?id='.$_REQUEST['id'];?>">
                <i class="fa fa-user"></i> <span>Browser History</span> 
              </a>
             
            </li>-->
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
