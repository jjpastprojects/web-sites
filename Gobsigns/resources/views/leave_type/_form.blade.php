
			  <div class="form-group">
			    {!! Form::label('leave_name',trans('messages.leave Name'),[])!!}
				{!! Form::input('text','leave_name',isset($leave_type->leave_name) ? $leave_type->leave_name : '',['class'=>'form-control','placeholder'=>'Enter leave Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
			  	
