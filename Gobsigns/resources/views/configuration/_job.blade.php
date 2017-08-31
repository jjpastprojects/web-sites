			<div class="col-sm-12">
			  <div class="form-group">
			    {!! Form::label('job_application_staff',trans('messages.Enable Job Application for Staff'),['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('job_application_staff', 'yes', (config('config.job_application_staff') == 'yes') ? 'checked' : '') !!} Yes
						</label>
						<label>
							{!! Form::radio('job_application_staff', 'no', (config('config.job_application_staff') == 'no') ? 'checked' : '') !!} No
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('application_format',trans('messages.Application Format'),['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					{!! Form::input('text','application_format',config('config.application_format'),['class'=>'form-control','placeholder'=>'Enter Allowed Application File Format'])!!}
					<p class="help-box">{!! trans('messages.File extension separated by comma') !!}</p>
				</div>
			  </div>
			  {!! Form::hidden('config_type','job')!!}
			{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="clear"></div>
