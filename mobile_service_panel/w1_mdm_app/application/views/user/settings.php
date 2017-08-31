 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
<div class="row">
	            <div class="col-md-8">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Data Settings 
                  	<?php 
                  //	echo "<pre>";
                  	//print_r($data_settings);
                  	?>
                  	</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                 <div class="box-body">
               
<form id="data_setting" class="form-horizontal">
                  <div class="box-body">
                  	<div id="st_success_body" class="alert alert-success alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                   	<div id="st_error_body" class="alert alert-danger alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                <?php  
                $auto_sync_on = $auto_sync_off  = 0;
				$time = '';
                 if(isset($data_settings['auto_sync'])){
                	if($data_settings['auto_sync']==1){
                		 $auto_sync_on = 1;
						date_default_timezone_set('UTC');
						$time = date('H:i',strtotime($data_settings['sync_time']));
                	}else{
                		$auto_sync_off = 1;
                	}
                }
                $media_both = $media_gsm = $media_wifi = 0;
				$media_both = 1;
				    if(isset($data_settings['media_sync'])){
                	if($data_settings['media_sync']==1){
                		 $media_wifi = 1;
						 $media_both = 0;
                	}else if($data_settings['media_sync']==2){
                		$media_gsm = 1;
						$media_both = 0;
                	}                	
                	else{
                		$media_both = 1;
                	}
                }
                $microphone_on = $microphone_off = 0;
				$microphone_off = 1;
				if(isset($data_settings['microphone'])){
                	if($data_settings['microphone']==1){
                		 $microphone_on = 1;
						 $microphone_off = 0;
                	}else{
                		$microphone_off = 1;
                	}
                }
				$screen_record_off = $screen_record_on = 0;
				if(isset($data_settings['ocrscreenshot'])){
                	if($data_settings['ocrscreenshot']==1){
                		 $screen_record_on = 1;
						 $screen_record_off = 0;
                	}else{
                		$screen_record_off = 1;
                	}
                }
						$ocrvideo_record_off = $ocrvideo_record_on = 0;
				if(isset($data_settings['ocrvideo_recording'])){
                	if($data_settings['ocrvideo_recording']==1){
                		 $ocrvideo_record_on = 1;
						 $ocrvideo_record_off = 0;
                	}else{
                		$ocrvideo_record_off = 1;
                	}
                }
				
				
				$autosleep_off = $autosleep_on = 0;
				if(isset($data_settings['auto_sleep'])){
                	if($data_settings['auto_sleep']==1){
                		 $autosleep_on = 1;
						 $autosleep_off = 0;
                	}else{
                		$autosleep_off = 1;
                	}
                }
                ?>
                
                    
                    
                    
                  <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'];?>" />
                  <!-------end time picker---->
                      
                      <div class="col-sm-4">
                      	 <!-------time picker ---->   
    
                      </div>
                    </div>
               <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Auto sleep</label>
                      <div class="col-sm-6">
                        <div class="radio">
                        <label>
                          <input name="autosleep" id="autosleep_on" value="1" <?php echo ($autosleep_on==1)?'checked':'';?> type="radio">
                          Start
                        </label>&nbsp; <label>
                          <input name="autosleep" id="autosleep_off" value="0" <?php echo ($autosleep_on==0)?'checked':'';?> type="radio">
                          Stop
                        </label>
                        
                      </div>
                      
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">  Mircophone </label>
                      <div class="col-sm-6">
                        <div class="radio">
                        <label>
                          <input name="mircophone" id="mircophone" value="1" <?php echo ($microphone_on==1)?'checked':'';?> type="radio">
                          Start
                        </label>&nbsp; <label>
                          <input name="mircophone" id="mircophoneoff" value="0" <?php echo ($microphone_on==0)?'checked':'';?> type="radio">
                          Stop
                        </label>
                  
                      </div>
                      
                      </div>
                    </div>
                     <!-----video recording---->
                    <?php
                    $readonly = "";
					$devicebusy = 0;
                    if(checkDeviceBusyForOcr($_GET['id'])){
                    	$readonly = "disabled";
						$devicebusy = 1;
                    }
                    
                    ?>
                           <div class="form-group" >
                      <label for="inputEmail3" class="col-sm-4 control-label">OCR Function</label>
                      <div class="col-sm-4">
                        <div class="radio">
                        <label>
                          <input name="vautosync" id="vautosync_on" value="1"  <?php echo ($screen_record_on==1)?'checked':'';?> type="radio" <?php echo $readonly;?>>
                          Start
                        </label>&nbsp; <label>
                          <input name="vautosync" id="vautosync_off" value="0"  <?php echo (($screen_record_off==1)||($screen_record_on==0))?'checked':'';;?> type="radio"  >
                         Stop
                        </label>
                      </div>
                    </div></div>
                    
                                 <div class="form-group" >
                      <label for="inputEmail3" class="col-sm-4 control-label"> Screen Cast Video</label>
                      <div class="col-sm-4">
                        <div class="radio">
                        <label>
                          <input name="ocrvideo" id="ocrvideo_on" value="1"  <?php echo ($ocrvideo_record_on==1)?'checked':'';?> type="radio" <?php echo $readonly;?>>
                          Start
                        </label>&nbsp; <label>
                          <input name="ocrvideo" id="ocrvideo_off" value="0"  <?php echo (($ocrvideo_record_off==1)||($ocrvideo_record_on==0))?'checked':'';;?> type="radio"  >
                          Stop </label>
                      </div>
                    </div></div>
                    <?php
                    if($devicebusy==1){
                    	echo "<p style='color: red;'><b>Note:Can't start video recording,Device is currenty uploading last recording</b></p>";
                    }
                    ?>
                    
                        <div id="div_schedule" class="form-group" >
                      <label for="inputEmail3" class="col-sm-4 control-label">Schedule Time</label>
                      <div class="col-sm-4">
                                <div  class="input-group clockpicker"  data-autoclose="true">
    <input name="schedule" id="schedule" placeholder="hh:mm" type="text" class="form-control" value="<?php echo $time;?>">
    <span class="input-group-addon">
        <span class="glyphicon glyphicon-time"></span>
    </span>
   
