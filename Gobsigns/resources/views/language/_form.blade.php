
			  <div class="form-group">
			    {!! Form::label('locale','Locale',[])!!}
			  	@if(!isset($buttonText))
					{!! Form::input('text','locale',isset($locale) ? $locale : '',['class'=>'form-control','placeholder'=>'Enter Locale'])!!}
				@else
					{!! Form::input('text','locale',isset($locale) ? $locale : '',['class'=>'form-control','placeholder'=>'Enter Locale','readonly' => 'true'])!!}
				@endif	
				<div class="help-box">It cannot be changed once created!! </div>
			  </div>
			  <div class="form-group">
			    {!! Form::label('name','Language Name',[])!!}
				{!! Form::input('text','name',isset($language) ? $language : '',['class'=>'form-control','placeholder'=>'Enter Language Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Save',['class' => 'btn btn-primary']) !!}
