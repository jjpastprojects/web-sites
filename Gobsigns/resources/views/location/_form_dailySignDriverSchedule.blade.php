<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_monday',trans('messages.Monday'),[])!!}
        {!! Form::input('number','daily_driver_monday',isset($location->daily_driver_monday) ? $location->daily_driver_monday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_tuesday',trans('messages.Tuesday'),[])!!}
        {!! Form::input('number','daily_driver_tuesday',isset($location->daily_driver_tuesday) ? $location->daily_driver_tuesday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_wednesday',trans('messages.Wednesday'),[])!!}
        {!! Form::input('number','daily_driver_wednesday',isset($location->daily_driver_wednesday) ? $location->daily_driver_wednesday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_thursday',trans('messages.Thursday'),[])!!}
        {!! Form::input('number','daily_driver_thursday',isset($location->daily_driver_thursday) ? $location->daily_driver_thursday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_friday',trans('messages.Friday'),[])!!}
        {!! Form::input('number','daily_driver_friday',isset($location->daily_driver_friday) ? $location->daily_driver_friday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_saturday',trans('messages.Saturday'),[])!!}
        {!! Form::input('number','daily_driver_saturday',isset($location->daily_driver_saturday) ? $location->daily_driver_saturday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_driver_sunday',trans('messages.Sunday'),[])!!}
        {!! Form::input('number','daily_driver_sunday',isset($location->daily_driver_sunday) ? $location->daily_driver_sunday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>