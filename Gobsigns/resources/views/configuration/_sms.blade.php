			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('sid','SID',[])!!}
				{!! Form::input('text','sid',config('twilio.sid'),['class'=>'form-control','placeholder'=>'Enter Twilio SID'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('token','Token',[])!!}
				{!! Form::input('text','token',config('twilio.token'),['class'=>'form-control','placeholder'=>'Enter Twilio Token'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from','Sender Id',[])!!}
				{!! Form::input('text','from',config('twilio.from'),['class'=>'form-control','placeholder'=>'Enter Twilio Token'])!!}
			  </div>
			  {!! Form::hidden('config_type','sms')!!}
			{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="col-sm-6">
			</div>
			<div class="clear"></div>
