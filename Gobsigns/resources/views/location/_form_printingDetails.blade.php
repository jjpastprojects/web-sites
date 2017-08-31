<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('print_sign_type',trans('messages.Sign Type'),[])!!}
		{!! Form::select('print_sign_type', [
					''=>'',
					'Ground'=>'Ground',
					'Walker'=>'Walker',
					'Driver'=>'Driver',
					'Oregon'=>'Oregon',
					'Decal'=>'Decal',
					'Topper'=>'Topper',
					'N/A'=>'N/A',
				],isset($location->print_sign_type) ? $location->print_sign_type : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Sign Type'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('print_color',trans('messages.Color'),[])!!}
		{!! Form::select('print_color', [
					''=>'',
					'Red/Yellow/Black' => 'Red/Yellow/Black',
					'Neon Pink/Neon/Yellow/Black' => 'Neon Pink/Neon/Yellow/Black',
					'Red/Yellow/Black/Blue' => 'Red/Yellow/Black/Blue',
					'Green/Black' => 'Green/Black',
					'Maroon/Yellow/Black' => 'Maroon/Yellow/Black',
					'Pink/Yellow/Black' => 'Pink/Yellow/Black',
					'Orange/Brown' => 'Orange/Brown',
					'Yellow/Black' => 'Yellow/Black',
					'Blue/Orange/Yellow' => 'Blue/Orange/Yellow',
					'N/A'=>'N/A',
				],isset($location->print_color) ? $location->print_color : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Color'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('print_layout_approval',trans('messages.Layout Needed / Approved'),[])!!}
	</div>
	<div class="form-group">
        {!! Form::checkbox('print_layout_approval', 'Yes', null, ['class'=>'form-control input-xlarge'])!!}
        {!! Form::label('print_layout_approval',trans('messages.Approved'),['class' => 'sub_label'])!!}
    </div>
</div>
<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('printer',trans('messages.Printer'),[])!!}
		{!! Form::select('printer', [
					''=>'',
					'PRE'=>'PRE',
					'GM'=>'GM',
					'N/A'=>'N/A',
				],isset($location->printer) ? $location->printer : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Printer'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('print_quantity',trans('messages.Quantity'),[])!!}
		<input id="print_quantity"  name="print_quantity" type="text" data-provide="slider" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="{!! isset($location->print_quantity) ? $location->print_quantity : 0 !!}"/>
		<span id="print_quantity_val" class="slider-val">{!! isset($location->print_quantity) ? $location->print_quantity : 0 !!}</span>
	</div>
</div>
<div class="col-sm-12">
    {!! Form::label('print_rate_per',trans('messages.Rate Per'),[])!!}
    <div class="form-group currency-group">
    	<span class='input-group-addon'>$</span>
        {!! Form::input('number','print_rate_per',isset($location->print_rate_per) ? $location->print_rate_per : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Hourly Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('print_total',trans('messages.Total'),[])!!}
    <div class="form-group currency-group">
    	<span class='input-group-addon'>$</span>
        {!! Form::input('number','print_total',isset($location->print_total) ? $location->print_total : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Total Amount'])!!}
    </div>
</div>