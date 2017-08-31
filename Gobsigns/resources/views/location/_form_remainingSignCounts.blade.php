<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('remaining_ground_signs',trans('messages.Ground Signs'),[])!!}
        {!! Form::input('number','remaining_ground_signs',isset($location->remaining_ground_signs) ? $location->remaining_ground_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Ground Signs'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('remaining_car_signs',trans('messages.Car Signs'),[])!!}
        {!! Form::input('number','remaining_car_signs',isset($location->remaining_car_signs) ? $location->remaining_car_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Car Signs'])!!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('remaining_walker_signs',trans('messages.Walker Signs'),[])!!}
        {!! Form::input('number','remaining_walker_signs',isset($location->remaining_walker_signs) ? $location->remaining_walker_signs : '',['class'=>'form-control', 'placeholder'=>'Enter Walker Signs'])!!}
    </div>
</div>