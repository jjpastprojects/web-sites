<?php
$dashboard=$userlist=$devices="";
if($active_page=='index' )
{
    $dashboard='active';
}
else if($active_page=='users' )
{
    $userlist='active';
}else if($active_page=='devices' )
{
    $devices='active';
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
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
      <!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo base_url();?>plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-----Datetime Picker-
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/datetimepicker/bootstrap-datetimepicker.css">-->
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>

    
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
   setInterval('updateClock()', 1000);
});
</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url("cadmin/dashboard")?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>dmin</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <?php
        $is_superadmin = $this->session->userdata('admin');
				if($is_superadmin){
				$user_id = $this->session->userdata('super_admin_id');	
				}else{
            	$user_id = $this->session->userdata('id');
				}
            	$imageurl =   cadminImage($user_id);
            	?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

          
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $imageurl;?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $imageurl;?>" class="img-circle" alt="User Image">
                    <p>
                     Admin
                      <small>W1 MDM APP</small>
                    </p>
                  </li>
                   
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    	<?php if($this->session->userdata("admin")){?>
                      		<a href="<?php echo site_url('admin/editprofile'); ?>" class="btn btn-default btn-flat">Edit Profile</a>
                      <?php }else{?>
                      		<a href="<?php echo site_url('cadmin/dashboard/editprofile'); ?>" class="btn btn-default btn-flat">Edit Profile</a>
                      	<?php } ?>
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
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            	
            	
              <img src="<?php echo $imageurl;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
            <?php if($this->session->userdata("admin")){ ?>
            <li class="<?php echo $dashboard;?>">
              <a href="<?php echo site_url("admin");?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
             
            </li>
            <?php }else{ ?>
             <li class="<?php echo $dashboard;?>">
              <a href="<?php echo site_url("cadmin/dashboard");?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
             <li class="<?php echo $userlist;?>">
              <a href="<?php echo site_url("cadmin/dashboard/users");?>">
                <i class="fa fa-user "></i> <span>Users</span> 
              </a>
            </li>     
               <li class="<?php echo $devices;?>">
              <a href="<?php echo site_url("cadmin/dashboard/devices");?>">
                <i class="fa fa-mobile "></i> <span>Devices</span> 
              </a>
            </li>          
            <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
