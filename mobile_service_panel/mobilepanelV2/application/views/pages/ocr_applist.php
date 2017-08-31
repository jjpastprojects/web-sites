<style>
 .label-warning{
 	background-color: #E3667F;
 	padding: 3px 5px;
 	color:#fff;
 }
 .bg-red{
 	background-color: #E3667F;
 	padding: 3px 5px;
 	color:#fff;
 }
 .label-success{
 	background-color: #10A694;
 	padding: 3px 5px;
 	color:#fff;
 }
 .bg-primary{
 	background-color: #25A5C4;
 	padding: 3px 5px;
 	color:#fff;
 }
</style>
<div class="wrapper-content">
  <div class="container">
    <div class="row  align-items-center justify-content-between">
      <div class="col-11 col-sm-12 page-title">
        <h3> All App List</h3>
         
      </div>
       <div class="col text-right ">
        <div class="btn-group pull-right">
          <a href="<?php echo site_url("admin/manage_ocrapp");?>" class="btn btn-success btn-round "     ><span class="text">Add</span> <i class="fa fa-plus ml-2"></i></a>          
        </div>
      </div> 
    </div>
   

 
 
    <div class="row">
      <div class="col-sm-16">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title"> List  </h5>
          </div>
          <div class="card-block">
            <table class="table " id="table-grid">
              <thead>
                <tr>
                        <th>Sr.no.</th>
                         <th>Application</th>
                         <th>Package Name</th>
                        <th>Application To Track</th>
                         <th>Actions</th>
                          
                      </tr>
              </thead>
              <tbody>
      
              </tbody>
            </table>
            <!-- /.table-responsive --> 
          </div>
        </div>
      </div>
    </div>
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
<!--<script src="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script> -->

<!-- chart js --> 
<!--<script src="<?php echo base_url();?>dist/vendor/chartjs/Chart.bundle.min.js" type="text/javascript"></script> -->
<script src="<?php echo base_url();?>dist/vendor/chartjs/utils.js" type="text/javascript"></script> 

<!-- spincremente js --> 
<script src="<?php echo base_url();?>dist/vendor/spincrement/jquery.spincrement.min.js" type="text/javascript"></script> 

<!-- DataTables JavaScript --> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/dataTables.bootstrap4.js"></script> 
<script src="<?php echo base_url();?>dist/vendor/datatables/js/dataTables.responsive.min.js"></script> 

<!-- custome template js --> 
<script src="<?php echo base_url();?>dist/js/adminux.js" type="text/javascript"></script> 
<!--<script src="<?php echo base_url();?>dist/js/dashboard1.js"></script>-->
<script>
	$('#dataTables-example').DataTable({
    responsive: true,
    pageLength:10,
    sPaginationType: "full_numbers",
    oLanguage: {
        oPaginate: {
            sFirst: "<<",
            sPrevious: "<",
            sNext: ">", 
            sLast: ">>" 
        }
    }
});


		$(document).ready(function() {
				var dataTable = $('#table-grid').DataTable( {
					"processing": true,
					"serverSide": true,	
					 "order": [[ 0, "desc" ]],				
					"ajax":{
						url :'<?=site_url('dt_con/get_applist_dt');?>', // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
			function delete_ocrapp(id)
			{
				if(confirm("Do you really want to delete?")){
				$.ajax({type:'POST',
                    url: '<?=site_url('admin/delete_ocrapp');?>', 
                  data:{"id":id},
                  success: function(data){
                  	if(data==1){
                  		alert("Deleted successfully");
                  	}else{
                  		alert("Error occur");
                  	}
                  	window.location.reload();


}
	});
				
			}
			}
			
			
			/// toggle status
			
			function toggleStatus(url_address,spanid,loadingdiv)
{   
  
    var spanvalue = $('#'+spanid).text();
    $('#'+loadingdiv).css('display','inline');
    var action='status';
    var status = '1';
    if(spanvalue=='Enable' || spanvalue=='Active' || spanvalue=='Close' || spanvalue=='Approve')
    {  
       status = '0';
    }
  

    $.ajax({type:'GET',url: url_address,
   success: function(response) {
        
       statusfeedback(response,spanid,loadingdiv);
     }});
}





function statusfeedback(retstatus,spanid,loadingdiv) 
{
    retstatus=retstatus.trim();
    //alert(retstatus);
    if(retstatus=="-1")
    {
        return;
    }
    else if(retstatus=='0')
    {
        $('#'+spanid).removeClass('label-success').addClass('label-warning');
        $('#'+spanid).text("Not Track");
    }
    else if(retstatus=='Not Track' || retstatus=='Enable' || retstatus=='Open' || retstatus=='Close' || retstatus=='Pending' || retstatus=='Approve' || retstatus=='Block')
    {
        if(retstatus=='Track' || retstatus=='Open' || retstatus=='Approve')
        {
            $('#'+spanid).removeClass('label-important').addClass('label-success');
        }
        else
        {
             $('#'+spanid).removeClass('label-success').addClass('label-important');
        }
       
        $('#'+spanid).text(retstatus);
    }
    else
    {
        $('#'+spanid).removeClass('label-warning').addClass('label-success');
        $('#'+spanid).text("Track");
    }
    $('#'+loadingdiv).css('display','none');
}

			///end of toggle status
    </script>
</body>
</html>