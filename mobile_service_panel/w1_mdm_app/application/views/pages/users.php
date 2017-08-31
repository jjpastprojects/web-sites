

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Devices list
            
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Devices list</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
           
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table-grid" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr.no.</th>
                        <th>View</th>
                         <th>Device Name</th>
                        <th>Unique ID</th>  <th>Device Status</th>
                                     <th>Datetime</th>
                       
         <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Sr.no.</th>
                        <th>View</th>
                         <th>Device Name</th>
                        <th>Unique ID</th>  <th>Device Status</th>
                                     <th>Datetime</th>
                       
                       
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
 <!---model Start------------->
<div id="factoryreset" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #3C8DBC;color: #fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Factory Reset</b></h4>
      </div>
      <div class="modal-body" style="background-color: #A0D4FF;">
         <div class="form-group">
    		<select id="factory_reset"class="form-control">
    			<option value="">Select Factory Reset Device Type</option>
    			<option value="1">By Sms</option>
    			<!-- <option value="2">By Command</option> -->
    		</select>
    		<input type="hidden" id="reser_uuid" />
    		<div class="form-group" style="display: none" id="hide_text_box">
    		<label>Reset Command Will send to this Number:</label>
    		<input type="text" id="phone_nu" name="phone_nu" class="form-control"/>
    		</div>
  		</div>
      </div>
      <div class="modal-footer" style="background-color: #3C8DBC;color: #fff;">
        <button type="button" class="btn btn-default" id="btnfactoryreset">Submit</button>
      </div>
    </div>

  </div>
</div>
 <!--------model end----------> 
 
  <!---model Start------------->
<div id="factoryresetbyschedule" class="modal fade"  role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content" style="height: 500px!important;">
      <div class="modal-header" style="background-color: #3C8DBC;color: #fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Factory Reset By Schedule</b></h4>
      </div>
      <div class="modal-body" style="height:100%; background-color: #A0D4FF;">
         <div class="form-group">
         	<input type="hidden" id="uuid_id"/>
         	<label style="text-align:left !important;">Factory Reset Schedule</label>
    		<input type="text" id="factoryschedule" class="form-control" placeholder="Select Schedule for Factory Reset"/><br>
    		
  		</div>
  		<div class="form-group">
  			<label>Reset Command Will send to this Number:</label>
  			<input type="text" name="schedule_phone_nu" id="schedule_phone_nu" class="form-control" />
  		</div>
  		
  		<!-- <label id="factoryscheduletext" style="display: none;text-align: center;color:green;"></label> -->
      </div>
      <div class="modal-footer" style=" background-color: #3C8DBC;color: #fff;">
        <button type="button" class="btn btn-default" id='factoryresetschedule'>Submit</button>
      </div>
    </div>

  </div>
