@extends('layouts.default')

	@section('content')
		
		<style>
			ul.tree, ul.tree ul {
			 list-style-type: none;
			 background: url('/assets/images/vline.png') repeat-y;
			 margin: 0;
			 padding: 0;
			}

			ul.tree ul {
			 margin-left: 10px;
			}

			ul.tree li {
			 margin: 0;
			 padding: 0 12px;
			 line-height: 20px;
			 background: url('/assets/images/node.png') no-repeat;
			 color: #3F3E48;
			 font-weight: bold;
			}

			ul.tree li.last {
			 background: #fff url('/assets/images/lastnode.png') no-repeat;
			}
			ul.tree li:last-child {
			 background: #fff url('/assets/images/lastnode.png') no-repeat;
			}
		</style>
		@if(Entrust::hasRole('admin'))
		<div class="row">
			<div class="col-sm-3 col-xs-6">
				<div class="box-info">
					<div class="icon-box">
						<span class="fa-stack">
						  <i class="fa fa-circle fa-stack-2x info"></i>
						  <i class="fa fa-sitemap fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						<h3>{!! $dept_count !!}</h3>
						<p>{!! trans('messages.Client') !!}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info">
					<div class="icon-box">
						<span class="fa-stack">
						  <i class="fa fa-circle fa-stack-2x warning"></i>
						  <i class="fa fa-users fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						<h3>{!! $user_count !!}</h3>
						<p>{!! trans('messages.Total Staff') !!}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info">
					<div class="icon-box">
						<span class="fa-stack">
						  <i class="fa fa-circle fa-stack-2x success"></i>
						  <i class="fa fa-user fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						<h3>{!! $present_count !!}</h3>
						<p>{!! trans('messages.Present Staff') !!}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6">
				<div class="box-info">
					<div class="icon-box">
						<span class="fa-stack">
						  <i class="fa fa-circle fa-stack-2x danger"></i>
						  <i class="fa fa-tasks fa-stack-1x fa-inverse"></i>
						</span>
					</div>
					<div class="text-box">
						<h3>{!! $task_count !!}</h3>
						<p>{!! trans('messages.Pending Task') !!}</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Notice') !!}</strong> {!! trans('messages.Board') !!}</h2>
					<div class="notice-widget" >
					@if(count($notices))
						@foreach($notices as $notice)
							<div class="the-notes info">
								<h4>{!! $notice->title !!}</h4>
								<p>
								{!! $notice->content !!}
								</p>
								<p class="time pull-right">{!! trans('Published by') !!} {!! $users[$notice->username] !!}</p>
							</div>
						@endforeach
					@else
						<div class="alert alert-danger">
						  {!! trans('No content found!!') !!}
						</div>
					@endif
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Company Hierarchy') !!}</strong></h2>
					<div class="notice-widget" >
						<p class="alert alert-info"><strong>{!! Auth::user()->first_name.' '.Auth::user()->last_name.', You have '.$child_staff_count !!} staff under your location.
						</strong></p>
						<h4><strong>You : {!! Auth::user()->Location->location.' ('.Auth::user()->Location->Client->client_name.')' !!}
						</strong></h4>
			   			{!! App\Classes\Helper::createLineTreeView($tree,Auth::user()->location_id) !!}
		   			</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<div id="calendar"></div>
				</div>

			</div>
			<div class="col-sm-4">
				<div class="box-info">
					@if($clock_status == 'NA')
					<a href="{!! URL::to('/clock/in/'.$token) !!}" class="btn btn-success btn-md" role="button"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.Clock in') !!}</a>
					@elseif($clock_status == 'IN')
					<button class="btn btn-success btn-md"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.You are clocked in !!') !!}</button>
					<a href="{!! URL::to('/clock/out/'.$token) !!}" class="btn btn-danger btn-md" role="button"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.Clock Out') !!}</a>
					@else
					<button class="btn btn-danger btn-md"><i class="fa fa-arrow-circle-right"></i> {!! trans('messages.You are clocked out !!') !!}</button>
					@endif

					<div class="clear"></div>

					<br />
					@if(Entrust::can('upload_attendance'))
						{!! Form::open(['files' => 'true','route' => 'clock.uploadAttendance','role' => 'form', 'class'=>'form-inline upload-attendance-form']) !!}
						  <div class="form-group">
							<label class="sr-only" for="file">Upload File</label>
							<input type="file" name="file" id="file" class="btn btn-info" title="Select File">
						  </div>
						  <button type="submit" class="btn btn-default">Upload Attendance</button>
						  <div class="help-block"><strong>Note!</strong> Only xls or xlsx file is allowed!! <a href="{!! URL::to('/sample.xlsx') !!}">Click here for Sample File.</a></div>
						{!! Form::close() !!}
					@endif
				</div>

				
			</div>
		</div>

		@if(Entrust::hasRole('admin'))
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('Employee') !!}</strong> {!! trans('Statistic') !!}</h2>
					<div id="website-statistic" class="statistic-chart collapse in">
						<div id="morris-home" style="height: 200px;"></div>
					</div>
				</div>
				
			</div>
		</div>
		@endif

		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Recent') !!}</strong> {!! trans('messages.Activity') !!}</h2>
					<div class="chat-widget">
						<ul class="media-list">
						@foreach($activities as $activity)
						  <li class="media">
							<a class="pull-{!! App\Classes\Helper::activityShow() !!}" href="#">
							{!! \App\Classes\Helper::getAvatar($activity->user_id) !!}
							</a>
							<div class="media-body {!! App\Classes\Helper::activityColorShow() !!}">
							  <strong>@if(Auth::user()->id == $activity->user_id) Me @else {!! $activity->employee_name !!} @endif</strong><br />
							  {!! $activity->text !!}
							  <p class="time">{!! App\Classes\Helper::showDateTime($activity->created_at) !!}</p>
							</div>
						  </li>
						@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Quick') !!}</strong> {!! trans('messages.Message') !!}</h2>
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu5" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right flip animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu5">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message/compose">{!! trans('messages.Compose') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message">{!! trans('messages.Go to Inbox') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/message/sent">{!! trans('messages.Go to Sent Folder') !!}</a></li>
						  </ul>
						  <a class="additional-icon" href="#" data-toggle="collapse" data-target="#quick-post"><i class="fa fa-chevron-down"></i></a>
					</div>
					
					<div id="quick-post" class="collapse in">
						{!! Form::open(['route' => 'message.store','role' => 'form', 'class'=>'compose-form']) !!}
							<div class="form-group">
								{!! Form::select('to_user_id', [null=>'Please select'] + $compose_users, '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Staff'])!!}
							</div>
							<div class="form-group">
								{!! Form::input('text','subject','',['class'=>'form-control input-lg','placeholder'=>'Message subject'])!!}
							</div>
							<div class="form-group">
								{!! Form::textarea('content','',['class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
							</div>
							<div class="row">
								<div class="col-md-6">
									<button type="submit" class="btn btn-sm btn-success">{!! trans('messages.Send') !!}</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Task') !!}</strong> {!! trans('messages.Progress') !!}</h2>
					@foreach($tasks as $task)
					<p>{!! $task->task_title !!} <strong>{!! $task->task_progress!!}% {!! trans('messages.Complete') !!}</strong></p>
					<div class="progress progress-sm">
					  <div class="progress-bar progress-bar-{!! App\Classes\Helper::activityTaskProgressColor($task->task_progress) !!}" role="progressbar" aria-valuenow="{!! $task->task_progress!!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! $task->task_progress!!}%">
						<span class="sr-only">{!! $task->task_progress!!}% {!! trans('messages.Complete') !!}</span>
					  </div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		
	@stop