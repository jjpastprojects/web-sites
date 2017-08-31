@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Language') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/language">{!! trans('messages.List All Language') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($language,['method' => 'PATCH','route' => ['language.update',$locale] ,'class' => 'language-form']) !!}
						@include('language._form', ['buttonText' => 'Update'] )
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop