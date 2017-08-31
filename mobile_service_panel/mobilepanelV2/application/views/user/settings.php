<div class="wrapper-content">
 
  <div class="container">
 <!----------------->
     <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3>Settings</h3>
                    
      </div>
     <!-- <div class="col text-right ">
        <div class="btn-group pull-right">
          <button class="btn btn-success btn-round " data-toggle="modal" data-target="#themepicker" ><span class="text">Customize</span> <i class="fa fa-cogs ml-2"></i></button>          
        </div>
      </div>-->
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
					$autosleep_off = $autosleep_on = 0;
				if(isset($data_settings['auto_sleep'])){
                	if($data_settings['auto_sleep']==1){
                		 $autosleep_on = 1;
						 $autosleep_off = 0;
                	}else{
                		$autosleep_off = 1;
                	}
                }
				
				
						$ocrsyn_off = 	$ocrsyn_on = 0;
				if(isset($data_settings['ocr_sync'])){
                	if($data_settings['ocr_sync']==1){
                		 $ocrsyn_on = 1;
						 $ocrsyn_off = 0;
                	}else{
                		$ocrsyn_off = 1;
                	}
                }
				
				
							$readnotification_off = 	$readnotification_on = 0;
				if(isset($data_settings['notification_sync'])){
                	if($data_settings['notification_sync']==1){
                		 $readnotification_on = 1;
						 $readnotification_off = 0;
                	}else{
                		$readnotification_off = 1;
                	}
                }
                ?>
        <div class="row">
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Data Settings</h5>
 
          </div>
          <div class="card-block">
    <!----Form Start------>
    <form id="data_setting"  >
    	         	<div id="st_success_body" class="alert alert-success alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                   	<div id="st_error_body" class="alert alert-danger alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
    	 
              <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Notification Sync</label> 
                                </div>
                                <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="readnotification_on">
                                    <input type="radio" name="notification_sync" id="readnotification_on" class="custom-control-input"  value="1" <?php echo ($readnotification_on==1)?'checked':'';?>  >
                                    <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Start</span>
                                </label>
                                <label class="custom-control custom-radio" for="readnotification_off">
                                    <input name="notification_sync"  class="custom-control-input" id="readnotification_off" value="0" <?php echo ($readnotification_on==0)?'checked':'';?> type="radio">
                                    <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Stop</span>
                                </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Auto sleep </label> 
                                <small style="color: red;"><b>(Auto sleep: Device battery below 20% will disable all app feature.)</b></small>
          
                               </div>
                               <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="autosleep_on">
                                   <input name="autosleep" id="autosleep_on" class="custom-control-input" value="1" <?php echo ($autosleep_on==1)?'checked':'';?> type="radio">
                        
                                    <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Start</span>
                                </label>
                                <label class="custom-control custom-radio" for="autosleep_off">
                                    <input name="autosleep" id="autosleep_off" class="custom-control-input" value="0" <?php echo ($autosleep_on==0)?'checked':'';?> type="radio">
                         
                                    
                                      <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Stop</span>
                                </label>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>OCR Sync </label> 
                                </div>
                                <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="ocrsync_on">
                                    <input name="ocrsync" id="ocrsync_on" class="custom-control-input" value="1" <?php echo ($ocrsyn_on==1)?'checked':'';?> type="radio">
                           <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Start</span>
                                </label>
                                <label class="custom-control custom-radio" for="ocrsync_off">
                                   <input name="ocrsync" id="ocrsync_off" class="custom-control-input" value="0" <?php echo ($ocrsyn_on==0)?'checked':'';?> type="radio">
                            <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Stop</span>
                                </label>
                                </div>
                               </div>
                                
                                
                            </div>
                        </div>
                    </div>
                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>File Auto Sync</label>
                                </div>
                                 <div class="col-lg-6 col-md-6">
                                <label class="custom-control custom-radio" for="autosync_on">
                                   <input name="autosync" id="autosync_on"  class="custom-control-input" value="1"  <?php echo ($auto_sync_on==1)?'checked':'';?> type="radio">
                               <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">ON</span>
                                </label>
                                <label class="custom-control custom-radio" for="autosync_off">
                                    <input name="autosync" id="autosync_off"  class="custom-control-input" value="0"  <?php echo (($auto_sync_off==1)||($auto_sync_on==0))?'checked':'';;?> type="radio">
                               <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">OFF</span>
                                </label>
                                </div>
                                
                                  <div class="col-lg-5 col-md-5">
                      	 <!-------time picker ---->   
      <div id="div_schedule" class="input-group clockpicker"  data-autoclose="true">
    <input name="schedule" id="schedule" type="text" class="form-control" value="<?php echo $time;?>">
    <span class="input-group-addon">
        <span class="fa  fa-clock-o "></span>
    </span>
