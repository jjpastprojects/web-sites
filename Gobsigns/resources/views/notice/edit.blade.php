@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Notice') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/notice/create">{!! trans('messages.Add New Notice') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/notice">{!! trans('messages.List All Notice') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($notice,['method' => 'PATCH','route' => ['notice.update',$notice->id] ,'class' => 'notice-form']) !!}
						@include('notice._form', ['buttonText' => 'Update Notice'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Help') !!}</strong></h2> If you want to update any information published in a notice, then you can simply go to list notice and then click on the edit button of that notice. You can update
					all the information provided in the form. Once updated, it will be reflected to all the desired users's dashboard.</h2>
				</div>
			</div>
		</div>

	@stop