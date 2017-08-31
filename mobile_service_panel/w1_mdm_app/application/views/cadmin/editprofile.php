
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Profile
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin');?>"><i class="fa fa-dashboard"></i> Home</a></li>           
            <li class="active">Edit Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="editprofile"  action="" method="post">
                  <div class="box-body">
                  	<div class="form-group">
                                        <ul class="alert alert-danger" id="error_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
                        <div class="form-group">
                                        <ul class="alert alert-success" id="success_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $this->session->userdata('id');?>" />
                  <div class="row">
            <!-- left column -->
            <div class="col-md-6">	
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input type="text" name="name" class="form-control" id="name" value="<?php if(isset($cadmin['name'])){ echo $cadmin['name']; }?>" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="email" class="form-control" id="email" value="<?php if(isset($cadmin['email'])){ echo $cadmin['email']; }?>" placeholder="Enter Email" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Username</label>
                      <input type="text" name="username" class="form-control" id="username" value="<?php if(isset($cadmin['username'])) echo $cadmin['username'];?>" placeholder="Enter Username" >
                    </div>  
                                                          
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    </div>
                  
                     
             </div>
             <div class="col-md-4">
             	
             		<?php if($cadmin_image !=""){
             			$path = PROFILE_PHOTO_PATH.$cadmin_image;
             		}else{
             			$path = PROFILE_PHOTO_PATH.'profile.png';
             		} ?>	
             		<div id="image-holder">
             			<img src="<?php echo $path;?>" alt="profile Photo" height="150" width="150" id="profile_photo" />
             		</div>
             		<input type="file" name="profile_picture" id="profile_picture"/>
             </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="submit"  id="btnsubmit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

            
               
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php $this->view("pages/footer");?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
  
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>dist/js/demo.js"></script>
        <script>
		$("#editprofile").unbind('submit').submit(function(e) {
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
                if ($("[name='name']").val() == ""){
                    $("#error_body").append("<li>Name is empty</li>");
                    global_error = true;
                } 
                  if ($("[name='password']").val() == ""){
                    $("#error_body").append("<li>Password is empty</li>");
                    global_error = true;
                }  
                if ($("[name='newpassword']").val() == ""){
                    $("#error_body").append("<li>New password is empty</li>");
                    global_error = true;
                }   
              
               if (!global_error){
               	/*
               	new_start=stringToTimestamp(start);
               	$("[name='start']").val(new_start);
               new_end =	stringToTimestamp(end);$('#editprofile')
               		$("[name='end']").val(new_end);*/
                 var formData = new FormData(this);
              formData.append('image', $('#profile_picture').prop('files')[0]);

                 $.ajax({
                url		:	"<?php echo site_url('cadmin/dashboard/update_profile'); ?>",
                type	:	"POST",
                processData: false,
                contentType: false,
                cache: false,
                data	:	formData,
                
                success	:	function(data){
               // var responseData =  JSON.stringify(data);
                //alert(responseData); 
                if (data == 1)
                {
                   $("#success_body").append("<li>Profile updated successfull</li>");
                   $("#success_body").show();
                   window.location='<?php echo site_url('cadmin/dashboard'); ?>';
                  }else if(data == 2){
                  	$("#error_body").append("<li>Image not uploaded</li>");
                    $("#error_body").show();	  
                  	}else{
                    $("#error_body").append("<li>Invalid current password</li>");
                    $("#error_body").show();	  
                 }
			 $("html, body").animate({ scrollTop: 0 }, "slow");
                 }
            
            });
                      //global error is false
                }else {
                    // $("#error_body").append("<li>Form was not submitted. You have errors. Correct the errors before submitting again</li>");
                    $("#error_body").show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    if (error_reason)
                        console.log(error_reason);
                    
                }
                return false;
            });
            </script>
   <script type="text/javascript">
   	$('#profile_picture').change(function(){
   	  		 readURL(this);
   	});
   	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#profile_photo').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

	$('#username').change(function(){
		var id = $('#id').val();
	var username = $('#username').val();
	var file= '<?php echo site_url('cadmin/dashboard/checkUsername')?>';
	$.ajax({
		url:file,
		type:"POST",
		data:{"username":username,"id":id},
		success:function(data){
				var response = jQuery.parseJSON(data);
	 			//var response = JSON.parse(responseData);
	 			if(response.status=='1'){
	 				alert("Username alerady exists");
	 				$('#username').val('');
	 				$('#username').focus();
	 			}
		},
		error:function(e){
			alert(JSON.stringify(e));
		}
	});
});

//check email
$('#email').change(function(){
	var id = $('#id').val();
	var email = $('#email').val();
	var file= '<?php echo site_url('cadmin/dashboard/checkemail')?>';
	$.ajax({
		url:file,
		type:"POST",
		data:{"email":email,"id":id},
		success:function(data){
				var response = jQuery.parseJSON(data);
	 			//var response = JSON.parse(responseData);
	 			if(response.status=='1'){
	 				alert("Email alerady exists");
	 				$('#email').val('');
	 				$('#email').focus();
	 			}
		},
		error:function(e){
			alert(JSON.stringify(e));
		}
	});
});

   </script>         
  </body>
</html>
