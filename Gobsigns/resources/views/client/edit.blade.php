@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Client') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/client/create">{!! trans('messages.Add New Client') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/client">{!! trans('messages.List All Client') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($client,['method' => 'PATCH','route' => ['client.update',$client] ,'class' => 'client-form']) !!}
						@include('client._form', ['buttonText' => 'Update Client'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the client name & its description. Keep in mind that client name cannot be same as another client name.
				Change in client name will be reflected everywhere.</div>
			</div>
		</div>

	@stop