 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <?php 
                          $battery_info = batteryStatus($_REQUEST['id']);
  $battery_status = $battery_info['battery_status'];
 $lowmsg='';
  if($battery_status=="LOW"){
  	$general_info['batteryLevel'] = $battery_info['battery'];
	  $lowmsg = "<small style='color:red;'>(Device battery is low,Couldn't get latest data, this data is from past history.)</small>";
 
  }      
            
            echo $lowmsg;?>
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
         <?php  
            if(isset($general_info['wifi_status'])){
            $wifi =	($general_info['wifi_status']==1)?"ON":"OFF";
            }else{
            $wifi = "OFF";	
            }
			
			   if(isset($general_info['mobileData_status'])){
            $mobileData =	($general_info['mobileData_status']==1)?"ON":"OFF";
            }else{
            $mobileData = "OFF";	
            }
			
			   if(isset($general_info['bluetooth_status'])){
            $bluetooth =	($general_info['bluetooth_status']==1)?"ON":"OFF";
            }else{
            $bluetooth = "OFF";	
            }
            $gps = "ON";
            
             ?>
                     <?php
 
                     
          $bat_cls = "half";
          if($general_info['batteryLevel']>90){
          	$bat_cls = 'full';
          }else if(($general_info['batteryLevel']>60)&&($general_info['batteryLevel']<90)){
          	$bat_cls = 'half';
          }else if(($general_info['batteryLevel']>1)&&($general_info['batteryLevel']<60)){
          	$bat_cls = 'low';
          }else if($general_info['batteryLevel']==0){
          	$bat_cls = 'empty';
          }elseif($general_info['inCharge']==true){
          	$bat_cls = 'charging';
          }
          ?>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
           
                         <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3><?php echo $general_info['batteryLevel']."%";?> </h3>
                  <p>Battery</p>
                </div>
                <div class="icon">
                  <i class="ion-battery-<?php echo $bat_cls;?>"></i>
                </div>
                
              </div>
            </div>
   
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $mobileData;?> </h3>
                  <p>Mobile Data</p>
                </div>
                <div class="icon">
                  <i class="ion-connection-bars"></i>
                </div>
               
              </div>
            </div><!-- ./col -->
            
               <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $bluetooth;?> </h3>
                  <p>Bluetooth</p>
                </div>
                <div class="icon">
                  <i class=" ion-bluetooth"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
            
                  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $gps;?> </h3>
                  <p>GPS</p>
                </div>
                <div class="icon">
                  <i class="ion-navigate"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
             
          </div><!-- /.row -->
          <!-- Main row -->
  
          <div class="row">
          <section class="col-lg-6 connectedSortable ui-sortable">
           
          		<div class="row">
     
            
             <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $wifi;?> </h3>
                  <p>WiFi </p>
                </div>
                <div class="icon">
                  <i class="ion ion-wifi"></i>
                </div>
                
              </div>
            </div><!-- ./col -->
                            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                  <div class="inner">
                  <h3><?php echo $contact_count;?> </h3>
                  <p>Contacts</p>
                </div>
                <div class="icon">
                  <i class="ion-person-stalker"></i>
                </div>
                
              </div>
            </div> </div>
                   
     <div class="box box-success">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa fa-database"></i>
                  <h3 class="box-title">Storage Details</h3>
                  
           
                 </div>
          	<div class="row" style="padding: 10px;">
                    <div class="col-sm-12">
                      <!-- Progress bars -->
             
                      <div class="clearfix">
                        <span class="pull-left">Total Disk Space</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-aqua" ><?php echo $general_info['totalDiskSpace'];?></span>
                        </small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 100%;"></div>
                      </div>

                  <?php
                  $use_pre = ($general_info['usedDiskSpace']*100)/$general_info['totalDiskSpace'];
                  $free_pre = ($general_info['freeDiskSpace']*100)/$general_info['totalDiskSpace'];
                  
                  ?>
                  
                    <div class="clearfix">
                        <span class="pull-left">Used Disk Space</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-red" ><?php echo $general_info['usedDiskSpace'];?></span>
                        </small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: <?php echo $use_pre;?>%;"></div>
                      </div>

                   
                    <div class="clearfix">
                        <span class="pull-left">Free Disk Space</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-green" ><?php echo $general_info['freeDiskSpace'];?></span>
                        </small>
                      </div>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: <?php echo $free_pre;?>%;"></div>
                      </div>

                  
                    </div>
     

                     
                    </div><!-- /.col -->
                  </div>
                  
          	</section>
          <!-------------------GPS section ----------->
          
          <section class="col-lg-6 connectedSortable ui-sortable">
        <!--------------------wifi detail ------------------------->
        
             <div class="box box-warning">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa fa-wifi"></i>
                  <h3 class="box-title">Wifi Details</h3>
                  
           
                 </div>
          	<div class="row" style="padding: 10px;">
                    <div class="col-sm-6">
                      <!-- Progress bars -->
             
                      <div class="clearfix">
                        <span class="pull-left">Status</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-green" ><?php echo ($general_info['connectedViaWiFi'])?"Connected":"Not Connected";?></span>
                        </small>
                      </div> </div>
                      
 <div class="col-sm-6">
                  
                  <div class="clearfix">
                        <span class="pull-left">IP Address</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-aqua" ><?php echo $general_info['currentIPAddress'];?></span>
                        </small>
                      </div>
                      
