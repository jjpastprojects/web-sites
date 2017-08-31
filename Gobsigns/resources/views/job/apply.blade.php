@extends('layouts.blank')

	@section('content')
		<div class="row">
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Job') !!}
					</h2>
					@if(count($jobs) == 0)
					<div class="alert alert-danger">No Job Advertisement Found!! </div>
					@endif

					@foreach($jobs as $job)
					<div class="the-notes success">
						<h4>{!! $job->job_title !!}</h4>
						<span class="label label-danger">{!! $job->numbers !!} Vacancy</span>
						<p>
						{!! $job->job_description !!}
						</p>
						<p class="pull-right"><i class="fa fa-clock-o"></i> Posted On {!! date('d M Y',strtotime($job->created_at)) !!}</p>
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-sm-6">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Apply') !!}</strong>
					</h2>
					

					@if(Auth::check())
						<div class="alert alert-danger"><strong>Alert!</strong> You are applying for this job as staff!!</div>
					@endif
					{!! Form::open(['files' => 'true','route' => 'job.saveApplication','role' => 'form', 'class'=>'job-application-form']) !!}
					  <div class="form-group">
					    {!! Form::label('job_id',trans('messages.Select Job'),[])!!}
						{!! Form::select('job_id', [''=>''] + $job_lists,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Job'])!!}
					  </div>
					  @if(!Auth::check())
					  <div class="form-group">
					    {!! Form::label('name',trans('messages.Name'),[])!!}
						{!! Form::input('text','name','',['class'=>'form-control','placeholder'=>'Enter Your Name'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('contact_number',trans('messages.Contact Number'),[])!!}
						{!! Form::input('text','contact_number','',['class'=>'form-control','placeholder'=>'Enter Your Contact Number'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('email',trans('messages.Email'),[])!!}
						{!! Form::input('email','email','',['class'=>'form-control','placeholder'=>'Enter Your Email'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('address',trans('messages.Address'),[])!!}
					    {!! Form::textarea('address','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Address'])!!}
					  </div>
					  @endif
					  <div class="form-group">
					    {!! Form::label('app_description',trans('messages.Description'),[])!!}
					    {!! Form::textarea('app_description','',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
					  </div>
					  {{ App\Classes\Helper::getCustomFields('job-application-form',$custom_field_values) }}
					  <div class="form-group">
						<input type="file" name="resume" id="resume" class="btn btn-default" title="Select Resume">
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Apply'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop