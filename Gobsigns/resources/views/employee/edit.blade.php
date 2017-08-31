@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!} </strong> {!! trans('messages.Employee') !!}</h2>
					
					{!! Form::model($employee,['method' => 'PATCH','route' => ['employee.update',$employee->id] ,'class' => 'employee-form form-horizontal']) !!}
						  <div class="form-group">
						    {!! Form::label('first_name',trans('messages.First Name'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','first_name',isset($employee->first_name) ? $employee->first_name : '',['class'=>'form-control','placeholder'=>'Enter First Name'])!!}
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('last_name',trans('messages.Last Name'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','last_name',isset($employee->last_name) ? $employee->last_name : '',['class'=>'form-control','placeholder'=>'Enter Last Name'])!!}
							</div>
						  </div>	
						  <div class="form-group">
						    {!! Form::label('location_id',trans('messages.Location'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
							{!! Form::select('location_id', [null=>'Please Select'] + $locations,isset($employee->location_id) ? $employee->location_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Location'])!!}
							</div>
						  </div>
						  @if(Entrust::can('manage_all_employee'))
						  <div class="form-group">
						    {!! Form::label('role_id',trans('messages.Role'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
							{!! Form::select('role_id', [''=>''] + $roles, isset($role_id) ? $role_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Role'])!!}
							</div>
						  </div>
						  @endif
						  <div class="form-group">
						    {!! Form::label('email',trans('messages.Email'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','email',isset($employee->email) ? $employee->email : '',['class'=>'form-control','placeholder'=>'Enter Email'])!!}
							</div>
						  </div>
						  <div class="form-group">
						    {!! Form::label('email',trans('messages.Mobile Phone'),['class' => 'col-sm-2 control-label'])!!}
						    <div class="col-sm-10">
								{!! Form::input('text','mobile_phone',isset($employee->mobile_phone) ? $employee->mobile_phone : '',['class'=>'form-control','placeholder'=>'Enter Mobile Phone'])!!}
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