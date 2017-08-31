			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('application_title',trans('messages.Application Title'),[])!!}
				{!! Form::input('text','application_title',config('config.application_title'),['class'=>'form-control','placeholder'=>'Enter Application Title'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('application_name',trans('messages.Application Name'),[])!!}
				{!! Form::input('text','application_name',config('config.application_name'),['class'=>'form-control','placeholder'=>'Enter Application Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('credit',trans('messages.Credit'),[])!!}
			    {!! Form::textarea('credit',config('config.credit'),['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Footer Credit'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('company_name',trans('messages.Company Name'),[])!!}
				{!! Form::input('text','company_name',config('config.company_name'),['class'=>'form-control','placeholder'=>'Enter Company Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('contact_person',trans('messages.Contact Person'),[])!!}
				{!! Form::input('text','contact_person',config('config.contact_person'),['class'=>'form-control','placeholder'=>'Enter Contact Person'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('email',trans('messages.Email'),[])!!}
				{!! Form::input('email','email',config('config.email'),['class'=>'form-control','placeholder'=>'Enter Email'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('phone',trans('messages.Phone'),[])!!}
				{!! Form::input('number','phone',config('config.phone'),['class'=>'form-control','placeholder'=>'Enter Phone'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('city',trans('messages.City'),[])!!}
				{!! Form::input('text','city',config('config.city'),['class'=>'form-control','placeholder'=>'Enter City Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('state',trans('messages.State'),[])!!}
				{!! Form::input('text','state',config('config.state'),['class'=>'form-control','placeholder'=>'Enter State Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('zipcode',trans('messages.Zipcode'),[])!!}
				{!! Form::input('text','zipcode',config('config.zipcode'),['class'=>'form-control','placeholder'=>'Enter Zipcode'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('country_id',trans('messages.Country'),[])!!}
				{!! Form::select('country_id', [null=>'Please Select'] + $countries,config('config.country_id'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Company'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('address',trans('messages.Address'),[])!!}
			    {!! Form::textarea('address',config('config.address'),['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Address'])!!}
			  </div>
			</div>
			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('timezone_id',trans('messages.Timezone'),[])!!}
				{!! Form::select('timezone_id', [null=>'Please Select'] + $timezones,config('config.timezone_id'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Timezone'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_currency',trans('messages.Default Currency'),[])!!}
				{!! Form::input('text','default_currency',config('config.default_currency'),['class'=>'form-control','placeholder'=>'Enter Default Currency'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_currency_symbol',trans('messages.Default Currency Symbol'),[])!!}
				{!! Form::input('text','default_currency_symbol',config('config.default_currency_symbol'),['class'=>'form-control','placeholder'=>'Enter Default Currency Symbol'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('default_language',trans('messages.Default Language'),[])!!}
				{!! Form::select('default_language', [null=>'Please Select'] + $languages,(config('config.default_language')) ?  : 'en',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Language'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('direction',trans('messages.Direction'),[])!!}
				{!! Form::select('direction', ['ltr'=>'Left to Right',
					'rtl' => 'Right to Left'],config('config.direction'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Timezone'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('allowed_upload_file',trans('messages.Default Upload File Type'),[])!!}
				{!! Form::input('text','allowed_upload_file',config('config.allowed_upload_file'),['class'=>'form-control','placeholder'=>'Enter Default Upload File Type'])!!}
			  	<p class="help-box">{!! trans('messages.File extension separated by comma') !!}</p>
			  </div>
			  <div class="form-group">
			    {!! Form::label('allowed_upload_max_size',trans('messages.Default Upload Fize Size'),[])!!}
				{!! Form::input('text','allowed_upload_max_size',config('config.allowed_upload_max_size'),['class'=>'form-control','placeholder'=>'Enter Default Upload Fize Size'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('error_display','Error Display',['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('error_display', '1', (config('config.error_display')) ? 'checked' : '') !!} Yes
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('error_display', '0', (!config('config.error_display')) ? 'checked' : '') !!} No
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('time_format','Time format',['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('time_format', '24hrs', (config('config.time_format') == '24hrs') ? 'checked' : '') !!} 24 Hours
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('time_format', '12hrs', (config('config.time_format') == '12hrs') ? 'checked' : '') !!} 12 Hours
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('date_format','Date format',['class' => 'col-sm-4 control-label'])!!}
				<div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'dd mm YYYY', (config('config.date_format') == 'dd mm YYYY') ? 'checked' : '') !!} dd mm YYYY ({!! date('d m Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'mm dd YYYY', (config('config.date_format') == 'mm dd YYYY') ? 'checked' : '') !!} mm dd YYYY ({!! date('m d Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'dd MM YYYY', (config('config.date_format') == 'dd MM YYYY') ? 'checked' : '') !!} dd MM YYYY ({!! date('d M Y') !!})
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('date_format', 'MM dd YYYY', (config('config.date_format') == 'MM dd YYYY') ? 'checked' : '') !!} MM dd YYYY ({!! date('M d Y') !!})
						</label>
					</div>
				</div>
			  </div>
			  <div class="form-group">
				{!! Form::label('installation_path','Insallation Path',['class' => 'col-sm-4 control-label'])!!}
				  <div class="col-sm-8">
					<div class="radio">
						<label>
							{!! Form::radio('installation_path', '1', (config('config.installation_path')) ? 'checked' : '') !!} Yes
						</label>
					</div>
					<div class="radio">
						<label>
							{!! Form::radio('installation_path', '0', (!config('config.installation_path')) ? 'checked' : '') !!} No
						</label>
					</div>
				</div>
			  </div>
			  	{!! Form::hidden('config_type','general')!!}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="clear"></div>