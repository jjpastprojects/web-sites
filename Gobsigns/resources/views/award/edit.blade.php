@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Award') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/award/create">{!! trans('messages.Add New Award') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/award">{!! trans('messages.List All Award') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($award,['method' => 'PATCH','route' => ['award.update',$award->id] ,'class' => 'award-form']) !!}
						@include('award._form', ['buttonText' => 'Update'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('Help') !!}</h4> Editing an award is easy as editing any other entity. You can update any of the given fields and it will be saved in database for further use.</div>
			</div>
		</div>

	@stop