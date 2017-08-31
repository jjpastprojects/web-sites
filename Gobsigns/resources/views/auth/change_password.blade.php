@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Change') !!} </strong> {!! trans('messages.Password') !!}</h2>
					
					{!! Form::open(['route' => 'change_password','role' => 'form', 'class' => 'form-horizontal change-password-form']) !!}
						
					  <div class="form-group">
					    {!! Form::label('old_password',trans('messages.Current Password'),['class' => 'col-sm-2 control-label'])!!}
					    <div class="col-sm-10">
							{!! Form::input('password','old_password','',['class'=>'form-control','placeholder'=>'Enter Current Password'])!!}
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('new_password',trans('messages.New Password'),['class' => 'col-sm-2 control-label'])!!}
					    <div class="col-sm-10">
							{!! Form::input('password','new_password','',['class'=>'form-control','placeholder'=>'Enter New Password'])!!}
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('new_password_confirmation',trans('messages.New Confirm Password'),['class' => 'col-sm-2 control-label'])!!}
					    <div class="col-sm-10">
							{!! Form::input('password','new_password_confirmation','',['class'=>'form-control','placeholder'=>'Enter New Confirm Password'])!!}
						</div>
					  </div>
					  <div class="col-sm-offset-2 col-sm-10">
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
					  </div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop