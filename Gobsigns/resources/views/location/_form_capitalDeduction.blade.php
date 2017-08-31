<div class="col-sm-12">
    {!! Form::label('capital_deduction_amount',trans('messages.Amount'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','capital_deduction_amount',isset($location->capital_deduction_amount) ? $location->capital_deduction_amount : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Amount'])!!}
    </div>
</div>