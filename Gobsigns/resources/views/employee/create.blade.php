@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!} </strong> {!! trans('messages.Employee') !!}</h2>

					<form method="POST" action="/auth/register" accept-charset="UTF-8" class="form-horizontal employee-form">
    				  	{!! csrf_field() !!}
						  <div class="form-group">
						    {!! Form::label('first_name',trans('messages.First Name'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','first_name','',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('last_name',trans('messages.Last Name'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','last_name','',['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('employee_code',trans('messages.Employee Code'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','employee_code','',['class'=>'form-control','placeholder'=>'Enter employee code'])!!}
							</div>
						  </div>	
						  <div class="form-group">
						    {!! Form::label('location_id',trans('messages.Location'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
							{!! Form::select('location_id', [''=>''] + $locations,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Location'])!!}
							</div>
						  </div>	
						  <div class="form-group">
						    {!! Form::label('role_id',trans('messages.Role'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
							{!! Form::select('role_id', [''=>''] + $roles,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Role'])!!}
							</div>
						  </div>	
						  <div class="form-group">
						    {!! Form::label('username',trans('messages.Username'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','username','',['class'=>'form-control','placeholder'=>'Enter Username'])!!}
								<div class="help-box">It should be unique to every user.</div>
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('email',trans('messages.Email'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','email','',['class'=>'form-control','placeholder'=>'Enter Email'])!!}
								<div class="help-box">It should be unique to every user.</div>
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('mobile_phone',trans('messages.Mobile Phone'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','mobile_phone','',['class'=>'form-control','placeholder'=>'Enter Mobile Phone'])!!}
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('password',trans('messages.Password'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('password','password','',['class'=>'form-control','placeholder'=>'Enter Password'])!!}
								<div class="help-box">Minimum 4 characters.</div>
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('password_confirmation',trans('messages.Confirm Password'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('password','password_confirmation','',['class'=>'form-control','placeholder'=>'Enter Confirm Password'])!!}
							</div>
						  </div>
						  <div class="col-sm-offset-2 col-sm-10">
						  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
						  </div>
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					This module enables you to add unlimited staff in your organization. Once completed this form
					he/she will be able to login with given username & password. Email id mentioned here should be
					unique & must contain only alphabet or underscore. In case when password is lost, this email
					can be used to reset password. Username should also be unique. Password should be strong enough
					so that no one can guess it.
				</div>
			</div>
		</div>
	@stop