<div class="col-sm-12">
    {!! Form::label('services_sign_rate',trans('messages.Sign Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_sign_rate',isset($location->services_sign_rate) ? $location->services_sign_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Sign Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_walker_rate',trans('messages.Walker Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_walker_rate',isset($location->services_walker_rate) ? $location->services_walker_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Walker Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_driver_rate',trans('messages.Driver Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_driver_rate',isset($location->services_driver_rate) ? $location->services_driver_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Driver Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_other',trans('messages.Other'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_other',isset($location->services_other) ? $location->services_other : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Other'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_prepaid',trans('messages.Prepaid'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_prepaid',isset($location->services_prepaid) ? $location->services_prepaid : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Prepaid'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_deduction',trans('messages.Deduction'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_deduction',isset($location->services_deduction) ? $location->services_deduction : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Deduction'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('services_balance_due',trans('messages.Balance Due'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','services_balance_due',isset($location->services_balance_due) ? $location->services_balance_due : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Balance Due'])!!}
    </div>
</div>