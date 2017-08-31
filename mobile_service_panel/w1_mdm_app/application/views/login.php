<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | Log in</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .login-page{
    	 background: url('<?php echo  base_url();?>dist/img/bg.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
   
  
  }

    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="" style="color: #fff;"><b>Admin </b>Panel</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form id="login" action="" method="post">
        		<div class="form-group">
                                        <ul class="alert alert-danger" id="error_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
                        <div class="form-group">
                                        <ul class="alert alert-success" id="success_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username or Email">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
            <!--  <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>-->
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit"  id="loginsubmit"  class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

     
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
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
					var responseData =  JSON.stringify(data);
	 				var response = JSON.parse(responseData);		
                 	 if ( response.status == 1)
                    {
                    	//alert(response);
                    	 $("#success_body").append("<li>Login successfull</li>");
                    	   $("#success_body").show();
                    	 if(response.role=="ADMIN")
                    	 {  
                    		window.location=response.admin_dashboard;
                    	 }else{
                    	 	window.location=response.cadmin_dashboard;
                    	 }
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
