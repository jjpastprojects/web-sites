
			@if(!isset($role))
			  <div class="form-group">
			    {!! Form::label('name','Role Name',[])!!}
				{!! Form::input('text','name',isset($role->name) ? $role->name : '',['class'=>'form-control','placeholder'=>'Enter Role Name'])!!}
			  </div>
			@endif
			  <div class="form-group">
			    {!! Form::label('display_name','Display Name',[])!!}
				{!! Form::input('text','display_name',isset($role->display_name) ? $role->display_name : '',['class'=>'form-control','placeholder'=>'Enter Role Name'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : 'Add Role',['class' => 'btn btn-primary']) !!}
