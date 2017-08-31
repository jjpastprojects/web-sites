@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Send SMS to') !!} </strong> {!! ucfirst($type_detail) !!}
					<div class="additional-btn">
						  <a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						  </a>
						  <ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/sms/location">SMS to Location</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/sms/staff">SMS to Individual Staff</a></li>
						  </ul>
					</div>
					</h2>
					
					{!! Form::open(['route' => 'sms.store','role' => 'form', 'class'=>'sms-form']) !!}
						
					  <div class="form-group">
					    {!! Form::label('receivers',ucfirst($type_detail),[])!!}
						{!! Form::select('receivers', $receivers,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select','multiple' => 'true'])!!}
					  </div>
					  <div class="form-group">
					    {!! Form::label('sms','Content',[])!!}
					    {!! Form::textarea('sms','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter SMS','onkeyup'=>'countChar(this)','maxlength' => 160])!!}
					  	<div class="help-box" id="charNum"></div>
					  </div>
					  	{!! Form::hidden('type',$type) !!}
					  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Send SMS',['class' => 'btn btn-primary']) !!}

					{!! Form::close() !!}
				</div>
			</div>
			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>To use this module, you need to have a working XML SMS API. You can integrate any SMS API as you want. This module only provide SMS interface. You can ask the developer to integrate the API.</div>
			</div>
		</div>
		<script>
	      function countChar(val) {
	        var len = val.value.length;
	          $('#charNum').text(160 - len + ' characters left');
	      };
	    </script>
	@stop