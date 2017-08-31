<div class="col-sm-12">
    {!! Form::label('signwalker_hourly_rate',trans('messages.Hourly Rate'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','signwalker_hourly_rate',isset($location->signwalker_hourly_rate) ? $location->signwalker_hourly_rate : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Hourly Rate'])!!}
    </div>
</div>
<div class="col-sm-12">
    {!! Form::label('signwalker_total_amount',trans('messages.Total Amount'),[])!!}
    <div class="form-group currency-group">
        <span class='input-group-addon'>$</span>
        {!! Form::input('number','signwalker_total_amount',isset($location->signwalker_total_amount) ? $location->signwalker_total_amount : '',['class'=>'form-control currency-input', 'placeholder'=>'Enter Total Amount'])!!}
    </div>
</div>