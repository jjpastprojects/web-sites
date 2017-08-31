@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Holiday') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/holiday">{!! trans('messages.List All Holidays') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($holiday,['method' => 'PATCH','route' => ['holiday.update',$holiday->id] ,'class' => 'holiday-form']) !!}
						@include('holiday._form', ['buttonText' => 'Update'] )
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the client name & its description. Keep in mind that client name cannot be same as another client name.</div>
			</div>
		</div>

	@stop