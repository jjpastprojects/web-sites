<div class="col-sm-12">
    {!! Form::label('consultantfees_install_rate',trans('messages.Install Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_install_rate',isset($location->consultantfees_install_rate) ? $location->consultantfees_install_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Install Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_walker_rate',trans('messages.Walker Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_walker_rate',isset($location->consultantfees_walker_rate) ? $location->consultantfees_walker_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Walker Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_driver_rate',trans('messages.Driver Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_driver_rate',isset($location->consultantfees_driver_rate) ? $location->consultantfees_driver_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Driver Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_other',trans('messages.Other'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_other',isset($location->consultantfees_other) ? $location->consultantfees_other : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Other'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_prepaid',trans('messages.Prepaid'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_prepaid',isset($location->consultantfees_prepaid) ? $location->consultantfees_prepaid : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Prepaid'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_deduction',trans('messages.Deduction'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_deduction',isset($location->consultantfees_deduction) ? $location->consultantfees_deduction : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Deduction'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('consultantfees_balance_due',trans('messages.Balance Due'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','consultantfees_balance_due',isset($location->consultantfees_balance_due) ? $location->consultantfees_balance_due : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Balance Due'])!!}
    </div>
</div>