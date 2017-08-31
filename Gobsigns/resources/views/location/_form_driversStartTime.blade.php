<div class="col-sm-12">
	<div class="form-group">
		{!! Form::label('drivers_start_day',trans('messages.Select Day of Week'),[])!!}
		{!! Form::select('drivers_start_day', [
					''=>'',
					'Sunday'=>'Sunday',
					'Monday'=>'Monday',
					'Tuesday'=>'Tuesday',
					'Wednesday'=>'Wednesday',
					'Thursday'=>'Thursday',
					'Friday'=>'Friday',
					'Saturday'=>'Saturday'
				],isset($location->drivers_start_day) ? $location->drivers_start_day : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Select Day of Week'])!!}
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		{!! Form::label('drivers_start_time',trans('messages.Start Time'),[])!!}
		<div class="input-group date timepicker col-md-12" data-date="" data-date-format="HH:ii P" data-link-field="drivers_start_time" data-link-format="HH:ii P">
            <input class="form-control" size="16" type="text" value="{!!isset($location->drivers_start_time) ? $location->drivers_start_time : ''!!}" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
        </div>
		<input type="hidden" name="drivers_start_time" id="drivers_start_time" value="{!!isset($location->drivers_start_time) ? $location->drivers_start_time : ''!!}" /><br/>
	</div>
</div>
<div class="col-sm-12 col-md-6">
	<div class="form-group">
		{!! Form::label('drivers_end_time',trans('messages.End Time'),[])!!}
		<div class="input-group date timepicker col-md-12" data-date="" data-date-format="HH:ii P" data-link-field="drivers_end_time" data-link-format="HH:ii P">
            <input class="form-control" size="16" type="text" value="{!!isset($location->drivers_end_time) ? $location->drivers_end_time : ''!!}" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
			<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
        </div>
		<input type="hidden" name="drivers_end_time" id="drivers_end_time" value="{!!isset($location->drivers_end_time) ? $location->drivers_end_time : ''!!}" /><br/>
	</div>
</div>