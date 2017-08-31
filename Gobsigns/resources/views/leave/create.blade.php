@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Request') !!}</strong> {!! trans('messages.Leave') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/leave">{!! trans('messages.List All Leave') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'leave.store','role' => 'form', 'class'=>'leave-form']) !!}
						@include('leave._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Oftenly employer has to keep records of the employees who want leave for various reason. This module
				enables the employer to keep their leave record. Employee can directly request for leave by submitting the form. Form contains leave type, duration 
				of leave & leave detail. Once submitted the form, it can be approved or rejected based on the situation. Employee can get the leave status on the leave detail page.</div>
			</div>
		</div>

	@stop