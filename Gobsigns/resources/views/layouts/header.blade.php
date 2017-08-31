
			<!-- BEGIN CONTENT HEADER -->
            <div class="header content rows-content-header">
			
				<!-- Button mobile view to collapse sidebar menu -->
				<button class="button-menu-mobile show-sidebar">
					<i class="fa fa-bars"></i>
				</button>
				
				<!-- BEGIN NAVBAR CONTENT-->				
				<div class="navbar navbar-default flip" role="navigation">
					<div class="container">
						<!-- Navbar header -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<i class="fa fa-angle-double-down"></i>
							</button>
						</div><!-- End div .navbar-header -->
						
						<!-- Navbar collapse -->	
						<div class="navbar-collapse collapse">
						
							<!-- Left navbar -->
							<ul class="nav navbar-nav">
								
								<!-- Dropdown language -->
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Lang ({!! config('config.default_language') !!}) <i class="fa fa-chevron-down i-xs"></i></a>
									<ul class="dropdown-menu animated half flipInX">
										@if(Entrust::can('set_language'))
										@foreach($languages as $key => $language)
										<li><a href="{!! URL::to('/setLanguage/'.$key) !!}">{!! $language." (".$key.")" !!}</a></li>
										@endforeach
										@endif
										@if(Entrust::can('manage_language'))
										<li><a href="/language">Add More Language</a></li>
										@endif
									</ul>
								</li>
								<li>
								<a href="/todo" data-toggle='modal' data-target='#myTodoModal' ><i class="fa fa-list-ul"></i> To do</a>
								</li>
							</ul>
							
							<!-- Right navbar -->
							<ul class="nav navbar-nav navbar-right top-navbar">

							@if(Entrust::hasRole('admin') || Entrust::can('manage_custom_field') || Entrust::can('manage_sms_template') || Entrust::can('manage_template'))
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> {!! trans('messages.Setting') !!} <i class="fa fa-chevron-down i-xs"></i></a>
									<ul class="dropdown-menu animated half flipInX">
									@if(Entrust::hasRole('admin'))
										<li><a href="{!! URL::to('/configuration') !!}">{!! trans('messages.Configuration') !!}</a></li>
									@endif
									@if(Entrust::can('manage_custom_field'))
										<li><a href="{!! URL::to('/custom_field') !!}">{!! trans('messages.Custom Fields') !!}</a></li>
									@endif
									@if(Entrust::can('manage_template'))
										<li><a href="{!! URL::to('/template') !!}">{!! trans('messages.Email Template') !!}</a></li>
									@endif
									@if(Entrust::can('manage_sms_template'))
										<li><a href="{!! URL::to('/sms_template') !!}">{!! trans('messages.SMS Template') !!}</a></li>
									@endif
									</ul>
								</li>
								@endif
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i>
										{!! ($header_inbox_count) ? '<span class="label label-danger absolute">'.$header_inbox_count.'</span>' : '' !!}
									</a>
									<ul class="dropdown-menu dropdown-message animated half flipInX">
										@if(!$header_inbox_count)
										<li class="dropdown-header notif-header">
											No unread message
										</li>
										@endif
										<li class="dropdown-header notif-header">New Messages</li>
										@foreach($header_inbox as $inbox)
										<li class="unread">
											<a href="{!! URL::to('/message/view/'.$inbox->id.'/'.$token) !!}">
												{!! \App\Classes\Helper::getAvatar($inbox->user_id) !!}
												<div style="margin-left:75px;">
													<strong>{!! $inbox->name !!}</strong><br />
													<p><i>{!! \App\Classes\Helper::showDateTime($inbox->time) !!}</i><br />
													{!! $inbox->subject !!}</p>
												</div>
											</a>
										</li>
										@endforeach

										@if($header_inbox_count > count($header_inbox))
										<li class="dropdown-footer">
											<a href="/message">
												<i class="fa fa-share"></i> See all messages
											</a>
										</li>
										@endif
									</ul>
								</li>

								@if(Entrust::hasRole('admin'))
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-coffee"></i>
											{!! ($header_leave_count) ? '<span class="label label-danger absolute">'.$header_leave_count.'</span>' : '' !!}
										</a>
										<ul class="dropdown-menu dropdown-message animated half flipInX">
											@if(!$header_leave_count)
											<li class="dropdown-header notif-header">
												No pending leave
											</li>
											@endif
											<li class="dropdown-header notif-header">New Pending Leave</li>
											<li class="divider"></li>
											@foreach($header_leave as $leave)
											<li class="unread">
												<a href="{!! URL::to('/leave/'.$leave->id) !!}">
													{!! \App\Classes\Helper::getAvatar($leave->user_id) !!}
													<div style="margin-left:75px;">
														<strong>{!! $leave->User->first_name !!}</strong><br />
														<p><i>{!! \App\Classes\Helper::showDateTime($leave->created_at) !!}</i><br />
														{!! $leave->LeaveType->leave_type_name.' 
														from '.\App\Classes\Helper::showDate($leave->from_date).' 
														to '.\App\Classes\Helper::showDate($leave->to_date) !!}</p>
													</div>
												</a>
											</li>
											@endforeach

											@if($header_leave_count > count($header_leave))
											<li class="dropdown-footer">
												<a href="/leave">
													<i class="fa fa-share"></i> See all leaves
												</a>
											</li>
											@endif
										</ul>
									</li>
								@endif

								<li class="dropdown"><a href="#">{!! App\Classes\Helper::showDateTime(date('d M Y,h:i a')) !!}</a></li>
								
								<!-- Dropdown User session -->
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! trans('messages.Hello') !!}, <strong>{!! Auth::user()->first_name." ".Auth::user()->last_name !!}</strong> <i class="fa fa-chevron-down i-xs"></i></a>
									<ul class="dropdown-menu animated half flipInX">
										<li><a href="{!! URL::to('/change_password') !!}">Change Password</a></li>
										<li><a href="{!! URL::to('/logout') !!}">Logout</a></li>
									</ul>
								</li>
								<!-- End Dropdown User session -->
							</ul>
						</div><!-- End div .navbar-collapse -->
					</div><!-- End div .container -->
				</div>
				<!-- END NAVBAR CONTENT-->
            </div>
			<!-- END CONTENT HEADER -->
				