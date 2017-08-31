@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Custom Fields') !!}
					</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
				<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Custom Fields') !!}
					</h2>
					{!! Form::open(['route' => 'custom_field.store','role' => 'form', 'class'=>'location-form']) !!}
					
					  <div class="form-group">
					    {!! Form::label('form',trans('messages.Form'),[])!!}
						{!! Form::select('form', [
							''=>'',
							'employee-form' => 'Employee Form',
							'client-form' => 'Client Form',
							'location-form' => 'Location Form',
							'leave-form' => 'Leave Form',
							'holiday-form' => 'Holiday Form',
							'ticket-form' => 'Ticket Form',
							'task-form' => 'Task Form',
							'job-application-form' => 'Job Application Form',
							'notice-form' => 'Notice Form',
							'award-form' => 'Award Form',
							'expense-form' => 'Expense Form',
							'job-form' => 'Job Form',
							],'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Field Type'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_type',trans('messages.Field Type'),[])!!}
						{!! Form::select('field_type', [
							''=>'',
							'text' => 'Text Box',
							'number' => 'Number',
							'email' => 'Email',
							'url' => 'URL',
							'select' => 'Select Box',
							'radio' => 'Radio Button',
							'checkbox' => 'Check Box',
							'textarea' => 'Textarea'
							],'',['id' => 'field_type', 'class'=>'form-control input-xlarge select2me','placeholder'=>'Select Field Type'])!!}
					  </div>
					  <div class="showhide-textarea">
						<div class="form-group">
						    {!! Form::label('field_value',trans('messages.Options'),[])!!}
						    {!! Form::textarea('field_value','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Options'])!!}
							<div class="help-block">Enter values separated by comma(,).</div>
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('field_title',trans('messages.Field Title'),[])!!}
						{!! Form::input('text','field_title','',['class'=>'form-control','placeholder'=>'Enter Field Title'])!!}
					  </div>
					  <div class="form-group">
					   <div class="checkbox">
							<label>
							  <input type="checkbox" name="field_required" value="1"> Required
							</label>
						</div>
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary pull-right']) !!}
	
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@stop