@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Leave') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/leave/create">{!! trans('messages.Request New Leave') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/leave">{!! trans('messages.List All Leave') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($leave,['method' => 'PATCH','route' => ['leave.update',$leave->id] ,'class' => 'leave-form']) !!}
						@include('leave._form', ['buttonText' => 'Update Leave'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Leave can also be edited by the user if it is neither approved nor rejected. Once the leave is approved or rejected it cannot be further modified.</div>
			</div>
		</div>

	@stop