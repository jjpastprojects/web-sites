
		<!-- BEGIN SIDEBAR -->
		<div class="left side-menu">
			
			
            <div class="body rows scroll-y">
				
				<!-- Scrolling sidebar -->
                <div class="sidebar-inner slimscroller">
				
					<!-- User Session -->
					<div class="media">
						<a class="pull-left" href="#">
							{!! \App\Classes\Helper::getAvatar(Auth::user()->id) !!}
						</a>
						<div class="media-body">
							{!! trans('messages.Welcome back') !!},
							<h4 class="media-heading"><strong>{!! Auth::user()->first_name!!} {!! Auth::user()->last_name !!}</strong></h4>
							<a class="md-trigger" href="{!! URL::to('/logout') !!}">Logout</a> <br />
							<a href="#">{!! trans('messages.Last Login') !!} <br />{!! App\Classes\Helper::showDateTime(Auth::user()->last_login) !!} from {!! Auth::user()->last_login_ip !!}</a>
						</div><!-- End div .media-body -->
					</div><!-- End div .media -->
				@if(config('constants.MODE') == 0)
					<center><a href="http://codecanyon.net/item/x/{!! config('constants.ITEM_CODE') !!}?ref=wmlabs" class="btn btn-success btn-md" role="button">Buy Now</a></center>
				@endif
					<!-- Sidebar menu -->				
					<div id="sidebar-menu">
						<ul>
							<li><a href="{!! URL::to('/') !!}"><i class="fa fa-home icon"></i> {!! trans('messages.Dashboard') !!}</a></li>
							@if(Entrust::can('manage_client'))
							<li><a href=""><i class="fa fa-sitemap icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Clients') !!}</a>
								<ul>
									@if(Entrust::can('create_client'))
									<li><a href="{!! URL::to('/client/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/client') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Client') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_location'))
							<li><a href=""><i class="fa fa-star icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Location') !!}</a>
								<ul>
									@if(Entrust::can('create_location'))
									<li><a href="{!! URL::to('/location/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/location') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Location') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::hasRole('admin'))
							<li><a href="{!! URL::to('/reporting') !!}"><img src="{!! URL::to('/assets/img/report.png') !!}"></img> &nbsp;&nbsp;{!! trans('messages.Reporting') !!}</a></li>
							@endif
							@if(Entrust::can('manage_employee'))
							<li><a href=""><i class="fa fa-users icon"></i><i class="fa fa-angle-double-down i-right"></i>  {!! trans('messages.Reporting') !!} </a></li>
								<ul>
									@if(Entrust::can('create_employee'))
									<li><a href="{!! URL::to('/employee/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/employee') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Employee') !!}</a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_job'))
							<li><a href=""><i class="fa fa-bullhorn icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Jobs') !!} </a>
								<ul>
									@if(Entrust::can('create_job'))
									<li><a href="{!! URL::to('/job/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/job') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Job') !!}</a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_expense'))
							<li><a href=""><i class="fa fa-credit-card icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Expense') !!} </a>
								<ul>
									@if(Entrust::can('create_expense'))
									<li><a href="{!! URL::to('/expense/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/expense') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Expense') !!}</a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_award'))
							<li><a href=""><i class="fa fa-trophy icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Award') !!}</a>
								<ul>
									@if(Entrust::can('create_award'))
									<li><a href="{!! URL::to('/award/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/award') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Award') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_notice'))
							<li><a href=""><i class="fa fa-list-alt icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Notice Board') !!}</a>
								<ul>
									@if(Entrust::can('create_notice'))
									<li><a href="{!! URL::to('/notice/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/notice') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Notice') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_holiday'))
							<li><a href="{!! URL::to('/holiday') !!}"><i class="fa fa-fighter-jet icon"></i> {!! trans('messages.Holiday') !!}</a></li>
							@endif
							<!--li><a href=""><i class="fa fa-book icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Attendance') !!}</a>
								<ul>
									@if(Entrust::can('update_attendance'))
									<li><a href="{!! URL::to('/update_attendance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Update Attendance') !!} </a></li>
									@endif
									@if(Entrust::can('daily_attendance'))
									<li><a href="{!! URL::to('/attendance') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Daily Attendance') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/attendance_monthly') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Monthly Attendance') !!} </a></li>
								</ul>
							</li-->
							@if(Entrust::can('manage_leave'))
							<li><a href=""><i class="fa fa-coffee icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Leave') !!}</a>
								<ul>
									@if(Entrust::can('create_leave'))
									<li><a href="{!! URL::to('/leave/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Request') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/leave') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Request') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_payroll'))
							<li><a href=""><i class="fa fa-money icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Payroll') !!}</a>
								<ul>
									@if(Entrust::can('create_payroll'))
									<li><a href="{!! URL::to('/payroll/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Generate') !!} </a></li>
									@endif
									@if(Entrust::can('all_payroll'))
									<li><a href="{!! URL::to('/payroll') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List all') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/my_payroll') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.My Payroll') !!} </a></li>
									<li><a href="{!! URL::to('/all_contribution') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Contribution') !!} </a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_ticket'))
							<li><a href=""><i class="fa fa-ticket icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Ticket') !!}</a>
								<ul>
									@if(Entrust::can('create_ticket'))
									<li><a href="{!! URL::to('/ticket/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/ticket') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Ticket') !!}</a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_task'))
							<li><a href=""><i class="fa fa-tasks icon"></i><i class="fa fa-angle-double-down i-right"></i> {!! trans('messages.Task') !!}</a>
								<ul>
									@if(Entrust::can('create_task'))
									<li><a href="{!! URL::to('/task/create') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.Add New') !!} </a></li>
									@endif
									<li><a href="{!! URL::to('/task') !!}"><i class="fa fa-angle-right"></i> {!! trans('messages.List Task') !!}</a></li>
								</ul>
							</li>
							@endif
							@if(Entrust::can('manage_message'))
							<li><a href="{!! URL::to('/message') !!}"><i class="fa fa-envelope icon"></i> {!! trans('messages.Message') !!}</a></li>
							@endif
							@if(Entrust::can('apply_job') && config('config.job_application_staff') == 'yes')
							<li><a href="{!! URL::to('/apply') !!}"><i class="fa fa-bullhorn icon"></i> {!! trans('messages.Job Vacancy') !!}</a></li>
							@endif
							@if(Entrust::can('manage_sms'))
							<li><a href="{!! URL::to('/sms') !!}"><i class="fa fa-mobile icon"></i> {!! trans('messages.SMS') !!}</a></li>
							@endif
						</ul>
						<div class="clear"></div>
					</div><!-- End div #sidebar-menu -->
				</div><!-- End div .sidebar-inner .slimscroller -->
            </div><!-- End div .body .rows .scroll-y -->
			
			<!-- Sidebar footer -->
            <div class="footer rows animated fadeInUpBig">
				<div class="logo-brand header sidebar rows">
					<div class="logo">
						<h1><a href="{!! URL::to('/') !!}"><img src="{!! URL::to('/assets/img/ems-wtext.png') !!}" alt="Logo"> {!! config('config.application_name') !!}  {!! config('constants.VERSION') !!}</a> </h1>
						<button class="sidebar-toggle">toggle</button>
					</div>
				</div>
            </div><!-- End div .footer .rows -->
        </div>
		<!-- END SIDEBAR -->