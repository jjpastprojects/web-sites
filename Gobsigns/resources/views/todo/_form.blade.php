
			  <div class="form-group">
			    {!! Form::label('date',trans('messages.Date'),[])!!}
				{!! Form::input('text','date',isset($todo->date) ? $todo->date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('todo_title',trans('messages.Title'),[])!!}
				{!! Form::input('text','todo_title',isset($todo->todo_title) ? $todo->todo_title : '',['class'=>'form-control','placeholder'=>'Enter Title'])!!}
			  </div>
				<div class="form-group">
				    {!! Form::label('todo_description',trans('messages.Description'),[])!!}
				    {!! Form::textarea('todo_description',isset($todo->todo_description) ? $todo->todo_description : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Description'])!!}
				</div>
				<div class="form-group">
				  {!! Form::label('visibility',trans('messages.Visibility'),['class' => 'col-sm-2'])!!}
					<div class="col-sm-10">
						<label class="checkbox-inline">
							<input type="radio" name="visibility" id="visibility" value="private" checked> Private
						</label>
						<label class="checkbox-inline">
							<input type="radio" name="visibility" id="visibility" value="public"> Public
						</label>
					</div>
					<div class="clear"></div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary pull-right']) !!}
			  	<br />
			  	
