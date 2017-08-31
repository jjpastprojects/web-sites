
			  <div class="form-group">
			    {!! Form::label('award_name',trans('messages.Award Name'),[])!!}
				{!! Form::input('text','award_name',isset($award_type->award_name) ? $award_type->award_name : '',['class'=>'form-control','placeholder'=>'Enter Award Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
