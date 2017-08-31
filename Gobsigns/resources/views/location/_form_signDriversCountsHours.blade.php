<div class="col-sm-6 no-padding">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_mon_qty',trans('messages.Monday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_mon_qty',isset($location->signdriver_mon_qty) ? $location->signdriver_mon_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_tue_qty',trans('messages.Tuesday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_tue_qty',isset($location->signdriver_tue_qty) ? $location->signdriver_tue_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_wed_qty',trans('messages.Wednesday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_wed_qty',isset($location->signdriver_wed_qty) ? $location->signdriver_wed_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_thu_qty',trans('messages.Thursday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_thu_qty',isset($location->signdriver_thu_qty) ? $location->signdriver_thu_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_fri_qty',trans('messages.Friday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_fri_qty',isset($location->signdriver_fri_qty) ? $location->signdriver_fri_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_sat_qty',trans('messages.Saturday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_sat_qty',isset($location->signdriver_sat_qty) ? $location->signdriver_sat_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_sun_qty',trans('messages.Sunday Qty').'*',[])!!}
            {!! Form::input('number','signdriver_sun_qty',isset($location->signdriver_sun_qty) ? $location->signdriver_sun_qty : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_total_walkers',trans('messages.Total Walkers').'*',[])!!}
            {!! Form::input('number','signdriver_total_walkers',isset($location->signdriver_total_walkers) ? $location->signdriver_total_walkers : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 no-padding">
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_mon_hours',trans('messages.Monday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_mon_hours',isset($location->signdriver_mon_hours) ? $location->signdriver_mon_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_tue_hours',trans('messages.Tuesday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_tue_hours',isset($location->signdriver_tue_hours) ? $location->signdriver_tue_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_wed_hours',trans('messages.Wednesday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_wed_hours',isset($location->signdriver_wed_hours) ? $location->signdriver_wed_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_thu_hours',trans('messages.Thursday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_thu_hours',isset($location->signdriver_thu_hours) ? $location->signdriver_thu_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_fri_hours',trans('messages.Friday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_fri_hours',isset($location->signdriver_fri_hours) ? $location->signdriver_fri_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_sat_hours',trans('messages.Saturday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_sat_hours',isset($location->signdriver_sat_hours) ? $location->signdriver_sat_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_sun_hours',trans('messages.Sunday').' '.trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_sun_hours',isset($location->signdriver_sun_hours) ? $location->signdriver_sun_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('signdriver_total_hours',trans('messages.Total Hours').'*',[])!!}
            {!! Form::input('number','signdriver_total_hours',isset($location->signdriver_total_hours) ? $location->signdriver_total_hours : '',['class'=>'form-control', 'placeholder'=>''])!!}
        </div>
    </div>
</div>