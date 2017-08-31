@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Task') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/task/create">{!! trans('messages.Add New Task') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/task">{!! trans('messages.List All Task') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($task,['method' => 'PATCH','route' => ['task.update',$task->id] ,'class' => 'task-form']) !!}
						@include('task._form', ['buttonText' => 'Update Task'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Help') !!}</strong> </h2>
					Task once stored, can be edited as per your requirement. You may edit all the fields available in this form.
					You may assign this task to another user.
				</div>
			</div>
		</div>

	@stop