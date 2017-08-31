 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            GPS
            <!--<small>Control panel</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">GPS</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
<div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">GPS Info</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                 <div class="box-body">
                 	     <div class="row">
                 	     	 <div class="col-md-6">
                     
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <?php  date_default_timezone_set("UTC"); ?>
                      <input type="text" class="form-control pull-right" value="<?php echo gmdate("m/d/Y");?>" id="choosedate">
                     </div>
                    </div><!-- /.input group -->
                    <div class="col-md-2">
                     <a class="btn btn-block btn-primary" onclick="getUserLocation()">See user's location</a>
                  </div>
                  </div>
                <br> 
                
           <div id="dvMap" style="width: 100%; height: 500px">
    </div>
    

    
                          </div>
                      
        </section><!-- /.content -->
        
        
            <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
           
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Location History</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="table-grid" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr.no.</th>
                         <th>Latitude</th>
                         <th>Longitude</th>
                        <th>Time</th>
                         <th>View Location</th> 
                          
                      </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    <tfoot>
                      <tr>
                          <th>Sr.no.</th>
                         <th>Latitude</th>
                         <th>Longitude</th>
                        <th>Time</th>
                         <th>View Location</th> 
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
       <!------ dt---->
     <link rel="stylesheet" href="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.css">
   
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>plugins/datatables/dataTables.bootstrap.min.js"></script>
   
   <!---- end dt--->
    <!------- google map- -------->
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBZYlLS4Z8AS-dYzjQdSztum_YSmH9nXRA"></script>  
    <script type="text/javascript">
    
         var greenpin = '<?php echo base_url();?>dist/img/pin_green.png';
         var redpin = '<?php echo base_url();?>dist/img/pin_red.png';
         var pointpin = '<?php echo base_url();?>dist/img/point.png';
          

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
        
        ///end///
        function getUserLocation()
        {
        	 
$("#table-grid > tbody").empty();
        var choosedate	= $('#choosedate').val();
        	$.ajax({type:'POST',
                    url: '<?php echo site_url("user/getUserLocation");?>', 
                  data:{"id":'<?php echo $_REQUEST['id'];?>',"choosedate":choosedate }, 
                  success: function(data){
                  	//alert(data);
                  	data = $.parseJSON(data);
                  	totleresult = data.length;
                  	console.log(data.length);
$.each(data, function (i,v)
{
  if(i==0){
  	mtitle="Start";
  }else if(i==(totleresult-1)){
  	mtitle="Current location";
  }  
  else{
  	mtitle="Movement";
  }
  markers.push({
                "title": mtitle,
                "lat": v.lat,
                "lng": v.lng,
                "description": "Location at "+v.timing
            });
            
        $('#table-grid > tbody').append('<tr> <td>'+(i+1)+'</td><td>'+v.lat+'</td><td>'+v.lng+'</td><td>'+v.timing+'</td><td><a style="cursor:pointer;" onclick="getFormatedAddress('+v.lat+','+v.lng+')">view</a></td></tr>');   
});
drawotherlocation();
                  }
                });

        }
       $(document).ready(function()
{
	 // $("#table-grid").DataTable();
	 $('#choosedate').datepicker({
	 	autoclose: true, 
	 });
	 
	getUserLocation();
   //setInterval('getUserLocation()', 10000);
});
       
        function drawotherlocation()
        {
        	    
            for (i = 0; i < markers.length; i++) {
            	 
            	 if(i==0){
            	 	markericon = redpin;
            	 	
            	 }
            	 else if(i==(markers.length-1)){
            	 	markericon = greenpin;
            	 	
            	 }
            	 else{
            	 	markericon = pointpin;
            	 }
                var data = markers[i]
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                lat_lng.push(myLatlng);
                var marker = new google.maps.Marker({                	
                    position: myLatlng,
                    icon: markericon,
                    map: map,
                    title: data.title
                });
                latlngbounds.extend(marker.position);
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        infoWindow.setContent(data.description);
                        infoWindow.open(map, marker);
                    });
                })(marker, data);
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);

            //***********ROUTING****************//

            //Intialize the Path Array
            var path = new google.maps.MVCArray();

            //Intialize the Direction Service
            var service = new google.maps.DirectionsService();

            //Set the Path Stroke Color
            var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });

            //Loop and Draw Path Route between the Points on MAP
            for (var i = 0; i < lat_lng.length; i++) {
                if ((i + 1) < lat_lng.length) {
                    var src = lat_lng[i];
                    var des = lat_lng[i + 1];
                    path.push(src);
                    poly.setPath(path);
                    service.route({
                        origin: src,
                        destination: des,
                        travelMode: google.maps.DirectionsTravelMode.DRIVING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                                path.push(result.routes[0].overview_path[i]);
                            }
                        }
                    });
                }
            }
        }
        
        function getFormatedAddress(lat,lng)
        {
        	$.ajax({ url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+lat+','+lng+'&sensor=true',
         success: function(data){
             alert(data.results[0].formatted_address);
             /*or you could iterate the components for only the city and state*/
         }
});
        }
        
        
    </script>

    
    
    <!------ end of google map ------>
    
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
  </body>
</html>
