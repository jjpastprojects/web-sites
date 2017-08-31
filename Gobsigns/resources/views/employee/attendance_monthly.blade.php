@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-10">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Select Month & Year') !!}</strong></h2>
					{!! Form::open(['route' => 'clock.attendanceMonthlyReport','role' => 'form','class'=>'form-inline']) !!}
					  <div class="form-group">
						{!! Form::select('month', [null=>'Please select'] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Month'])!!}
						{!! Form::select('year', [null=>'Please select'] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Year'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::select('user_id', [null => 'Please Select'] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User'])!!}
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Get'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			@if(isset($cols_summary))
			<div class="col-sm-2">
				<ul class="list-group">
				  <li class="list-group-item">
					<span class="badge badge-danger">{!! array_key_exists('A',$cols_summary) ? $cols_summary['A'] : '-' !!}</span>
					Absent
				  </li>
				  <li class="list-group-item">
					<span class="badge badge-info">{!! array_key_exists('H',$cols_summary) ? $cols_summary['H'] : '-' !!}</span>
					Holiday
				  </li>
				  <li class="list-group-item">
					<span class="badge badge-success">{!! array_key_exists('P',$cols_summary) ? $cols_summary['P'] : '-' !!}</span>
					Present
				  </li>
				</ul>
			</div>
			@endif
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Attendance') !!}</strong> @if(isset($user)) {!! trans('messages.of') !!} {!! $user->first_name." ".$user->last_name." (".$user->Location->location." in ".$user->Location->Client->client_name.") for ".ucfirst($month)." ".$year !!} @endif</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop