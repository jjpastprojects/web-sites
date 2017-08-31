<?php
$dashboard=$userlist=$ocr="";
if($active_page=='index' )
{
    $dashboard='active';
}
else if($active_page=='users' )
{
    $userlist='active';
}else if($active_page=='ocr' )
{
    $ocr='active';
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
<title>Admin Panel</title>
<!-- Fontawesome icon CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/vendor/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/vendor/bootstrap4alpha/css/bootstrap.css" type="text/css">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url();?>dist/vendor/datatables/css/dataTables.bootstrap4.css" rel="stylesheet">
<link href="<?php echo base_url();?>dist/vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">

<!-- jvectormap CSS -->
<link href="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">

<!-- Adminux CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/css/dark_blue_adminux.css" type="text/css">

   <link rel="stylesheet" href="<?php echo base_url();?>dist/css/custom.css">
</head>
<body class="menuclose menuclose-right">
<!-- Page Loader -->
<div class="loader_wrapper align-items-center text-center">
  <div class="load7 load-wrapper">
    <img src="<?php echo base_url();?>dist/img/logo.png" alt="" class="loading_img">
    <div class="loader"> Loading... </div>
    <div class="clearfix"></div>
    <br>
    <br>
    <br>
    <br>
    <h4 class="text-white">Admin Panel</h4>
    <p> </p>
  </div>
</div>
<!-- Page Loader Ends -->

<header class="navbar-fixed">
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
    <div class="sidebar-left"> <a class="navbar-brand imglogo" href="<?php echo site_url("admin");?>"></a>
      <button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
    </div>
   <!-- <form class="form-inline mr-sm-2  pull-left search-header hidden-md-down">
      <input class="form-control " type="text" placeholder="Search" id="search_header">
      <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
    </form>--->
    <div class="d-flex mr-auto"> &nbsp;</div>
    <ul class="navbar-nav content-right">
       
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
      <button class="media btn btn-link dropdown-toggle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="message_userpic"><img class="d-flex" src="<?php echo base_url();?>dist/img/user.png" alt="Generic user image"></span> <span class="media-body"> <span class="mt-0 mb-1">Admin</span>   </span> </button>
      <div class="dropdown-menu"> <a class="dropdown-item" href="<?php echo site_url('admin/editprofile'); ?>">Change Password</a> 
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a> </div>
    </div>
  </div>
  <br>
  <ul class="nav flex-column in" id="side-menu">
 
    <li class="title-nav"> MENU</li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("admin");?>"><i class="fa fa-tachometer left-icon square"></i>Dashboard</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("admin/users");?>"><i class="fa fa-users left-icon square"></i>User list</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="<?php echo site_url("admin/ocr_applist");?>"><i class="fa fa-picture-o  left-icon circle"></i>Ocr App Listing</a> </li>
     
  </ul>
  
  
</div>