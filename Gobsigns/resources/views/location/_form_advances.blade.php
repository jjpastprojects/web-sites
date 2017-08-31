<div class="col-sm-12">
    {!! Form::label('advances_walker_advance',trans('messages.Walker Advance'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_walker_advance',isset($location->advances_walker_advance) ? $location->advances_walker_advance : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Walker Advance'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('advances_driver_advance',trans('messages.Driver Advance'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_driver_advance',isset($location->advances_driver_advance) ? $location->advances_driver_advance : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Driver Advance'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('advances_other',trans('messages.Other'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_other',isset($location->advances_other) ? $location->advances_other : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Other'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('advances_prepaid',trans('messages.Prepaid'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_prepaid',isset($location->advances_prepaid) ? $location->advances_prepaid : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Prepaid'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('advances_deduction',trans('messages.Deduction'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_deduction',isset($location->advances_deduction) ? $location->advances_deduction : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Deduction'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('advances_balance_due',trans('messages.Balance Due'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','advances_balance_due',isset($location->advances_balance_due) ? $location->advances_balance_due : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Balance Due'])!!}
    </div>
</div>