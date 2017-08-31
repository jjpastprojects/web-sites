@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-3">
				<!-- Begin user profile -->
				<div class="box-info">
					{!! App\Classes\Helper::getAvatar($leave->user_id) !!}
					<div style="margin-left:75px;">
						<h4>{!! trans('messages.Leave Request') !!} # {!! str_pad($leave->id, 3, 0, STR_PAD_LEFT) !!}</h4>
						<h5><strong>{!! $employee->first_name !!} {!! $employee->last_name !!}</strong></h5>
						<h5>{!! $location->location !!} in {!! $client->client_name !!} Dept</h5>
					</div>
				</div><!-- End div .box-info -->
				<!-- Begin user profile -->
			</div><!-- End div .col-sm-4 -->
			
			<div class="col-sm-9">
				<div class="box-info full">
					<!-- Nav tab -->
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-pencil"></i> {!! trans('messages.Leave Detail') !!}</a></li>
					  <li><a href="#other" data-toggle="tab"><i class="fa fa-coffee"></i> {!! trans('messages.Other Leave') !!}</a></li>
					</ul>
					<!-- End nav tab -->

					<!-- Tab panes -->
					<div class="tab-content">
						<!-- Tab timeline -->
						<div class="tab-pane animated active fadeInRight" id="detail">
							<div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<h5><strong>{!! trans('messages.Leave') !!}</strong> {!! trans('messages.Type') !!}</h5>
											<address>
												<strong>{!! $leave->LeaveType->leave_name !!}</strong>
											</address>
											<address>
												<strong>From {!! date('d M Y',strtotime($leave->from_date)) !!} To 
												{!! date('d M Y',strtotime($leave->to_date)) !!}</strong>
											</address>
											<address>
												<strong>{!! trans('messages.Reason') !!}</strong><br>
												{!! $leave->leave_description !!}
											</address>
									</div>
									<div class="col-sm-6">
										@if(Entrust::can('edit_leave_status') && $leave->user_id != Auth::user()->id)
										{!! Form::open(['route' => 'leave.updateStatus','role' => 'form', 'class'=>'leave-form']) !!}
										  <div class="form-group">
										    {!! Form::label('leave_status',trans('messages.Leave Status'),[])!!}
											{!! Form::radio('leave_status', 'pending', ($leave->leave_status == 'pending') ? 'checked' : '') !!} Pending
											{!! Form::radio('leave_status', 'approved', ($leave->leave_status == 'approved') ? 'checked' : '') !!} Approved
											{!! Form::radio('leave_status', 'rejected', ($leave->leave_status == 'rejected') ? 'checked' : '') !!} Rejected
										  </div>
										  <div class="form-group">
										    {!! Form::label('leave_comment',trans('messages.Comment'),[])!!}
										    {!! Form::textarea('leave_comment',isset($leave->leave_comment) ? $leave->leave_comment : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
										  </div>
										  {!! Form::hidden('id',$leave->id) !!}
										  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
										{!! Form::close() !!}
										@else
										<h5><strong>Leave</strong> Status</h5>
											@if($leave->leave_status == 'pending')
												<span class="label label-info btn-lg">{!! trans('messages.Pending') !!}</span>
											@elseif($leave->leave_status == 'approved')
												<span class="label label-success btn-lg">{!! trans('messages.Approved') !!}</span>
											@else
												<span class="label label-danger btn-lg">{!! trans('messages.Rejected') !!}</span>
											@endif

											<p>{!! $leave->leave_comment !!}</p>
										@endif
									</div>
								</div><!-- End div .row -->
							</div><!-- End div .user-profile-content -->
						</div><!-- End div .tab-pane -->
						<!-- End Tab timeline -->
						<div class="tab-pane animated fadeInRight" id="other">
							<div class="user-profile-content">
								@if(count($other_leaves))
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.From') !!}</th>
												<th>{!! trans('messages.To') !!}</th>
												<th>{!! trans('messages.Description') !!}</th>
												<th>{!! trans('messages.Status') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($other_leaves as $other_leave)
												<tr>
													<td>{!! date('d M Y',strtotime($other_leave->from_date)) !!}</td>
													<td>{!! date('d M Y',strtotime($other_leave->to_date)) !!}</td>
													<td>{!! $other_leave->leave_description !!}</td>
													<td>{!! ucfirst($other_leave->leave_status) !!}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@else
									<div class="alert alert-danger alert-dismissable">
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									  <strong>{!! trans('messages.Info') !!}!</strong> This employee has not yet applied for any other leave!!
									</div>
								@endif
							</div>
						</div>
						
					</div><!-- End div .tab-content -->
				</div><!-- End div .box-info -->
			</div>
		</div>
	@stop