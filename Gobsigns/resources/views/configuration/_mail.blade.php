			<div class="col-sm-6">
			  <div class="form-group">
			    {!! Form::label('driver','Driver',[])!!}
				{!! Form::select('driver', [
					null=>'Please Select',
					'mail' => 'mail',
					'smtp' => 'smtp',
					'sendmail' => 'sendmail',
					'mailgun' => 'mailgun',
					'mandrill' => 'mandrill',
					'log' => 'log'
					],(config('mail.driver')) ? : 'mail',['id' => 'mail_driver', 'class'=>'form-control input-xlarge select2me','placeholder'=>'Select Mail Driver'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_address','From Address',[])!!}
				{!! Form::input('email','from_address',config('mail.from.address'),['class'=>'form-control','placeholder'=>'Enter From Address'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('from_name','From Name',[])!!}
				{!! Form::input('text','from_name',config('mail.from.name'),['class'=>'form-control','placeholder'=>'Enter From Name'])!!}
			  </div>
			  {!! Form::hidden('config_type','mail')!!}
			{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
			</div>
			<div class="col-sm-6">
				<div id="mail_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You may not be able to send, if you are using this application on your local server. Once uploaded to 
					live webserver, you will be able to send mail by this mail driver. It is one of the easiest mail driver to send mail with zero configuration.
					</div>
				</div>
				<div id="sendmail_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You may not be able to send, if you are using this application on your local server. Once uploaded to 
					live webserver, you will be able to send mail by this mail driver. It is one of the easiest mail driver to send mail with zero configuration.
					</div>
				</div>
				<div id="log_configuration" class="mail_config">
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You won't be able to send mail by using this driver, but all your sent mail will be logged into laravel log file.
					</div>
				</div>
				<div id="smtp_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('host','SMTP Host',[])!!}
					{!! Form::input('text','host',config('mail.host'),['class'=>'form-control','placeholder'=>'Enter SMTP Host'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('port','SMTP Port',[])!!}
					{!! Form::input('text','port',config('mail.port'),['class'=>'form-control','placeholder'=>'Enter SMTP Port'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('username','SMTP Username',[])!!}
					{!! Form::input('text','username',config('mail.username'),['class'=>'form-control','placeholder'=>'Enter SMTP Username'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('password','SMTP Password',[])!!}
					{!! Form::input('text','password',config('mail.password'),['class'=>'form-control','placeholder'=>'Enter SMTP Password'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You may send email from local server as well as live web server by using this mail driver.
					If you want to use gmail setting, then you have to configure some of the preferences in your gmail account.
					</div>
				</div>
				<div id="mandrill_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('mandrill_secret','Secret Key',[])!!}
					{!! Form::input('text','mandrill_secret',config('services.mandrill.secret'),['class'=>'form-control','placeholder'=>'Enter Mandrill Secret Key'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You may send email from local server as well as live web server by using this mail driver.
					You must have a working mandrill account for using this driver.
					</div>
				</div>
				<div id="mailgun_configuration" class="mail_config">
				  <div class="form-group">
				    {!! Form::label('mailgun_domain','Domain',[])!!}
					{!! Form::input('text','mailgun_domain',config('services.mailgun.domain'),['class'=>'form-control','placeholder'=>'Enter Mailgun Domain'])!!}
				  </div>
				  <div class="form-group">
				    {!! Form::label('mailgun_secret','Secret Key',[])!!}
					{!! Form::input('text','mailgun_secret',config('services.mailgun.secret'),['class'=>'form-control','placeholder'=>'Enter Mailgun Secret Key'])!!}
				  </div>
					<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>
					You may send email from local server as well as live web server by using this mail driver.
					You must have a working mailgun account for using this driver.
					</div>
				</div>
			</div>
			<div class="clear"></div>
