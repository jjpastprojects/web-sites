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
    <h4 class="text-white">Petal of Flower</h4>
    <p>Awesome things are getting ready...</p>
  </div>
</div>
<!-- Page Loader Ends -->

<header class="navbar-fixed">
  <nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
    <div class="sidebar-left"> <a class="navbar-brand imglogo" href="<?php echo site_url("admin");?>"></a>
      <button class="btn btn-link icon-header mr-sm-2 pull-right menu-collapse" ><span class="fa fa-bars"></span></button>
    </div>
    <form class="form-inline mr-sm-2  pull-left search-header hidden-md-down">
      <input class="form-control " type="text" placeholder="Search" id="search_header">
      <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
    </form>
    <div class="d-flex mr-auto"> &nbsp;</div>
    <ul class="navbar-nav content-right">
      <li class="align-self-center hidden-md-down"> <a  href="https://themeforest.net/item/adminux-dashboard-responsive-html/19761213?ref=Maxartkiller" class="btn btn-sm btn-primary mr-2"><span class="fa fa-shopping-basket "></span> Buy Now!</a> </li>
      <li class="v-devider"></li>
      <li class="nav-item active">
        <button class="btn btn-link icon-header "  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-envelope-o"></span> <span class="badge-number bg-success"></span></button>
        <div class="dropdown-menu message-container">
          <div class="list-unstyled"> <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="<?php echo base_url()?>dist/img/user-header.png" alt="Generic user image"></span>
            <div class="media-body">
              <h6 class="mt-0 mb-1">Dhananjay Chauhan</h6>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
            </a> <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
            <div class="media-body">
              <h6 class="mt-0 mb-1">Max Smith</h6>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
            </a> <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
            <div class="media-body">
              <h6 class="mt-0 mb-1">Astha Smith</h6>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
            </a> <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
            <div class="media-body">
              <h6 class="mt-0 mb-1">Tommy Cruszii</h6>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
            </a> <a href="#" class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
            <div class="media-body">
              <h6 class="mt-0 mb-1">Max Smith</h6>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
            </a> </div>
        </div>
      </li>
      <li class="nav-item">
        <button class="btn btn-link icon-header badgeCircle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell-o"></span><span class="badge-number bg-danger"></span></button>
        <div class="dropdown-menu message-container">
          <div class="list-unstyled">
            <div class="media"> <span class="alert-block bg-primary"><span class="fa fa-bullhorn"></span></span>
              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
            </div>
            <div class="media"> <span class="alert-block bg-warning"><span class="fa fa-bell-o"></span></span>
              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
            </div>
            <div class="media"> <span class="alert-block bg-danger"><span class="fa fa-exclamation-triangle"></span></span>
              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
            </div>
            <div class="media">
              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
            </div>
            <div class="media">
              <div class="media-body"><b>Max Smith</b> updated post of <b>Astha Smith</b>. Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item hidden-xs-down">
        <button class="btn btn-link icon-header " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-th"></span> </button>
        <div class="dropdown-menu message-container box-links">
          <div class="list-unstyled"> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-bullhorn"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-bell-o"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-calendar"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-id-card"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-handshake-o"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-camera-retro"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-flask"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-plane"></span></span> </a> <a href="?#" class="media"> <span class="quick-block "><span class="fa fa-pie-chart"></span></span> </a> </div>
        </div>
      </li>
      <li class="v-devider"></li>
      <li class="nav-item "> <a class="btn btn-link icon-header menu-collapse-right" href="#"><span class="fa fa-podcast"></span> </a> </li>
    </ul>
    <div class="sidebar-right pull-right " >
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item">
          <button class="btn-link btn userprofile"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="userpic"><img src="<?php echo base_url();?>dist/img/user.png" alt="user pic"></span> <span class="text">Admin</span></button>
          <div class="dropdown-menu"> <a class="dropdown-item" href="<?php echo site_url('admin/editprofile'); ?>">Change Password</a>  
             
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
      <button class="media btn btn-link dropdown-toggle"   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="message_userpic"><img class="d-flex" src="<?php echo base_url();?>dist/img/user.png" alt="Generic user image"></span> <span class="media-body"> <span class="mt-0 mb-1">Admin</span> <small>New Jersey, UK.</small> </span> </button>
      <div class="dropdown-menu"> <a class="dropdown-item" href="customerprofile.html">Profile</a> <a class="dropdown-item" href="inbox.html">Mailbox</a> <a class="dropdown-item" href="#">Application</a> <a class="dropdown-item" href="#">Analytics Report</a> <a class="dropdown-item" href="#">Preferances</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Setting</a> </div>
    </div>
  </div>
  <br>
  <ul class="nav flex-column in" id="side-menu">
    <li class="title-nav">MENU</li>
    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Dashboard<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level ">
        <li class=" nav-item"><a  href="index.html" class="nav-link "><i class="fa fa-globe"></i> Menufacturing</a></li>
        <li class="nav-item"><a class="nav-link" href="networking.html"><i class="fa fa-dashboard"></i> Networking</a></li>
        <li class="nav-item"><a class="nav-link" href="entertainment.html"><i class="fa fa-play"></i> Entertainment</a></li>
        <li class="nav-item"><a class="nav-link" href="social.html"><i class="fa fa-bullhorn"></i> Social</a></li>
        <li class="nav-item"><a class="nav-link" href="todo_task.html"><i class="fa fa-check-square-o"></i> ToDo</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">App Pages<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="inbox.html" class="nav-link ">Mailbox</a></li>
        <li class="nav-item"><a  href="chat.html" class="nav-link ">Chat app</a></li>
        <li class="nav-item"><a  href="file_manager.html" class="nav-link ">File Manager</a></li>
        <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Forum Module <span class="badge badge-danger ml-2">New</span> <i class="fa fa-angle-down "></i></a>
          <ul class="nav flex-column nav-third-level">
            <li class="nav-item"><a class="nav-link" href="forum.html">Forum</a></li>
            <li class="nav-item"><a class="nav-link" href="forum_details.html">Forum Deatails</a></li>
            <li class="nav-item"><a class="nav-link" href="forum_topic_details.html">Forum Topic Details</a></li>
          </ul>
          <!-- /.nav-third-level --> 
        </li>
        <li class="nav-item"><a class="nav-link" href="userlist.html">User List</a></li>
        <li class="nav-item"><a class="nav-link" href="socialprofile.html">Social Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="calendar.html">Calendar</a></li>
        <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li>
        <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="contactus.html">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="blogs.html">Blogs</a></li>
        <li class="nav-item"><a class="nav-link" href="blogdetails.html">Blog Details</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">eCommerce <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li  class="nav-item"><a class="nav-link" href="products.html">Products</a></li>
        <li  class="nav-item"><a class="nav-link" href="product_details.html">Product Details</a></li>
         
        <li  class="nav-item"><a class="nav-link" href="orderstatus.html">Order status</a></li>
        <li  class="nav-item"><a class="nav-link" href="checkout.html">Checkout/Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="invoice.html">Invoice 1<sup>st</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="invoice2.html">Invoice 2<sup>nd</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="customerprofile.html">Customer Profile</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">Other Pages <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="blank.html">Blank Page</a></li>
        <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Sign in <i class="fa fa-angle-down "></i></a>
          <ul class="nav flex-column nav-third-level">
            <li class="nav-item"><a class="nav-link" href="sign-in1.html">Sign in 1</a></li>
            <li class="nav-item"><a class="nav-link" href="sign-in2.html">Sign in 2</a></li>
            <li class="nav-item"><a class="nav-link" href="sign-in3.html">Sign in 3</a></li>
            <li class="nav-item"><a class="nav-link" href="sign-in4.html">Sign in 4</a></li>
            <li class="nav-item"><a class="nav-link" href="sign-in5.html">Sign in 5</a></li>
            <li class="nav-item"><a class="nav-link" href="sign-in6.html">Sign in 6</a></li>
          </ul>
          <!-- /.nav-third-level --> 
        </li>
        <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Register <i class="fa fa-angle-down "></i></a>
        <ul class="nav flex-column nav-third-level">
          <li class="nav-item"><a class="nav-link" href="sign-up1.html">Register 1</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up2.html">Register 2</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up3.html">Register 3</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up4.html">Register 4</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up5.html">Register 5</a></li>
          <li class="nav-item"><a class="nav-link" href="sign-up6.html">Register 6</a></li>
        </ul>
        <!-- /.nav-third-level --> 
      </li>
      <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Reset Password <i class="fa fa-angle-down "></i></a>
        <ul class="nav flex-column nav-third-level">
          <li class="nav-item"><a class="nav-link" href="reset_password1.html">Reset Password 1</a></li>
          <li class="nav-item"><a class="nav-link" href="reset_password2.html">Reset Password 2</a></li>
          <li class="nav-item"><a class="nav-link" href="reset_password3.html">Reset Password 3</a></li>
          <li class="nav-item"><a class="nav-link" href="reset_password4.html">Reset Password 4</a></li>
        </ul>
        <!-- /.nav-third-level --> 
      </li>
        <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Lock<i class="fa fa-angle-down "></i></a>
          <ul class="nav flex-column nav-third-level">
            <li class="nav-item"><a class="nav-link" href="lock1.html">Lock 1</a></li>
            <li class="nav-item"><a class="nav-link" href="lock2.html">Lock 2</a></li>
            <li class="nav-item"><a class="nav-link" href="lock3.html">Lock 3</a></li>
            <li class="nav-item"><a class="nav-link" href="lock4.html">Lock 4</a></li>
            <li class="nav-item"><a class="nav-link" href="lock5.html">Lock 5</a></li>
            <li class="nav-item"><a class="nav-link" href="lock6.html">Lock 6</a></li>
          </ul>
          <!-- /.nav-third-level --> 
        </li>
        <li class="nav-item"><a class="nav-link" href="404.html">404 1<sup>st</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="404_2.html">404 2<sup>nd</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="500.html">500 1<sup>st</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="500_2.html">500 2<sup>nd</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="searchresult.html">Search Result</a></li>
        <li class="nav-item"><a class="nav-link" href="faqs.html">FAQs</a></li>
        <li class="nav-item"><a class="nav-link" href="commingsoon.html">Coming Soon 1<sup>st</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="commingsoon2.html">Coming Soon 2<sup>nd</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="commingsoon3.html">Coming Soon 3<sup>rd</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="cookie.html">Cookie</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">Charts &amp; Maps<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="flotjs.html">Flot Charts</a> </li>
        <li class="nav-item"><a class="nav-link" href="morrisjs.html">Morris.js Charts</a></li>
        <li class="nav-item"><a class="nav-link" href="chartjs.html">Chart.js Charts</a></li>
        <li class="nav-item"><a class="nav-link" href="amchart.html">amCharts</a></li>
        <li class="nav-item"><a class="nav-link" href="jvectormap.html">jVectormap</a></li>
        <li class="nav-item"><a class="nav-link" href="googlemap.html">Google map 1<sup>st</sup></a></li>
        <li class="nav-item"><a class="nav-link" href="google_map_half.html">Google map 2<sup>nd</sup></a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="menudropdown nav-link">Landing pages <span class="badge badge-primary ml-2">Free</span> <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="../landing_pages/landing1.html" target="_blank">Font-end 1</a></li>
        <li class="nav-item"><a class="nav-link" href="../landing_pages/landing2.html" target="_blank">Font-end 2</a></li>
        <li class="nav-item"><a class="nav-link" href="../landing_pages/landing3.html" target="_blank">Font-end 3</a></li>
        <li class="nav-item"><a class="nav-link" href="../landing_pages/landing4.html" target="_blank">Font-end 4</a></li>
      </ul>
    </li>
    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Layout<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="in nav-item"><a  href="left-menu-only.html" class="nav-link ">Left Sidebar only</a></li>
         <li class="in nav-item"><a  href="fixedheader.html" class="nav-link ">Fixed Header</a></li>
        <li class="in nav-item"><a  href="scrollheader.html" class="nav-link ">Hide Header</a></li>
        <li class="in nav-item"><a  href="boxedlayout.html" class="nav-link ">Boxed Page</a></li>
        <li class="in nav-item"><a  href="boxedlayout_fixed_header.html" class="nav-link ">Boxed + Header fix</a></li>
        <li class="in nav-item"><a  href="horizontalnav.html" class="nav-link ">Horizontal Menu</a></li>
        <li class="in nav-item"><a  href="rounded.html" class="nav-link ">More Rounded</a></li>
        <li class="in nav-item"><a  href="rtl_read.html" class="nav-link ">RTL</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item "> <a href="javascript:void(0)" class="menudropdown nav-link">Icons <span class="badge badge-danger ml-2">New</span> <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level ">
        <li class="nav-item"><a class="nav-link" href="icons.html">Font awesome</a></li>
        <li class="nav-item"><a class="nav-link" href="icon_themify.html">Themify icons</a></li>
        <li class="nav-item"><a class="nav-link" href="icon_weather.html">Weather icons</a></li>
        <li class="nav-item"><a class="nav-link" href="flags.html">Flags icons</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="nav-link menudropdown">Controls Library <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="wizards.html">Wizards</a></li>
        <li class="nav-item"><a class="nav-link" href="timeline.html">Timeline</a></li>
        <li class="nav-item"><a class="nav-link" href="cards.html">Cards</a></li>
        <li class="nav-item"><a class="nav-link" href="accordion.html">Accordion</a></li>
        <li class="nav-item"><a class="nav-link" href="Tabs.html">Tabs</a></li>
        <li class="nav-item"><a class="nav-link" href="buttons.html">Buttons</a></li>
        <li class="nav-item"><a class="nav-link" href="alerts_notes.html">Alerts and Notes</a></li>
        <li class="nav-item"><a class="nav-link" href="breadcrumb.html">BreadCrumb</a></li>
        <li class="nav-item"><a class="nav-link" href="modal.html">Modal</a></li>
        <li class="nav-item"><a class="nav-link" href="popover.html">Popover</a></li>
        <li class="nav-item"><a class="nav-link" href="typography.html">Typography</a></li>
        <li class="nav-item"><a class="nav-link" href="grid.html">Grid</a></li>
        <li class="nav-item"><a class="nav-link" href="progressbar.html">Progress bar</a></li>
        <li class="nav-item"><a class="nav-link" href="rangeslider.html">Range Slider</a></li>
        <li class="nav-item"><a class="nav-link" href="dropdown.html">Dropdown</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="nav-link menudropdown">Advance Controls<span class="badge badge-danger ml-2">New</span> <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="multiselect.html">Multi Select</a></li>
        <li class="nav-item"><a class="nav-link" href="picker.html">Picker</a></li>
        <li class="nav-item"><a class="nav-link" href="clipboard.html">Clipboard</a></li>
        <li class="nav-item"><a class="nav-link" href="autocomplete.html">Autocomplete</a></li>
        <li class="nav-item"><a class="nav-link" href="switch.html">Switch</a></li>
        <li class="nav-item"><a class="nav-link" href="contextmenu.html">Context Menu</a></li>
        <li class="nav-item"><a class="nav-link" href="ckeditor.html">ckeditor</a></li>
        <li class="nav-item"><a class="nav-link" href="notifications.html">Toast Message</a></li>
        <li class="nav-item"><a class="nav-link" href="treeview.html">Tree View</a></li>
        <li class="nav-item"><a class="nav-link" href="dragable.html">Dragable/Sortable</a></li>
        <li class="nav-item"><a class="nav-link" href="tour_intro.html">Tour/Intro</a></li>
        <li class="nav-item"><a class="nav-link" href="loaders.html">Loaders</a></li>
        <li class="nav-item"><a class="nav-link" href="dropzone.html">Dropzone js</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
      
    <li class="nav-item"> <a href="javascript:void(0)" class="nav-link menudropdown">Classic Forms<span class="badge badge-success ml-2">Trending</span> <i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="form_credit_card2.html">Crefit Card Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_credit_card.html">Crefit Card Form 2</a></li>
        <li class="nav-item"><a class="nav-link" href="form_donation.html">Donation Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_authorization.html">Authority Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_employee_review.html">Employee review Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_profile_info.html">Profile Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_survay_review.html">Survay Form</a></li>
        <li class="nav-item"><a class="nav-link" href="form_booking.html">Booking Form</a></li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
      
    <li class="title-nav">
      <hr>
    </li>
    <li class="title-nav">icon + MENU</li>
    <li  class="nav-item"> <a class="nav-link" href="tables.html"><i class="fa fa-table left-icon square"></i>Tables</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="datatables.html"><i class="fa fa-th left-icon square"></i>DataTables</a> </li>
    <li  class="nav-item"> <a class="nav-link" href="footable.html"><i class="fa fa-file-o left-icon circle"></i>FooTables</a> </li>
    <li class="nav-item"> <a class="nav-link" href="forms.html"><i class="fa fa-file-o left-icon circle"></i>Forms</a> </li>
    <li class="nav-item"> <a href="javascript:void(0)" class="nav-link menudropdown ">Multi-Level Dropdown<i class="fa fa-angle-down "></i></a>
      <ul class="nav flex-column nav-second-level">
        <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Second Level Item</a> </li>
        <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Second Level Item</a> </li>
        <!-- .nav-third-level menudropdown2 -->
        <li class="nav-item"><a href="javascript:void(0)" class="menudropdown nav-link">Third Level <i class="fa fa-angle-down "></i></a>
          <ul class="nav flex-column nav-third-level">
            <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Third Level Item</a> </li>
            <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Third Level Item</a> </li>
            <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Third Level Item</a> </li>
            <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Third Level Item</a> </li>
          </ul>
          <!-- /.nav-third-level --> 
        </li>
      </ul>
      <!-- /.nav-second-level --> 
    </li>
  </ul>
  <hr>
  <ul class="nav flex-column in" >
    <li class="title-nav">Activity States</li>
    <li class="nav-item "><a href="#" class="nav-link"><span><span class="dynamicsparkline2">Loading..</span> </span><br>
      Daily activity</a></li>
  </ul>
  <hr>
  <ul class="nav flex-column in">
    <li class="title-nav">Next Meeting</li>
    <li class="nav-item "> 
<div class="nav-link">
    <h5>12:30 PM, Today <span class="fa fa-bell-o pull-right"></span></h5>
    <span class="meeting-subject">Agenda: Team mnufacturing review meeting. Board Compulsory</span> 
    <div class="">
      <button class="btn btn-outline-success btn-round mr-sm-2">Snooz</button>
      <button class="btn btn-outline-danger btn-round ">Dismiss</button>
    </div>
    </div>
  </li>
  </ul>
  <br>
  <br>
</div>