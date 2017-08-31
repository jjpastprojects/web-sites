
			  <div class="form-group">
			    {!! Form::label('expense_head',trans('messages.Expense Head'),[])!!}
				{!! Form::input('text','expense_head',isset($expense_head->expense_head) ? $expense_head->expense_head : '',['class'=>'form-control','placeholder'=>'Enter Expense Head'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
