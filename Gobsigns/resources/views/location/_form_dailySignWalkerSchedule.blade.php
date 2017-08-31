<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_monday',trans('messages.Monday'),[])!!}
        {!! Form::input('number','daily_walker_monday',isset($location->daily_walker_monday) ? $location->daily_walker_monday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_tuesday',trans('messages.Tuesday'),[])!!}
        {!! Form::input('number','daily_walker_tuesday',isset($location->daily_walker_tuesday) ? $location->daily_walker_tuesday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_wednesday',trans('messages.Wednesday'),[])!!}
        {!! Form::input('number','daily_walker_wednesday',isset($location->daily_walker_wednesday) ? $location->daily_walker_wednesday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_thursday',trans('messages.Thursday'),[])!!}
        {!! Form::input('number','daily_walker_thursday',isset($location->daily_walker_thursday) ? $location->daily_walker_thursday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_friday',trans('messages.Friday'),[])!!}
        {!! Form::input('number','daily_walker_friday',isset($location->daily_walker_friday) ? $location->daily_walker_friday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_saturday',trans('messages.Saturday'),[])!!}
        {!! Form::input('number','daily_walker_saturday',isset($location->daily_walker_saturday) ? $location->daily_walker_saturday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>
<div class="col-sm-4 col-md-3">
    <div class="form-group">
        {!! Form::label('daily_walker_sunday',trans('messages.Sunday'),[])!!}
        {!! Form::input('number','daily_walker_sunday',isset($location->daily_walker_sunday) ? $location->daily_walker_sunday : '',['class'=>'form-control', 'placeholder'=>''])!!}
    </div>
</div>