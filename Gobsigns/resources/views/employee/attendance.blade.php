@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Set Date') !!}</strong></h2>
					{!! Form::open(['route' => 'clock.attendance','role' => 'form','class'=>'form-inline']) !!}
						<div class="form-group">
							<label class="sr-only" for="date">{!! trans('messages.Date') !!}</label>
							<input type="text" class="form-control datepicker-input" id="date" name="date" placeholder="Date" readonly="true" value="{!! $date !!}">
							<button type="submit" class="btn btn-default btn-success">{!! trans('messages.Get') !!}</button>
					  	</div>

					{!! Form::close() !!}
				</div>
			</div>
			@if(isset($cols_summary))
			<div class="col-sm-2 pull-right">
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
					<h2><strong>{!! trans('messages.Attendance') !!}</strong> {!! trans('messages.for') !!} {!! date('d-M-Y',strtotime($date)) !!}</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
		</div>

	@stop