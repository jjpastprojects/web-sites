@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.Expense') !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/expense/create">{!! trans('messages.Add New Expense') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/expense">{!! trans('messages.List All Expense') !!}</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::model($expense,['method' => 'PATCH','route' => ['expense.update',$expense->id] ,'class' => 'expense-form']) !!}
						@include('expense._form', ['buttonText' => 'Update Expense'])
					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Help') !!}</strong></h2>
					Expenses once logged, can be edited as per requirement. You may change expense head, amount, date of expenses and other fields.
					Custom fields can also be edited once the expenses are saved.
				</div>
			</div>
		</div>

	@stop