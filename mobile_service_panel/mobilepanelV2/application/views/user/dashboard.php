
<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Dashboard</h3>
             <?php 
                          $battery_info = batteryStatus($_REQUEST['id']);
  $battery_status = $battery_info['battery_status'];
 $lowmsg='';
  if($battery_status=="LOW"){
  	$general_info['batteryLevel'] = $battery_info['battery'];
	  $lowmsg = "<p style='color:red;'>(Device battery is low,Couldn't get latest data, this data is from past history.)</p>";
 
  }      
         echo $lowmsg;?>
      </div>
     <!-- <div class="col text-right ">
        <div class="btn-group pull-right">
          <button class="btn btn-success btn-round " data-toggle="modal" data-target="#themepicker" ><span class="text">Customize</span> <i class="fa fa-cogs ml-2"></i></button>          
        </div>
      </div>-->
    </div>
    
   
    
  <div class="row">
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block success">
          <div class="media">
            <div class="media-body">
              <h5> <span class="spincreament"><?php echo $apps_count;?></span></h5>
              <p>App Installed

</p>
            </div>
          <a href="<?php echo site_url("user/deviceapps").'?id='.$_REQUEST['id'];?>">  <i class="fa fa-android"></i> 
          	</a></div>
          <br>
          <div class="media">
          	<div class="media-body"><span class="progress-heading"></span></div>
               <a href="<?php echo site_url("user/deviceapps").'?id='.$_REQUEST['id'];?>" ><span class="badge badge-success ml-2">View </span></a> 
              </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"><span class="trackerball"></span></div>
            </div>
          </div>
          <i class="bg-icon text-center fa fa-android"></i> </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block danger">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?php echo $contact_count;?> </span></h5>
              <p>Contacts</p>
            </div>
             <a href="<?php echo site_url("user/contact").'?id='.$_REQUEST['id'];?>"><i class="fa fa-users"></i> </a></div>
          <br>
          <div class="media">
          <div class="media-body"><span class="progress-heading"></span></div>
               <a href="<?php echo site_url("user/contact").'?id='.$_REQUEST['id'];?>" ><span class="badge badge-success ml-2" style="background: #E47270;">View </span></a> 
              </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="trackerball"></span></div>
            </div>
          </div>
          <i class="bg-icon text-center fa fa-users"></i> 
          </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block warning">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?php echo $call_log_count ;?></span></h5>
              <p>Call Logs </p>
            </div>
           <a href="<?php echo site_url("user/calllogs").'?id='.$_REQUEST['id'];?>" >  <i class="fa fa-phone"></i> </a> </div>
          <br>
          <div class="media">
          	<div class="media-body"><span class="progress-heading"></span></div>
               <a href="<?php echo site_url("user/calllogs").'?id='.$_REQUEST['id'];?>" ><span class="badge badge-success ml-2" style="background: #FEB011;">View </span></a> 
             </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"><span class="trackerball"></span></div>
            </div>
          </div>
          <i class="bg-icon text-center fa fa-phone"></i> </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block primary">
          <div class="media">
            <div class="media-body">
              <h5><span class="spincreament"><?php echo $sms_count;?></span></h5>
              <p>SMS</p>
            </div>
           <a href="<?php echo site_url("user/messages").'?id='.$_REQUEST['id'];?>" > <i class="fa fa-comments"></i> </a> </div>
          <br>
          <div class="media">
            <div class="media-body"><span class="progress-heading"></span></div>
               <a href="<?php echo site_url("user/messages").'?id='.$_REQUEST['id'];?>" ><span class="badge badge-success ml-2" style="background: #8670FC;">View </span></a>
                </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="trackerball"></span></div>
            </div>
          </div>
          <i class="bg-icon text-center fa fa-comments"></i> </div>
      </div>
    </div>
    <!-----------------Middle------------------------------------->
    
    
    
        <div class="row">
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Top 5 Most Calling Number </h5>
 
          </div>
          <div class="card-block">
    <!------------card------>
                  <?php  
				  $call_number = array();
                  	
					if(count($call_list)>0){
						foreach ($call_list as $raw) {
							if($raw['Type']=='OUTGOING'){
								$call_number[] = $raw['Number'];
							}
						}
					
				 
					$call_numbercounts = array_count_values($call_number);
				 
					 arsort($call_numbercounts);
					 
					 
                  	 $call_width = 100;
                      $i_count = 0;
					  $previous_count = 0;
					  $color_theme= array("#26A6C4","#E36F74","#FEAB19","#8372FC","#F02FAA");
                      foreach ($call_numbercounts as $key => $value) {
                          
                    if($i_count==5){
					  	break;
					  }
					if($previous_count==$value){
					 $call_width = ($new_call_width+10);
				}
                      ?>
                      
            <div class="list-unstyled media-list bordered" >
            	
              <div class="media align-items-center">
                <div class="media-body">
                  <h6 class="mt-0 mb-1"><?php echo $key;?></h6>
                   </div>
                <div class=" align-items-end">
                  <button class="btn btn-success btn-round mr-2" style="background: <?php echo $color_theme[$i_count];?>"><?php echo $value;?></button>
                 
                </div>
              </div>
               </div>
                
               
                <?php
                      $previous_count = $value;
                      $new_call_width = $call_width;
                      $i_count++;
					  
					  }
					}
                      ?>
    <!---------end----->
          </div>
        </div>
      </div>
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">User's Last Location at- <small><?php echo $timing;?></small></h5>
 
          </div>
          <div class="card-block">
            <div class="list-unstyled project-list row">
       <div id="dvMap" style="width: 100%; height: 299px">
    </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    
    <!------------------End Middle-------------------------->
    
    
    
    
    
    
    <div class="row">
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><?php echo ($devicedata['total_space']/1000);?>   <span class="spincreament">GB</span></h5>
              <p>TOTAL SPACE</p>
            </div>
            <i class="fa fa-cubes"></i> </div>
          <br>
          <div class="media">
             </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%; background: #239AC2;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><?php echo (($devicedata['total_space'] - $devicedata['space_available'])/1000);?><span class="spincreament">GB</span> </h5>
              <p>Used Space</p>
            </div>
            <i class="fa fa-cubes"></i> </div>
          <br>
          <div class="media">
             </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 70%;background: #E4776A;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><?php echo ($devicedata['space_available']/1000);?><span class="spincreament">GB</span> </h5>
              <p>Free Space</p>
            </div>
            <i class="fa fa-cubes"></i> </div>
          <br>
          <div class="media">
            </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 25%; background: #FEAF12;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-8 col-xl-4">
        <div class="activity-block">
          <div class="media">
            <div class="media-body">
              <h5><?php echo $devicedata['battery_status']."";?><span class="spincreament">%</span></h5>
              <p>Battery</p>
            </div>
            <i class="fa fa-battery-half"></i> </div>
          <br>
          <div class="media">
             </div>
          <div class="row">
            <div class="progress ">
              <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $devicedata['battery_status']."%";?>;background: #9A54E3;"><span class="trackerball"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
   <!----- Other detail------->
   
   <!------------------------------Other imp details ---------------------------->
                <?php 
                      $generalinfo = array();
					   $generalinfo['status']= "Not Connected";
                     $generalinfo['SSID']=  $generalinfo['IpAddress']= $generalinfo['SupplicantStateName']= $generalinfo['NetworkAddress']=
                  $generalinfo['MacAddress']=  $generalinfo['SupplicantStateName']= '';
				   $deviceinfo= get_unserialize($devicedata['device_detail']);
				   
				 
				   
				   if(count($deviceinfo)>0){
				   	  //echo "<pre>";print_r($deviceinfo);exit;
                    $general_info['cellIPAddress'] =  $deviceinfo['IP_ADDRESS'];
					if($deviceinfo['WIFI_ENABLE']){
					   $i=1;
						$wifi = array_reverse($wifi);
					  if(count($wifi)>0){
                	foreach ($wifi as $raw) {
						
					 
						 $device= get_unserialize($raw['wifi_detail']);
						if(isset($device['ConnectedWifi'])){
							$row = $device['ConnectedWifi']; 
					if (in_array($row['SSID'], $connectionname))
					  {
					  	continue;
					  	}		
					$connectionname [] = 	$row['SSID'];	 
                  ?>
                   
            <?php
            $generalinfo['status']="Connected";
            $generalinfo['SSID']=$row['SSID'];
			    $generalinfo['IpAddress']=$row['IpAddress'];
				    $generalinfo['SupplicantStateName']=$row['SupplicantStateName'];
					    $generalinfo['NetworkAddress']=$row['NetworkAddress'];
							    $generalinfo['MacAddress']=$row['MacAddress'];
								$generalinfo['SupplicantStateName']=$row['SupplicantStateName'];
      		}
                 
                }
					  
      }
					}
					}
      ?>

   <!---end---->
   <div class="row">
   	<div class="col-md-16 col-lg-16 col-xl-16">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Wifi <small>Details</small></h5>
          
          </div>
          <div class="card-block">
            <div class="list-unstyled member-list row">
              <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "><h4> <span class="badge badge-success ml-2" style="background: #6C8BEF;"> <?php echo $generalinfo['status'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Status</h6>
                      
                  </div>
                  
                </div>
              </div>
           <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "><h4> <span class="badge badge-success ml-2" style="background: #E47172;"> <?php echo $generalinfo['IpAddress'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Wifi IP Address</h6>
                      
                  </div>
                  
                </div>
              </div>
           <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <h4><span class="badge badge-success ml-2" style="background: #FEA81F;"> <?php echo $generalinfo['SSID'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> SSID</h6>
                      
                  </div>
                  
                </div>
              </div>
               <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <h4><span class="badge badge-success ml-2" style="background: #886FFB;"> <?php echo $generalinfo['MacAddress'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Mac Address</h6>
                      
                  </div>
                  
                </div>
              </div>
               <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "><h4> <span class="badge badge-success " style="background: #6C8BEF;"> <?php echo $generalinfo['NetworkAddress'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Network Address</h6>
                      
                  </div>
                  
                </div>
              </div>
                 <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "><h4> <span class="badge badge-success ml-2" style="background: #E47172;"><?php echo $generalinfo['SupplicantStateName'];?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Supplicant State Name</h6>
                      
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Mobile <small>Details</small></h5>
          
          </div>
                  <div class="card-block">
            <div class="list-unstyled member-list row">
              <div class="col-lg-3 col-sm-3 col-xs-3 ">
                <div class="media flex-column "><h4> <span class="badge badge-success" style="background: #6C8BEF;"> <?php echo (isset($general_info['cellIPAddress']))?$general_info['cellIPAddress']:"-";?></span></h4> 
                  <div class="media-body">
                    <h6 class="mt-0 mb-1"> Status</h6>
                      
                  </div>
                  
                </div>
              </div>
              </div>
              </div>
          
        </div>
      </div>
   </div>
   
   <!---------ENd other detail---------->
    
   
     
      
     
     
       
  </div>
 <?php echo $this->view("footer");?>
</div>
<div class="search-block">
  <button class="close-btn btn btn-link"><span class="fa fa-times"></span></button>
  <div class="container">
    <div class="row">
      <form class="form-inline pull-left search-block-form">
        <input class="form-control " type="text" placeholder="Search..." value="Adminux by Maxartkiller " autofocus>
        <button class="btn btn-link icon-header " type="submit"><span class="fa fa-search"></span></button>
      </form>
    </div>
    <div class="row">
      <div class="col ">
        <ul class="nav flex-column ">
          <li class="title-nav">Search result for "Adminux by Maxartkiller"</li>
          <li class=""><br>
          </li>
          <li class="nav-item">
            <div class="list-unstyled search-list"> <a href="#" class="media">
              <div class="media-body">
                <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
                http://www.maxartkiller.in <br>
                <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
              </div>
              </a> <a href="#" class="media">
              <div class="media-body">
                <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
                http://www.maxartkiller.in <br>
                <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
              </div>
              </a> <a href="#" class="media">
              <div class="media-body">
                <h6 class="mt-0 mb-1">Beautiful admin template ever</h6>
                http://www.maxartkiller.in <br>
                <p class="description">Bootstrape 4 based creatively hand crafter admin tempolate never seen before. #1 template in UI design and experience it provides.</p>
              </div>
              </a> </div>
          </li>
        </ul>
      </div>
      <br>
    </div>
    <div class="row">
      <div class="col "> <br>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item"> <a class="page-link" href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> <span class="sr-only">Previous</span> </a> </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"> <a class="page-link" href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> <span class="sr-only">Next</span> </a> </li>
          </ul>
        </nav>
        <hr>
        <br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Popular People</h5>
          </div>
          <div class="card-block">
            <div class="list-unstyled member-list row">
              <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Astha Smith</h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>
              <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Rahul Akshay </h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>
              <div class="col-lg col-sm-8 col-xs-16 ">
                <div class="media flex-column "> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Rocky Jolly</h6>
                    New Jersey, UK
                    <p class="description">This is awesome product and, I am very happy</p>
                  </div>
                  <div class="overlay align-items-center">
                    <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
                    <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Popular Project</h5>
          </div>
          <div class="card-block">
            <div class="list-unstyled project-list row">
              <div class="col-md-16 col-lg-8 col-xl-8">
                <div class="media flex-column "> <span class="projectpic"><img src="../img/project_pic.jpg" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="overlay ">
                    <label class="ribbon left danger"><span>Maxartkiller</span></label>
                    <h6 class="mt-0 mb-1">Website Design</h6>
                    2017 <br>
                    <br>
                    <a href="#" class="btn btn-outline-white btn-round "><i class="fa fa-eye"></i>View </a> </div>
                </div>
              </div>
              <div class="col-md-16 col-lg-8 col-xl-8">
                <div class="media flex-column "> <span class="projectpic"><img src="../img/project_pic.jpg" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="overlay ">
                    <label class="ribbon left danger"><span>Maxartkiller</span></label>
                    <h6 class="mt-0 mb-1">Website Design</h6>
                    2017 <br>
                    <br>
                    <a href="#" class="btn btn-outline-white btn-round "><i class="fa fa-eye"></i>View </a> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sidebar-right">
  <ul class="nav flex-column " >
    <li class="nav-item text-center">
      <div class="progressprofile">
        <div class="progress_profile " data-value="0.65"  data-size="140"  data-thickness="4"  data-animation-start-value="0" data-reverse="false" ></div>
        <div class="user-details">
          <figure><img src="../img/user-header.png" alt="complete profile"></figure>
          <h5>65%</h5>
          <p class="">Completed</p>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="meeting-subject text-center col ">You have lots of oopportunity and <br>
        other information pending  to recieve</div>
      <div class="nav-link"><a href="customerprofile.html" class="btn btn-outline-primary btn-round mr-sm-2">Complete your profile <i class="fa fa-chevron-right"></i></a></div>
    </li>
  </ul>
  <hr>
  <ul class="nav flex-column " >
    <li class="title-nav">New Friend Request</li>
    <li class="nav-item">
      <div class="list-unstyled media-list">
        <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
          <div class="media-body">
            <h6 class="mt-0 mb-1">Dhananjay Chauhan</h6>
            New Jersey, UK</div>
          <div class="overlay align-items-end">
            <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
            <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
          </div>
        </div>
        <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"><span class="user-status bg-success "></span></span>
          <div class="media-body">
            <h6 class="mt-0 mb-1">Astha Smith</h6>
            Ahemedabad, IN</div>
          <div class="overlay align-items-end">
            <button class="btn btn-success btn-round mr-2"><i class="fa fa-check"></i></button>
            <button class="btn btn-danger mr-2 btn-round "><i class="fa fa-close"></i></button>
          </div>
        </div>
      </div>
    </li>
  </ul>
  <hr>
  <ul class="nav flex-column " >
    <li class="title-nav">New Event Request</li>
    <li class="nav-item">
      <div class="list-unstyled media-list"> <a href="#" class="media">
        <div class="media-body">
          <h6 class="mt-0 mb-1">20 February, 2017</h6>
          New Jersey, UK <br>
          <p class="description">Musical night festival seasons, Drama and comedy cultural famil</p>
        </div>
        </a> <a href="#" class="media">
        <div class="media-body">
          <h6 class="mt-0 mb-1">20 February, 2017</h6>
          New Jersey, UK <br>
          <p class="description">Musical night festival seasons, Drama and comedy cultural famil</p>
          <p class="description"> <span>Privately invited by:</span> <span class="invites-by"><img src="../img/user-header.png" alt="complete profile"> <span class="user-status bg-success "></span></span> <span class="invites-by"><img src="../img/user-header.png" alt="complete profile"></span> <span class="invites-by"><img src="../img/user-header.png" alt="complete profile"></span> </p>
        </div>
        </a> </div>
    </li>
  </ul>
  <hr>
  <ul class="nav flex-column " >
    <li class="title-nav">Last Message</li>
    <li class="nav-item">
      <div class="list-unstyled media-list">
        <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"></span>
          <div class="media-body">
            <h6 class="mt-0 mb-1">Rahul Akshay</h6>
            2:00 pm, 20 January, 2017 <br>
            <p class="description">Hi! Are you ready for Musical night festival seasons, Drama and comedy cultural family show.</p>
            <button class="btn btn-outline-primary btn-round mr-sm-2"><i class="fa fa-reply"></i> Reply</button>
            <button class="btn btn-outline-danger btn-round ">Close</button>
          </div>
        </div>
      </div>
      <div class="nav-link"></div>
    </li>
  </ul>
  <hr>
  <ul class="nav flex-column " >
    <li class="title-nav text-center">Advertising space</li>
    <li class="nav-item">
      <div class="list-unstyled"> <a href="http://www.maxartkiller.in" target="_blank" class="media text-center"> <span class="col text-center"><img class="" src="../img/advertise_maxartkiller_ui-ux.png" alt="advertise maxartkiller ui ux creative design"></span> <br>
        </a> </div>
      <a href="http://www.maxartkiller.in" target="_blank" class="nav-link text-center">www.maxartkiller.in</a> </li>
  </ul>
  <br>
  <br>
</div>
<!-- themepicker modal starts -->
<div class="modal fade" id="themepicker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select your Preferances</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <table class="table color_pick_table mb-0">
          <thead>
            <tr>
              <th class="p-0"></th>
              <th class="p-0"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="">Fills</td>
              <td>
                   <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#fullcolored" role="tab"><img src="../img/Layout_Fill_all.png" alt="" class="responsive-img"></a> </li>
                      <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#headersidebarfill" role="tab"><img src="../img/Layout_Fill_side_header.png" alt="" class="responsive-img"></a> </li>
                      <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sidebarfill" role="tab"><img src="../img/Layout_Fill_side.png" alt="" class="responsive-img"></a> </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <div class="tab-pane active" id="fullcolored" role="tabpanel">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens12.png" alt="" class="color_pick"><br><span>White</span></span> 
                            </label>   
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="lightblue_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens14.png" alt="" class="color_pick"><br><span>Lightblue</span></span> 
                            </label>   
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_blue_adminux" name="color_pick" checked>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens1.png" alt="" class="color_pick"><br><span>Dark Blue</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_purple_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens7.png" alt="" class="color_pick"><br><span>Dark Purple</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_red_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens8.png" alt="" class="color_pick"><br><span>Dark Red</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_grey_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens9.png" alt="" class="color_pick"><br><span>Dark Grey</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_green_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens10.png" alt="" class="color_pick"><br><span>Dark Green</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="dark_brown_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description"><img src="../img/screens11.png" alt="" class="color_pick"><br><span>Brown</span></span> 
                            </label>                     
                        </div>
                      <div class="tab-pane" id="headersidebarfill" role="tabpanel">
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+blue_header_sidebar_adminux" name="color_pick" >
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens1.png" alt="" class="color_pick"><br>
                                <span>Dark Blue</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+purple_header_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens7.png" alt="" class="color_pick"><br>
                                <span>Dark Purple</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+red_header_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens8.png" alt="" class="color_pick"><br>
                                <span>Dark Red</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+grey_header_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens9.png" alt="" class="color_pick"><br>
                                <span>Dark Grey</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+green_header_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens10.png" alt="" class="color_pick"><br>
                                <span>Dark Green</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+brown_header_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/2screens11.png" alt="" class="color_pick"><br>
                                <span>Brown</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/screens12.png" alt="" class="color_pick"><br>
                                <span>White</span></span> 
                            </label> 
                        
                        </div>
                        <div class="tab-pane" id="sidebarfill" role="tabpanel"> 
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+blue_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens1.png" alt="" class="color_pick"><br>
                                <span>Dark Blue</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+purple_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens7.png" alt="" class="color_pick"><br>
                                <span>Dark Purple</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+red_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens8.png" alt="" class="color_pick"><br>
                                <span>Dark Red</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+grey_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens9.png" alt="" class="color_pick"><br>
                                <span>Dark Grey</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+green_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens10.png" alt="" class="color_pick"><br>
                                <span>Dark Green</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light+brown_sidebar_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/themes/3screens11.png" alt="" class="color_pick"><br>
                                <span>Brown</span></span> 
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input select-color" data-color="light_adminux" name="color_pick">
                                <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="../img/screens12.png" alt="" class="color_pick"><br>
                                <span>White</span></span> 
                            </label>
                        </div>
                    </div>

                  
                  
                </td>
            </tr>
            <tr>
              <td>Reading</td>
              <td>
                  <label class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input select-reading" name="read_style" data-reading="ltr-read" checked>
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"><img src="../img/Layout_LTR.png" alt="" class="color_pick"><br><span>Left to Right</span></span> 
                  </label>
                  <label class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input select-reading" name="read_style" data-reading="rtl-read">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"><img src="../img/Layout_RTL.png" alt="" class="color_pick"><br><span>Right to Left</span></span> 
                  </label>
                </td>
            </tr>
            <tr>
              <td>Display</td>
              <td>
                  <label class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input select-rounded" name="display_mode"  data-rounded="" checked>
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"><img src="../img/Layout_Flat_corner.png" alt="" class="color_pick"><br><span>Flat Corner</span></span> 
                  </label>
                  <label class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input select-rounded" data-rounded="rounded" name="display_mode">
                      <span class="custom-control-indicator"></span>
                      <span class="custom-control-description"><img src="../img/Layout_more_rounded.png" alt="" class="color_pick"><br><span>More Rounded</span></span> 
                  </label>    
                
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- themepicker modal ends here ! --> 

 

<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="<?php echo base_url();?>dist/js/jquery-2.1.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>dist/vendor/bootstrap4alpha/js/tether.min.js"></script> 

<script src="<?php echo base_url();?>dist/vendor/bootstrap4alpha/js/bootstrap.min.js" type="text/javascript"></script> 
    
<!--Cookie js for theme chooser and applying it --> 
<script src="<?php echo base_url();?>dist/vendor/cookie/jquery.cookie.js"  type="text/javascript"></script> 

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url();?>dist/js/ie10-viewport-bug-workaround.js"></script>

<!-- Circular chart progress js --> 
<script src="<?php echo base_url();?>dist/vendor/cicular_progress/circle-progress.min.js" type="text/javascript"></script> 

<!--sparklines js--> 
<script type="text/javascript" src="<?php echo base_url();?>dist/vendor/sparklines/jquery.sparkline.min.js"></script> 

<!-- jvectormap JavaScript --> 
<script src="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> 

<!-- chart js --> 
<script src="<?php echo base_url();?>dist/vendor/chartjs/Chart.bundle.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>dist/vendor/chartjs/utils.js" type="text/javascript"></script> 

<!-- spincremente js --> 
<script src="<?php echo base_url();?>dist/vendor/spincrement/jquery.spincrement.min.js" type="text/javascript"></script> 

<!-- DataTables JavaScript --> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/dataTables.bootstrap4.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/dataTables.responsive.min.js"></script> 

<!-- custome template js --> 
<script src="<?php echo base_url();?>dist/js/adminux.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>dist/js/dashboard1.js"></script>
 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
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
                 styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{color: '#263c3f'}]
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{color: '#6b9a76'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{color: '#38414e'}]
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{color: '#212a37'}]
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{color: '#9ca5b3'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{color: '#746855'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{color: '#1f2835'}]
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{color: '#f3d19c'}]
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{color: '#2f3948'}]
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{color: '#d59563'}]
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{color: '#17263c'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{color: '#515c6d'}]
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{color: '#17263c'}]
            }
          ],
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
   
 
       
 
    </script>
</body>
</html>