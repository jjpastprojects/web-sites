@extends('layouts.default')

	@section('content')
		<div class="row">
			@if(Entrust::can('create_holiday'))
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Add New') !!}</strong></h2>
					{!! Form::open(['route' => 'holiday.store','role' => 'form', 'class'=>'holiday-form']) !!}
						@include('holiday._form')
					{!! Form::close() !!}
				</div>
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4> You can store record of all the holidays of your company. Multiple holidays can be added at once by the datepicker plugin. You can select multiple dates at once. Multiple dates will be separated by comma. The description box may contain the detail of the holiday.
				</div>
			</div>
			@endif
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Holidays') !!}</h2>
					@include('common.datatable',['col_heads' => $col_heads])
				</div>
			</div>

		</div>

	@stop