</div>
                </div>   
                	<div class="row" style="padding: 10px;">
       <div class="col-sm-6">
                  
                    <div class="clearfix">
                        <span class="pull-left">SSID</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-red" ><?php echo $general_info['ssid'];?></span>
                        </small>
                      </div>
                      
</div>
                    		 <div class="col-sm-6">
                    <div class="clearfix">
                        <span class="pull-left">BSSID</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-yellow" ><?php echo $general_info['bssid'];?></span>
                        </small>
                      </div>
                       

                  
                    </div>
      </div> 
      
      <!--------------More -------->
      
                    	<div class="row" style="padding: 10px;">
       <div class="col-sm-6">
                  
                    <div class="clearfix">
                        <span class="pull-left">Wifi Public  Ip Address</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-purple" ><?php echo (isset($general_info['WiFiBroadcastAddress']))?$general_info['WiFiBroadcastAddress']:"";?></span>
                        </small>
                      </div>
                      
</div>
                    		 <div class="col-sm-6">
                    <div class="clearfix">
                        <span class="pull-left">WiFi Netmask Address</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-maroon" ><?php echo (isset($general_info['WiFiNetmaskAddress']))?$general_info['WiFiNetmaskAddress']:"";?></span>
                        </small>
                      </div>
                       

                  
                    </div>
      </div> 
      <!------------end more ---------->


<!----- Temp code ------->
   <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <i class="fa fa fa-mobile"></i>
                  <h3 class="box-title">Mobile Details</h3>
                  
           
                 </div>
         	<div class="row" style="padding: 10px;">
       <div class="col-sm-6">
                  
                    <div class="clearfix">
                        <span class="pull-left">Cell IP Address</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-red" style="background-color: #605ca8;"  ><?php echo (isset($general_info['cellIPAddress']))?$general_info['cellIPAddress']:"";?></span>
                        </small>
                      </div>
                      
</div>
                    		 <div class="col-sm-6">
                    <div class="clearfix">
                        <span class="pull-left">Network Type</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-maroon" ><?php echo (isset($general_info['network_type']))?$general_info['network_type']:"";?></span>
                        </small>
                      </div>
                       

                  
                    </div>
      </div> 
      
               	<div class="row" style="padding: 10px;">
       <div class="col-sm-6">
                  
                    <div class="clearfix">
                        <span class="pull-left">Public IP Address</span>
                        <small class="pull-right">
                        	
                        	<span   class="badge bg-red" style="background-color: #6850a8;"  ><?php echo (isset($general_info['externalIPAddress']))?$general_info['externalIPAddress']:"";?></span>
                        </small>
                      </div>
                      
</div>
                    
      </div>

<!------end temp code---->
                     
                    <!-- /.col -->
                  </div>
        
        
        
        
        
        <!------------------------wifi detail end------------------->



              <!-- Map box -->
              <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header ui-sortable-handle" style="cursor: move;">
                  <!-- tools box -->
                 
                  <i class="fa fa-map-marker"></i>
                  <h3 class="box-title">
                    User's Last Location at <?php echo $timing;?>
                  </h3>
                </div>
                <div class="box-body">
                   <div id="dvMap" style="width: 100%; height: 238px">
    </div>
                </div><!-- /.box-body-->
    
              </div>
              <!-- /.box -->

             
                  
            </section>
            
           </div>
          
          <!---------end ----------------->
 
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
    
    
        <!------- google map- -------->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBZYlLS4Z8AS-dYzjQdSztum_YSmH9nXRA"></script>  
    <script type="text/javascript">
         var greenpin = '<?php echo base_url();?>dist/img/pin_green.png';
         var redpin = '<?php echo base_url();?>dist/img/pin_red.png';
         var pointpin = '<?php echo base_url();?>dist/img/point.png';
          
var myLatLng = {lat: <?php echo $lat;?>, lng: <?php echo $lng;?>};

        /// new ///
        var markers = [];
            var mapOptions = {
                center: new google.maps.LatLng('<?php echo $lat;?>', '<?php echo $lng;?>'),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var  map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            var infoWindow = new google.maps.InfoWindow();
            var lat_lng = new Array();
            var latlngbounds = new google.maps.LatLngBounds();
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Last Location '+'<?php echo $timing;?>'
        });
        ///end///
   
       $(document).ready(function()
{
	 $('#choosedate').datepicker({
	 	autoclose: true, 
	 });
	 
	
   //setInterval('getUserLocation()', 10000);
});
       
 
    </script>
  </body>
</html>
