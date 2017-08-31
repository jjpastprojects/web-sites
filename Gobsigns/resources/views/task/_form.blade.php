
			  <div class="form-group">
			    {!! Form::label('task_title',trans('messages.Title'),[])!!}
				{!! Form::input('text','task_title',isset($task->task_title) ? $task->task_title : '',['class'=>'form-control','placeholder'=>'Enter Title'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('task_description',trans('messages.Description'),[])!!}
			    {!! Form::textarea('task_description',isset($task->task_description) ? $task->task_description : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('start_date',trans('messages.Start Date'),[])!!}
				{!! Form::input('text','start_date',isset($task->start_date) ? $task->start_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Start Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('due_date',trans('messages.Due Date'),[])!!}
				{!! Form::input('text','due_date',isset($task->due_date) ? $task->due_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Due Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('hours',trans('messages.No of Hours'),[])!!}
				{!! Form::input('number','hours',isset($task->hours) ? $task->hours : '',['class'=>'form-control','placeholder'=>'Enter No of Hours'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
			    {!! Form::select('user_id[]', $users, isset($selected_user) ? $selected_user : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User','multiple' => true])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('task-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
