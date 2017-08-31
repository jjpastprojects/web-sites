@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Update Attendance') !!}</strong></h2>
					
					{!! Form::open(['route' => 'clock.updateAttendance','role' => 'form','class'=>'']) !!}
						
					  <div class="form-group">
					    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
					    {!! Form::select('user_id', [null => 'Please Select'] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('date',trans('messages.Date'),[])!!}
						{!! Form::input('text','date','',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date','readonly' => 'true'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('clock_in',trans('messages.Clock in'),[])!!}
		                <div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="clock_in" data-link-format="HH:ii p">
		                    <input class="form-control" size="16" type="text" value="" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" name="clock_in" id="clock_in" value="" /><br/>
					  </div>
					  <div class="form-group">
					    {!! Form::label('clock_out',trans('messages.Clock out'),[])!!}
		                <div class="input-group date timepicker col-md-5" data-date="" data-date-format="HH:ii p" data-link-field="clock_out" data-link-format="HH:ii p">
		                    <input class="form-control" size="16" type="text" value="" readonly>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
		                </div>
						<input type="hidden" name="clock_out"  id="clock_out" value="" /><br/>
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Update'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Help') !!}</strong></h2>
					You can easily update attendance of any employee, even if he/she has not marked his/her attendance. You can left blank clock in or clock out if you only want to update one of the field. Please note that
					in every case clock in time is always less than clock out time.
				</div>
			</div>
		</div>

	@stop