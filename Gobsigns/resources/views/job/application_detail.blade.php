
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">{!! trans('messages.Application Detail') !!}</h4>
	</div>
	<div class="modal-body">
		<p>{!! $application->app_description !!}</p>
		@foreach($custom_values as $key => $value)
		<p>{!! '<strong>'.$key.'</strong> : '.$value !!}</p>
		@endforeach
		{!! Form::model($application,['method' => 'PATCH','route' => ['application.updateApplicationStatus',$application->id] ,'class' => 'application-form']) !!}
		  <div class="form-group">
			{!! Form::label('status',trans('messages.Status'),[])!!}
			{!! Form::select('status', [null=>'Please Select',
				'unread' => 'Unread',
				'reject' => 'Rejected',
				'Select' => 'Selected',
				'save_for_later' => 'Saved for Later'
				],isset($application->status) ? $application->status : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Status'])!!}
		  </div>
		  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
	<script>
	$(function() {
  	 Validate.init();
    });
	</script>
