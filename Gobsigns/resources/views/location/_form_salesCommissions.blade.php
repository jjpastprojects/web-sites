<div class="col-sm-12">
    <div class="form-group">
        {!! Form::label('sales_name',trans('messages.Name'),[])!!}
        {!! Form::input('text','sales_name',isset($location->sales_name) ? $location->sales_name : '',['class'=>'form-control', 'placeholder'=>'Enter Name'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('sales_amount',trans('messages.Amount'),[])!!}
    <div class="form-group currency-group">
    	<span class='input-group-addon'>$</span>
        {!! Form::input('number','sales_amount',isset($location->sales_amount) ? $location->sales_amount : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Amount'])!!}
    </div>
</div>