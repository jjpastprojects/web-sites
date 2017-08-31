
			  <div class="form-group">
			    {!! Form::label('ticket_subject',trans('messages.Subject'),[])!!}
				{!! Form::input('text','ticket_subject',isset($ticket->ticket_subject) ? $ticket->ticket_subject : '',['class'=>'form-control','placeholder'=>'Enter Ticket Subject'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('ticket_priority',trans('messages.Priority'),['class' => 'control-label'])!!}
			    {!! Form::select('ticket_priority', [
			    	null=>'Select One',
			    	'low' => 'Low',
			    	'medium' => 'Medium',
			    	'high' => 'High',
			    	'critical' => 'Critical'
			    	]
			    	, isset($ticket->ticket_priority) ? $ticket->ticket_priority : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Priority'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('ticket_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('ticket_description',isset($ticket->ticket_description) ? $ticket->ticket_description : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('ticket-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Create'),['class' => 'btn btn-primary']) !!}
