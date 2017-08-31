 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           OCR Data Explorer
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">OCR Data Explorer</li>
          </ol>
        </section>
   
        <!-- Main content -->
        <section class="content">
        	 
          <!-- Small boxes (Stat box) -->
          <div class="row" id="filestruct">
           <?php 
           /*
           foreach ($griddata as $raw) {
               
            $filepatharr = explode("/",$raw['filepath']);
			   if(count($filepatharr)>0){
		 foreach ($filepatharr as $val) {
			 if(strlen($val)>0){
			 	  $foldername = $val;
				 break;
			 }
		 }
			
           ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                	<h3><?php echo $raw['filecount']?></h3>
                  <p><?php echo $foldername; ?></p>
                  
                </div>
                <div class="icon">
                  <i class="ion-folder"></i>
                </div>
                <a href="<?php echo site_url("user/file_explorer_list")."?album=".$raw['app_name']."&id=".$_REQUEST['id'];?>" class="small-box-footer">View <i class="fa  fa-hand-pointer-o"></i></a>
              </div>
            </div><!-- ./col -->
             <?php
			   }
		   }
*/
             ?>
          </div><!-- /.row -->
          <!-- Main row -->
 
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
    
     <link rel="stylesheet" href="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.css">
   
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
    	$(window).load(function() {
    		$.ajax({type:'POST',
                    url: '<?php echo site_url("user/get_ocr_explorer_grid");?>', 
                  data:{"id":'<?php echo $_REQUEST['id']; ?>'},
                  success: function(data){
                  	$("#filestruct").html(data);
                  	//$("#pathnav").append('<li class="data" onclick="get_file_explorer_root()" style="cursor:pointer;" ><span  >Gallery</span></li>');
                  
 filter_datatable('root');

}
                });
    		});
    		function get_file_explorer_root () {
    			
			  location.reload();
 

			}
    		function get_file_explorer_gridchild(dir){
    			removeDuplicates(dir);	
    			$.ajax({type:'POST',
                    url: '<?php echo site_url("user/get_file_explorer_gridchild");?>', 
                  data:{"id":'<?php echo $_REQUEST['id']; ?>','dir':dir},
                  success: function(data){
                  	$("#filestruct").html(data);
                  	$("#pathnav").append('<li class="data" onclick="get_file_explorer_gridchild('+"'"+dir+"'"+')" style="cursor:pointer;" ><span >'+dir+'</span></li>');
                  	$("#dirtitle").html(dir);
  filter_datatable(dir);

}
                });
    		}
    		//// data table function
    		
    		function filter_datatable(dir)
{
	global_error = false;
 
					 if (!global_error){
	$('#employee-grid').dataTable().fnDestroy();
	 //$('#employee-grid').remove();
			var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,	
					 "order": [[ 0, "desc" ]],		
					"ajax":{
						url :'<?=site_url('dt_con/get_file_exp_dt');?>', // json datasource
						type: "post",  // method  , by default get	
						data:{"id":'<?php echo $_GET['id'];?>',"album":dir},					
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				}else{
					$("#error_body").show();  
                   $("html, body").animate({ scrollTop: 0 }, "slow");
				}
}
    		
    		////// end of data table
    		
    	function removeDuplicates(currdir) {
    		var checkmatch = false;
    		//alert(currdir);
  var map = {};
  $("OL").find(".data").each(function() {
    var value = $(this);
  var val_li =  value.text();
    if(val_li==currdir){
    	checkmatch = true;
    }
    if(checkmatch){
    	$(this).remove();
    }
   
    
  });
}


    </script>
  </body>
</html>
