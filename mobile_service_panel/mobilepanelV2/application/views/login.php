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

<!-- Adminux CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>dist/css/dark_blue_adminux.css" type="text/css">
</head>
<body class="menuclose menuclose-right">
<figure class="background"> <img src="<?php echo base_url();?>dist/img/login_bg.jpg" alt="Adminux- sign in "> </figure>
<!-- Page Loader -->
<div class="loader_wrapper inner align-items-center text-center">
  <div class="load7 load-wrapper">
    <div class="loading_img"></div>
    <div class="loader"> Loading... </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Page Loader Ends -->


<header class="navbar-fixed">
    <nav class="navbar navbar-toggleable-md sign-in-header">
      <div class="sidebar-left">  <a class="navbar-brand imglogo" href="index.html"></a> </div>
      <div class="col"></div>
      <div class="sidebar-right pull-right" >
      <!--  <ul class="navbar-nav  justify-content-end">
          <li><a href="#" class="btn btn-link text-white" >Need Help ?</a></li>
          <li><a href="index.html" class="btn btn-primary " >Register</a></li>
        </ul>-->
      </div>
    </nav>
</header>
<div class="wrapper-content-sign-in ">
  <div class="container text-center">
    <form id="login" class="form-signin1 smallbox">
      <h2 class="tex-black mb-4">Admin Panel</h2>
      	<div class="form-group">
                                        <ul class="alert alert-danger" id="error_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
                        <div class="form-group">
                                        <ul class="alert alert-success" id="success_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
      <label  class="sr-only">Username</label>
      <input type="text"   name="username" id="username" class="form-control" placeholder="Username" >
      <br>
      <label class="sr-only">Password</label>
      <input type="password" name="password" id="password"  class="form-control" placeholder="Paassword" >
      <br>
    
      <button type="submit" name="submit"  id="loginsubmit"   class="btn btn-lg btn-primary btn-round">Sign in</button><br>
       
    </form>
     
  </div>
 <!-- <footer class="footer-content row  justify-content-between align-items-center">
    <div class="col-sm-8">This template is designed by <a href="http://www.maxartkiller.in" target="_blank" class="">www.maxartkiller.in</a></div>
    <div class="col-sm-8 text-right"><a href="#" target="_blank" class="">Privacy Policy</a> | <a href="#" target="_blank" class="">Terms of use</a> </div>
  </footer> 
</div>
 
-->
<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="<?php echo base_url();?>dist/js/jquery-2.1.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>dist/vendor/bootstrap4alpha/js/tether.min.js"></script> 

<script src="<?php echo base_url();?>dist/vendor/bootstrap4alpha/js/bootstrap.min.js" type="text/javascript"></script> 

<!--Cookie js for theme chooser and applying it --> 
<script src="<?php echo base_url();?>dist/vendor/cookie/jquery.cookie.js"  type="text/javascript"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> <script src="<?php echo base_url();?>dist/js/ie10-viewport-bug-workaround.js"></script> <script>
       "use strict";
        $('input[type="checkbox"]').on('change', function(){
            $(this).parent().toggleClass("active")
            $(this).closest(".media").toggleClass("active");
        }); 
        $(window).on("load", function(){
            /* loading screen */
            $(".loader_wrapper").fadeOut("slow");
        });
        
      </script>
      
          <script>
		$("#login").unbind('submit').submit(function(e) {
			$('#error_body > li').remove();
            	   e.preventDefault();
            e.stopImmediatePropagation();
             $("#error_body").html("");
                $("#error_body").hide();
                
                  var global_error = false;
                var error_reason;
                //prevent default action of loading
                e.preventDefault();
                //Initiate all variables
                if ($("[name='username']").val() == ""){
                    $("#error_body").append("<li>Username is empty</li>");
                    global_error = true;
                } 
                  if ($("[name='password']").val() == ""){
                    $("#error_body").append("<li>Password is empty</li>");
                    global_error = true;
                }   
              
               if (!global_error){
               	/*
               	new_start=stringToTimestamp(start);
               	$("[name='start']").val(new_start);
               new_end =	stringToTimestamp(end);
               		$("[name='end']").val(new_end);*/
                 var formData = new FormData(this);
            
                 $.ajax({
                url		:	"<?php echo site_url('login/submit'); ?>",
                type	:	"POST",
                processData: false,
                contentType: false,
                data	:	formData,
                dataType: "JSON",
                success	:	function(data){
                 	 if (data == "1")
                    {
                    	 $("#success_body").append("<li>Login successfull</li>");
                    	   $("#success_body").show();
                    	window.location='<?php echo site_url('admin'); ?>';
                    }else{
                    	  $("#error_body").append("<li>Invalid username or password</li>");
                    	   $("#error_body").show();
                    	  
                    }
			
                 }
            
            });
                      //global error is false
                }else {
                    // $("#error_body").append("<li>Form was not submitted. You have errors. Correct the errors before submitting again</li>");
                    $("#error_body").show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    if (error_reason)
                        console.log(error_reason);
                   $("#new_event_submit").prop('disabled', false);
                }
                return false;
            });
            
</script>
</body>
</html>