<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('holiday_date_none',trans('messages.Holiday Date / None'),[])!!}
        {!! Form::input('text','holiday_date_none',isset($location->holiday_date_none) ? $location->holiday_date_none : '',['class'=>'form-control', 'placeholder'=>'None'])!!}
    </div>
</div>