@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Job Vacancy') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/job">{!! trans('messages.List All Job') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'job.store','role' => 'form', 'class'=>'job-form']) !!}
						@include('job._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
				Your company has job vacancy, post here. You can further choose who can access this job vacancy, either company staff or non-working staff. Applicants can fill up the forms
				and their details will be stored in the database, which can be utilized for staff hiring. You may reject or select application as per your requirements.
				</div>
			</div>
		</div>

	@stop