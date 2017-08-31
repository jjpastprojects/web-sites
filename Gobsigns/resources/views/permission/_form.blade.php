
			  <div class="form-group">
			    {!! Form::label('name','Permission Name',[])!!}
				{!! Form::input('text','name',isset($permission->name) ? $permission->name : '',['class'=>'form-control','placeholder'=>'Enter Permission Name'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('display_name','Display Name',[])!!}
				{!! Form::input('text','display_name',isset($permission->display_name) ? $permission->display_name : '',['class'=>'form-control','placeholder'=>'Enter Permission Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Add Permission',['class' => 'btn btn-primary']) !!}
