@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Ticket') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/ticket/create">{!! trans('messages.Create New Ticket') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/ticket">{!! trans('messages.List All Tickets') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($ticket,['method' => 'PATCH','route' => ['ticket.update',$ticket->id] ,'class' => 'ticket-form']) !!}
						@include('ticket._form', ['buttonText' => 'Update'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Here you can edit the ticket's subject & its description. Keep in mind that ticket name cannot be same as another ticket name for same user.
				Change in ticket's subject will be reflected everywhere.</div>
			</div>
		</div>

	@stop