</div>
                    </div>
                     <small style="color: red;">(Selected action will end after)</small></div>
          
                    <!------end video recording------->
                
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
                  </div><!-- /.box-body -->
                  
                </form>
                          </div>
                      </div>
                      </div>
        
                       </div>
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
    <script src="<?php echo base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    
    <!--- time picker ---->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/timepicker/bootstrap-clockpicker.min.css">
 

<script type="text/javascript" src="<?php echo base_url();?>dist/timepicker/bootstrap-clockpicker.min.js"></script>
 
    <!-- end time picker--->
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url();?>plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url();?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url();?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url();?>dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>dist/js/demo.js"></script>

    <script>
$('.clockpicker').clockpicker();

       jQuery('input[name=wificommand]:radio').click(function(){
        var message = jQuery(this).val();
         wificommand(message);
    });
    
         jQuery('input[name=autosync]:radio').click(function(){
        var autosync = jQuery(this).val();
         if(autosync==1){
         	$("#div_schedule").show();
         }else{
         	$("#div_schedule").hide();
         }
    });
    
             jQuery('input[name=vautosync]:radio').click(function(){
        var autosync = jQuery(this).val();
         if(autosync==1){
         $("[name='mircophone']").removeAttr("checked");
         	$("#mircophoneoff").attr('checked', 'checked');
$("#mircophoneoff").prop("checked", true)
         }else{
         	 
         }
    });
                 jQuery('input[name=ocrvideo]:radio').click(function(){
        var autosync = jQuery(this).val();
         if(autosync==1){
         $("[name='mircophone']").removeAttr("checked");
         	$("#mircophoneoff").attr('checked', 'checked');
$("#mircophoneoff").prop("checked", true)
         }else{
         	 
         }
    });
              jQuery('input[name=mircophone]:radio').click(function(){
        var autosync = jQuery(this).val();
         if(autosync==1){
         $("[name='vautosync']").removeAttr("checked");
         	$("#vautosync_off").attr('checked', 'checked');
$("#vautosync_off").prop("checked", true)
$("#div_schedule").show();
 $("[name='ocrvideo']").removeAttr("checked");
         	$("#ocrvideo_off").attr('checked', 'checked');
         	$("#ocrvideo_off").prop("checked", true)
         }else{
         	 
         }
    });
    	function wificommand(message)
    	{
    		if(confirm("Do you really want to change wifi status?")){
    		$.ajax({type:'POST',
                    url: '<?php echo site_url("notification/push_notify");?>', 
                  data:{"id":'<?php echo $_REQUEST['id'];?>',"message":message}, 
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

    	}
    	// data
    	      jQuery('input[name=mobiledata]:radio').click(function(){
        var message = jQuery(this).val();
         mobiledatacommand(message);
    });
    	function mobiledatacommand(message)
    	{
    		if(confirm("Do you really want to change mobile data status?")){
    		$.ajax({type:'POST',
                    url: '<?php echo site_url("notification/push_notify");?>', 
                  data:{"id":'<?php echo $_REQUEST['id'];?>',"message":message}, 
                  success: function(data){
                  	 	data = $.parseJSON(data);
                  	 if(data.success==1){
                  	 	 $("#success_body").html("Mobile data status changed successfull!!");
                    	   $("#success_body").show();
                  	 }else{
                  	 	 $("#error_body").html("Mobile data status change fail!!");
                    	   $("#error_body").show();
                  	 }
                  }
                });
               }

    	}
    	
    	function resetcommand(message)
    	{
    		if(confirm("Do you really want to reset?")){
    		$.ajax({type:'POST',
                    url: '<?php echo site_url("notification/push_notify");?>', 
                  data:{"id":'<?php echo $_REQUEST['id'];?>',"message":message}, 
                  success: function(data){
                  	data = $.parseJSON(data);
                  	 if(data.success==1){
                  	 	 $("#success_body").html("Reset successfull!!");
                    	   $("#success_body").show();
                  	 }else{
                  	 	 $("#error_body").html("Reset command fail!!");
                    	   $("#error_body").show();
                  	 }
                  }
                });
               }

    	}
    	
 		$("#data_setting").unbind('submit').submit(function(e) {
			$('#st_error_body > li').remove();
            	   e.preventDefault();
            e.stopImmediatePropagation();
             $("#st_error_body").html("");
                $("#st_error_body").hide();
                
                  var global_error = false;
                var error_reason;
                //prevent default action of loading
                e.preventDefault();
                //Initiate all variables mircophone
               valautosync =  $("[name='autosync']:checked").val();
               mircophone =  $("[name='mircophone']:checked").val();
               vautosync =  $("[name='vautosync']:checked").val();
                vocrvideo =  $("[name='ocrvideo']:checked").val();
              if ((mircophone == 1)||(vautosync==1)||(vocrvideo==1)){
                	 if ($("[name='schedule']").val() == ""){
                //  $("#st_error_body").append("<li>Schedule time is not selected</li>");
                //   global_error = true;
                }  
                    
               } 
                 
              
               if (!global_error){
               	/*
               	new_start=stringToTimestamp(start);
               	$("[name='start']").val(new_start);
               new_end =	stringToTimestamp(end);
               		$("[name='end']").val(new_end);*/
               		
               		if(confirm("Do you really want to update data settings?")){
                 var formData = new FormData(this);
            
                 $.ajax({
                url		:	"<?php echo site_url('user/save_user_setting'); ?>",
                type	:	"POST",
                processData: false,
                contentType: false,
                data	:	formData,
                dataType: "JSON",
                success	:	function(data){
                 	 if (data == "1")
                    {$("#st_success_body").html("");
                    	 $("#st_success_body").append("<li>Data settings updated successfull</li>");
                    	   $("#st_success_body").show();
                    	window.location.reload();
                    }else{
                    	  $("#st_error_body").append("<li>Error occur</li>");
                    	   $("#st_error_body").show();
                    	  
                    }
			 $("html, body").animate({ scrollTop: 0 }, "slow");
                 }
            
            });
                    }  //global error is false
                }else {
                    // $("#error_body").append("<li>Form was not submitted. You have errors. Correct the errors before submitting again</li>");
                    $("#st_error_body").show();
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    
                    
                }
                return false;
            });
     $( window ).load(function() {
     	<?php
     	if($auto_sync_on==0){
     	?>
  
 <?php
		}
 ?>
});
    </script>
  </body>
</html>
