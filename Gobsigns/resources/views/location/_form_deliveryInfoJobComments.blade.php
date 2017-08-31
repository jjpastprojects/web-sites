<div class="col-sm-12 col-md-7">
	<div class="form-group">
		{!! Form::label('delivery_order_date',trans('messages.Order Date').' *',[])!!}
		{!! Form::input('text','delivery_order_date',isset($location->delivery_order_date) ? $location->delivery_order_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Order Date','readonly' => 'true'])!!}
	</div>
</div>
<div class="col-sm-12 col-md-7">
	<div class="form-group">
		{!! Form::label('delivery_date',trans('messages.Delivery Date'),[])!!}
		{!! Form::input('text','delivery_date',isset($location->delivery_date) ? $location->delivery_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Delivery Date','readonly' => 'true'])!!}
	</div>
</div>