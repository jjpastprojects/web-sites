
			  <div class="form-group">
			    {!! Form::label('document_type_name',trans('messages.Document Type Name'),[])!!}
				{!! Form::input('text','document_type_name',isset($document_type->document_type_name) ? $document_type->document_type_name : '',['class'=>'form-control','placeholder'=>'Enter Document Type Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
			  	
