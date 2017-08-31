<div class="wrapper-content">
 
  <div class="container">
<br><br>
    
    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="profile" role="tabpanel">
        <div class="row">
        
          <div class="col-sm-16">
            <h3 class="mt-2" >Edit User</h3>
            <hr>
          </div>
          <form id="editprofile" class="col-sm-16">
          	 	<div class="form-group">
                                        <ul class="alert alert-danger" id="error_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
                        <div class="form-group">
                                        <ul class="alert alert-success" id="success_body" style="padding-left: 30px;display:none;"></ul>
                        </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <label>Device Name</label>
                    <input type="text" name="username"  class="form-control" id="username" value="<?php echo $admin['device_name'];?>" placeholder="Enter username">
                  </div>
                     </div>
           <div class="form-group row">
                  <div class="col-lg-8 col-md-8">
                    <label>Image</label>
                    <input type="file" id="image"  name="image"  class="form-control" placeholder="Password">
                  </div>
                </div>
                 <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" />
                 
                
                 
                 
        
              </div>
   
            </div>
            <div class="mb-2 row">
              <div class="col-lg-16">
                <hr>
                <button type="submit" name="submit"  id="btnsubmit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane " id="orders" role="tabpanel">
        <div class="alert alert-danger" >
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="alert-heading">Oopss!</h4>
          <p>You have something missed, Please fillup required fields to procceed further. Read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content. </p>
        </div>
      </div>
      <div class="tab-pane " id="messages" role="tabpanel">
        <div class="alert alert-info" >
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="alert-heading">Well done!</h4>
          <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        </div>
        <div class="row">
          <div class="col-lg-8 col-sm-16">
            <div class="list-unstyled media-list" style="max-height:800px">
              <div class="media active new"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome </h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma<small class="text-danger pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Maxartkiller <small class="text-success pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
              <div class="media new"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome <small class="text-warning pull-right"><i class="fa fa-flag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma <small class="text-primary pull-right"><i class="fa fa-tag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Maxartkiller <small class="text-danger pull-right"><i class="fa fa-tag"></i></small></h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Adminux Welcome </h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body">
                  <h6 class="mt-0 mb-1">Anchal Sharma</h6>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging. </p>
                </div>
              </div>
              <div class="media"> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                <div class="media-body"> <span class="mt-0 mb-1">Maxartkiller</span>
                  <p>2:00 pm, 20 January, 2017</p>
                  <p class="description ">This is awesome product and, I am very happy with delivery &amp; product packaging..</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col  pb-2 hidden-md-down">
            <div class="col p0" style="max-height:800px; overflow-y:auto">
              <div class="options-mail">
                <ul class="nav nav-pills pull-left">
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-reply"></i> Reply</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-reply-all"></i> Reply All</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-forward"></i> Forward</button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-link "><i class="fa fa-trash"></i> Delete</button>
                  </li>
                </ul>
                <ul class="nav nav-pills pull-right">
                  <li class="nav-item">
                    <button class="btn btn-sm btn-outline-primary "><i class="fa fa-chevron-left"></i></button>
                  </li>
                  <li class="nav-item">
                    <button class="btn btn-sm btn-outline-primary ml-2"><i class="fa fa-chevron-right"></i></button>
                  </li>
                </ul>
              </div>
              <div class="clearfix"></div>
              <h3 class="mt-2">Adminux Welcome</h3>
              <div class="list-unstyled comment-list">
                <div class="media "> <span class="message_userpic"><img class="d-flex" src="../img/user-header.png" alt="Generic user image"> <span class="user-status bg-success "></span></span>
                  <div class="media-body">
                    <h6 class="mt-0 mb-1">Maxartkiller<small class="pull-right">2:00 pm, 20 January, 2017</small></h6>
                    <p class="description mb-0">info@maxartkiller.in </p>
                  </div>
                </div>
              </div>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem <br>
                ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend <br>
                <br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend <br>
                <br>
                Thanks,<br>
                <b>Lucky Sans</b></p>
              <div class="row m-0">
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="../img/project_pic3.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="../img/project_pic3.jpg" alt="post picture"></a> </figure>
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="../img/project_pic1.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="../img/project_pic1.jpg" alt="post picture"></a> </figure>
                <figure class="responsive-img col-lg-4 col-md-8"> <a href="../img/project_pic2.jpg" rel="gallery-2" class="swipebox" title="My Caption"><img src="../img/project_pic2.jpg" alt="post picture"></a> </figure>
              </div>
              <br>
              <hr>
              <h2 class="page_subtitles">Quick Reply <small><a href="" class="pull-right">More options</a></small></h2>
              <textarea class="form-control dark-input" rows="4" placeholder="Write your message here"></textarea>
              <br>
              <button class="btn btn-primary">Send</button>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="settings" role="tabpanel">
        <div class="alert alert-warning" >
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="alert-heading">Well done!</h4>
          <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
        </div>
        4 </div>
    </div>
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


<!--sparklines js--> 
<script type="text/javascript" src="<?php echo base_url();?>dist/vendor/sparklines/jquery.sparkline.min.js"></script> 

<!-- custome template js --> 
<script src="<?php echo base_url();?>dist/js/adminux.js" type="text/javascript"></script>

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
                if ($("[name='username']").val() == ""){
                    $("#error_body").append("<li>Device Name is empty</li>");
                    global_error = true;
                } 
                  
              
               if (!global_error){
               	/*
               	new_start=stringToTimestamp(start);
               	$("[name='start']").val(new_start);
               new_end =	stringToTimestamp(end);
               		$("[name='end']").val(new_end);*/
                 var formData = new FormData(this);
              formData.append('image', $("#image").prop('files')[0]);

                 $.ajax({
                url		:	"<?php echo site_url('admin/update_user'); ?>",
                type	:	"POST",
                processData: false,
                contentType: false,
                data	:	formData,
                dataType: "JSON",
                success	:	function(data){
                 	 if (data == "1")
                    {
                    	 $("#success_body").append("<li>User updated successfull</li>");
                    	   $("#success_body").show();
                    	window.location='<?php echo site_url('admin/users'); ?>';
                    }else if(data == "2"){
                    	 $("#error_body").append("<li>Image uploading error!</li>");
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
</body>
</html>