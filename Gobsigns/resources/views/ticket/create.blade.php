@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Ticket') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/ticket">{!! trans('messages.List All Ticket') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'ticket.store','role' => 'form', 'class'=>'ticket-form']) !!}
						@include('ticket._form')
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>This module manages and maintains lists of issues, as needed by an organization. An employee or a manager can generate a ticket & it will be review further by higher authority.
				On resolving that issue, a ticket status can be closed by the reviewer. Tickets are solved on the basic of its priority.</div>
			</div>
		</div>

	@stop