</div>
 <!--------model end----------> 
     
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
  <link rel="stylesheet" href="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.css">
   
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    

    <!-- bootstrap datepicker -->
	<script src="<?php echo base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>    
    <script src="<?php echo base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>dist/js/demo.js"></script>
        <!-- Moment Plugin Js -->
    <script src="<?php echo base_url();?>plugins/momentjs/moment.js"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="<?php echo base_url()?>plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>    
        
    <!-- page script -->
        <!------------CUSTOM SCRIPT------------------>
	<script type="text/javascript">
		//$('#factoryschedule').datetimepicker();
		    $('#factoryschedule').bootstrapMaterialDatePicker({
        format: 'DD-MM-YYYY HH:mm:ss',
        clearButton: true,
        weekStart: 1,
        minDate : new Date()
    });
	</script>
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
      
      			$(document).ready(function() {
				var dataTable = $('#table-grid').DataTable( {
					"processing": true,
					"serverSide": true,	
					 "order": [[ 0, "desc" ]],						
					"ajax":{
						url :'<?=site_url('dt_con/get_userlist_dt');?>', // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
    </script>
    <script type="text/javascript">
    //set uuid for drop down
    function set_reset_uuid(uuid,phone_number)
    {
    	$('#reser_uuid').val(uuid);
    	if(phone_number!="")
    	{
    		$('#phone_nu').val(phone_number);
    	}
    	else
    	{
    		$('#phone_nu').val('');
    	}
    }
    
    function cancleRequest(uuid)
{
	 
	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/cancleRequest");?>', 
                  data: {'id':uuid},
                  success: function(data){
                  	 
 

}
                });
               
}
    
    //set uuid when calling from mode;
    function set_uuid(uuid,factoryschedule,phone_nu)
    {
    	//alert(factoryschedule);
    	$('#uuid_id').val(uuid);
    	
    	if(factoryschedule!='0000-00-00 00:00:00'){
    		//$('#factoryscheduletext').css('display','block');
    		//$('#factoryscheduletext').html('<b>You have already select factory rest schedule:"'+factoryschedule+'"</b>');
   
    		$('#factoryschedule').val(factoryschedule);
    	
    	}else{
    		$('#factoryscheduletext').html('');
    		$('#factoryscheduletext').css('display','none');
    	}
    	if(phone_nu!="")
    	{
    		$('#schedule_phone_nu').val(phone_nu);
    	}else{
    		$('#schedule_phone_nu').val('');
    	}
    }
    	//on change event for showing text for phone nu 
    	$('#factory_reset').change(function(){
    		var factoryRestCommand = $('#factory_reset').val()
    		if(factoryRestCommand==1)
    		{
    			$('#hide_text_box').css('display',"block");
    		}
    		else
    		{
    			$('#hide_text_box').css('display',"none");
    		}
    	});
		//action for on clicking function  for factory schedule  
    	$('#factoryresetschedule').click(function(){
    	   var factoryresetschedule= $('#factoryschedule').val();
    	   var uuid = $('#uuid_id').val();
    	   var phone_nu = $('#schedule_phone_nu').val();
    	   //alert(uuid);
    	   if(factoryresetschedule!=""){
    	   		if(phone_nu!=""){
    		 $.ajax({type:'POST',
                     url: '<?php echo site_url('dt_con/factoryresetsave');?>',
                     data:{"factroyschedule":factoryresetschedule ,"uuid":uuid,"phone_nu":phone_nu
                     },
                     success: function(response) {
                     	var ResponseData=jQuery.parseJSON(response);
						if(ResponseData.status==1)
						{
							alert(ResponseData.message);
							$('#factoryresetbyschedule').modal('hide');
							window.location.reload();
						}
						else
						{
							alert(ResponseData.message);
							$('#factoryresetbyschedule').hide();							
						}			
                      },
                      error:function (e)
                      {
                      	alert(JSON.stringify(e));
                      	removeOverlay();
                      	
                      }
             });
            }else{
            	alert("please enter Phone nu");
            	$('#schedule_phone_nu').focus();
            }
            }else{
            	alert("Please Select Factory Reset Schedule");
            }
    	});
    	
    	//factory reset click
    	$('#btnfactoryreset').click(function(){
    		//alert("asd");
    		var factoryRestCommand = $('#factory_reset').val()
    		if(factoryRestCommand=="")
    		{
    			alert("please select Factory reset command");
    		}
    		if(factoryRestCommand==1)
    		{
    			//call ajax to save phone numer
    			var uuid=$('#reser_uuid').val();
    			var phone_nu = $('#phone_nu').val();
    			if(phone_nu!=""){
    			$.ajax({type:'POST',
                    url: '<?php echo site_url("dt_con/factoryPhone");?>', 
                  	data:{"id":uuid,"phone_nu":phone_nu}, 
                   	success: function(data){
                  	data = $.parseJSON(data);
                  	 if(data.success==1){
                  	 	// $("#success_body").html("Reset successfull!!");
                    	  // $("#success_body").show();
                    	  alert(data.message);
                    	  $('#factoryreset').modal('hide');
                    	  window.location.reload();
                  	 }else{
                  	 	 //$("#error_body").html("Reset command fail!!");
                    	   //$("#error_body").show();
                    	   alert(data.message);
                  	 }
                  }
                });
                }else{
                	alert("Please enter phone number.");
                	$('#phone_nu').val('');
                }    			
    		}
    		if(factoryRestCommand == 2)
    		{
    			//alert($('#reser_uuid').val());
    			if(confirm("Do you really want to reset?")){
    				var uuid=$('#reser_uuid').val();
    				$.ajax({type:'POST',
                    url: '<?php echo site_url("notification/push_notify");?>', 
                  data:{"id":uuid,"message":"LOCK-PHONE"}, 
                  success: function(data){
                  	data = $.parseJSON(data);
                  	 if(data.success==1){
                  	 	// $("#success_body").html("Reset successfull!!");
                    	  // $("#success_body").show();
                    	  alert("Reset successfull!!");
                    	  window.location.reload();
                  	 }else{
                  	 	 //$("#error_body").html("Reset command fail!!");
                    	   //$("#error_body").show();
                    	   alert('Reset command fail!!');
                  	 }
                  }
                });
               }
    		}
    	});
    			function make_device_ready(uuid,device_status)
			{
				//alert(uuid);
			 
				 $.ajax({
                url		:	"<?php echo site_url("user/make_device_Ready")?>",
                type	:	"POST", 
                data	:	{"id":uuid},               
                success	:	function(data){   
                          	
                 	 
			
                 }
            
            });
            

			}
							function delete_device_data(uuid)
			{
				//alert(uuid);
			 
				 $.ajax({
                url		:	"<?php echo site_url("cadmin/dashboard/deleteDeviceData")?>",
                type	:	"POST", 
                data	:	{"id":uuid},               
                success	:	function(data){   
                          	
                 	 
			
                 }
            
            });
            

			}
					function device_delete(id)
			{
				 if(confirm("Do you really want to delete?")){
				 	delete_device_data(id);
				 $.ajax({
                url		:	"<?php echo site_url("cadmin/dashboard/device_delete")?>",
                type	:	"POST", 
                data	:	{"id":id},               
                success	:	function(data){   
                          	
                 	 if(data==1){
                 	 	alert("Deleted successfully!");
                 	 	window.location.reload();
                 	 }else{
                 	 	alert("Error occur while delete operation!");
                 	 }
			
                 }
            
            });
           }

			}
			
			function show_prompt(id) {
    var name;
    do {
        name=prompt("Please enter your device name");
    }
    while(name.length < 1);
    if(name.length > 1){
    		 $.ajax({
                url		:	"<?php echo site_url("cadmin/dashboard/name_device")?>",
                type	:	"POST", 
                data	:	{"name":name,"id":id},               
                success	:	function(data){   
                          	
                 	 if(data==1){
                 	 	alert("Device name updated successfully!");
                 	 	window.location.reload();
                 	 }else{
                 	 	alert("Error occur!");
                 	 }
			
                 }
            
            });
           }
     
}
    </script>
  </body>
</html>
