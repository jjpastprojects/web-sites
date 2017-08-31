
			  <div class="form-group">
			    {!! Form::label('client_name',trans('messages.Client Name'),[])!!}
				{!! Form::input('text','client_name',isset($client->client_name) ? $client->client_name : '',['class'=>'form-control','placeholder'=>'Enter Client Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('client_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('client_description',isset($client->client_description) ? $client->client_description : '',['size' => '30x3', 'class' => 'form-control summernote-small', 'placeholder' => 'Enter Description'])!!}
			  </div>
			    {{ App\Classes\Helper::getCustomFields('client-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
