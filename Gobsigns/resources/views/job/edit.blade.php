@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Job') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/job/create">{!! trans('messages.Add New Job') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/job">{!! trans('messages.List All Job') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($job,['method' => 'PATCH','route' => ['job.update',$job->id] ,'class' => 'job-form']) !!}
						@include('job._form', ['buttonText' => 'Update Job'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
				Here you can edit job vacancy details. Once edited, it will be refected immediately to the applicants. You can also
				change the job vacancy status to in-active, which will stop showing that job to the applicants.
				</div>
			</div>
		</div>

	@stop