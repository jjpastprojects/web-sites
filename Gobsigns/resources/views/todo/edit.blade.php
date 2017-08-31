@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Edit') !!}</strong> {!! trans('messages.To do') !!}
					<div class="additional-btn">
					{!! delete_form(['todo.destroy',$todo->id]) !!}
					</div>
					</h2>
					
					{!! Form::model($todo,['method' => 'PATCH','route' => ['todo.update',$todo->id] ,'class' => 'todo-form']) !!}
						@include('todo._form', ['buttonText' => 'Update'])
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="clear"></div>
	@stop
