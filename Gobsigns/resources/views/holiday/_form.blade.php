
			  <div class="form-group">
			    {!! Form::label('date',trans('messages.Dates'),[])!!}
				@if(!isset($holiday->id))
				{!! Form::input('text','date',isset($holiday->date) ? $holiday->date : '',['class'=>'form-control mdatepicker-input','placeholder'=>'Enter Dates','readonly' => 'true'])!!}
			  	@else
			  	{!! Form::input('text','date',isset($holiday->date) ? $holiday->date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Dates','readonly' => 'true'])!!}
			  	@endif
			  </div>
			  <div class="form-group">
			    {!! Form::label('holiday_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('holiday_description',isset($holiday->holiday_description) ? $holiday->holiday_description : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('holiday-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