</div>
                      </div>
                                
                               </div>
                            </div>
                        </div>
                    </div>
                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Media sync </label> 
                                </div>
                                 	<div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="mediasyn_both">
                                  <input name="mediasyn" id="mediasyn_both" value="0" class="custom-control-input" <?php echo ($media_both==1)?'checked':'';?> type="radio">
                            <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Both</span>
                                </label>
                                <label class="custom-control custom-radio" for="mediasyn_wifi">
                                   <input name="mediasyn" id="mediasyn_wifi" value="1"  class="custom-control-input" <?php echo ($media_wifi==1)?'checked':'';?> type="radio">
                           <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Wifi</span>
                                </label>
                                <label class="custom-control custom-radio" for="mediasyn_gsm">
                                   <input name="mediasyn" id="mediasyn_gsm" value="2" class="custom-control-input" <?php echo ($media_gsm==1)?'checked':'';?> type="radio">
                           <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">GSM</span>
                                </label>
                                </div>
                               </div>
                                
                            </div>
                        </div>
                    </div>
                
                 <input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id'];?>" />
                            <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Mircophone </label> 
                                </div>
                                <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="mircophone_on">
                                 <input name="mircophone" id="mircophone_on"  class="custom-control-input" value="1" <?php echo ($microphone_on==1)?'checked':'';?> type="radio">
                             <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Active</span>
                                </label>
                                <label class="custom-control custom-radio" for="mircophone_off">
                                   <input name="mircophone" id="mircophone_off"  class="custom-control-input" value="0" <?php echo ($microphone_off==1)?'checked':'';?> type="radio">
                          <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">Deactive</span>
                                </label>
                                </div>
                               </div>
                                
                            </div>
                        </div>
                    </div>
               
                
    <!---------end----->
    
          </div>
          <div class="card-footer">
                 
                <button type="submit" class="btn btn-success pull-right">Submit</button>
            </div>
             </form> 
        </div>
      </div>
      <div class="col-md-16 col-lg-16 col-xl-8">
        <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Settings</h5>
 
          </div>
          <div class="card-block">
                	<div id="success_body" class="alert alert-success alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                   	<div id="error_body" class="alert alert-danger alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                                             <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Wifi </label> 
                                </div>
                                <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="wifi-on">
                          <input name="wificommand" id="wifi-on" value="WIFI-ON" class="custom-control-input" checked="" type="radio"> <span class="custom-control-indicator"></span> 
                                 <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">ON</span>
                                </label>
                                <label class="custom-control custom-radio" for="wifi-off">
                          <input name="wificommand" id="wifi-off" value="WIFI-OFF" class="custom-control-input" checked="" type="radio">
                            <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">OFF</span>
                                </label>
                                </div>
                               </div>
                                
                                
                            </div>
                        </div>
                    </div>
                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Mobile Data
</label>
                                </div>
                                 <div class="col-lg-11 col-md-11">
                                <label class="custom-control custom-radio" for="mobiledata-on">
                                 <input name="mobiledata" id="mobiledata-on" class="custom-control-input" value="MOBILEDATA-ON" checked="" type="radio">
                       
                                   
                               <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">ON</span>
                                </label>
                                <label class="custom-control custom-radio" for="mobiledata-off">
                                 <input name="mobiledata" id="mobiledata-off" value="MOBILEDATA-OFF" class="custom-control-input" checked="" type="radio">
                         
                                 
                                   
                                      <span class="custom-control-indicator"></span> 
                                    <span class="custom-control-description">OFF</span>
                                </label>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>  
                    
                    
                                                 <div class="row ">
                        <div class="col-lg-16 col-md-16">
                            <div class="form-group ">
                            	<div class="row ">
                            	<div class="col-lg-5 col-md-5">
                                <label>Reset Phone
</label>
                                </div>
                                 <div class="col-lg-3 col-md-3">
                         <button id="resetphone" type="button" onclick="resetcommand('RESET_MOBILE')" class="btn btn-block btn-danger btn-xs">Reset</button>
                   
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>  
                    
          </div>
        
        </div>
          <!---------card------------>
          <div class="card full-screen-container">
          <div class="card-header align-items-start justify-content-between flex">
            <h5 class="card-title  pull-left">Data Export</h5>
 
          </div>
          <div class="card-block">
            	<form >
          	<div id="exsuccess_body" class="alert alert-success alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
                   	<div id="exerror_body" class="alert alert-danger alert-dismissable" style="padding-left: 30px;display:none;">
                     
                    Success alert preview. This alert is dismissable.
                  </div>
             
                  <div class="form-group">
                      <label for="inputPassword3" class="col-sm-8">Section</label>
                      <div class="col-sm-8">
            <select id="exmodule" name="exmodule" class="form-control">
            	<?php
            	foreach ($moduledata as $row) {
				 
            	?>
                        <option value="<?php echo $row['id'];?>"><?php echo $row['modulename'];?></option>
                        <?php
				}
                        ?>
                         
                      </select>
                      </div>
                    </div>
                <div class="box-footer">
                    <button type="button" onclick="exportdata()" class="btn btn-primary pull-right">Submit</button>
                  </div>
          	</div>
          </div>
          
          <!----------- card---------->
      </div>
    </div>
 
 
 <br> <br>
<br> <br><br> <br>
 <!---------------------->
 
 
 
 
 
  </div>
 <?php $this->view("footer");?>
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

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> <script src="../js/ie10-viewport-bug-workaround.js"></script> 

<!-- Circular chart progress js --> 
<script src="<?php echo base_url();?>dist/vendor/cicular_progress/circle-progress.min.js" type="text/javascript"></script> 

  <!--- time picker ---->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dist/timepicker/bootstrap-clockpicker.min.css">
 

<script type="text/javascript" src="<?php echo base_url();?>dist/timepicker/bootstrap-clockpicker.min.js"></script>
 
    <!-- end time picker--->
<!--sparklines js--> 
<script type="text/javascript" src="<?php echo base_url();?>dist/vendor/sparklines/jquery.sparkline.min.js"></script> 

<!-- custome template js --> 
<script src="<?php echo base_url();?>dist/js/adminux.js" type="text/javascript"></script>

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
                //Initiate all variables
               valautosync =  $("[name='autosync']:checked").val();
               
                if (valautosync == 1){
                	 if ($("[name='schedule']").val() == ""){
                    $("#st_error_body").append("<li>Sync time is not selected</li>");
                    global_error = true;
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
 $("#div_schedule").hide();
 <?php
		}
 ?>
});

function exportdata()
{
exmodule=	$("#exmodule").val();
 
	window.location.href="<?php echo site_url('exportdata/export_modules')."?id=".$_REQUEST['id'];?>&module="+exmodule;
}
    </script>
</body>
</html>