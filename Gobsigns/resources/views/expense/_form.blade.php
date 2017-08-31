
			  <div class="form-group">
			    {!! Form::label('expense_head_id',trans('messages.Expense Head'),['class' => 'control-label'])!!}
			    {!! Form::select('expense_head_id', [''=>''] + ($expense_heads), isset($expense->expense_head_id) ? $expense->expense_head_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Expense Head'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('expense_date',trans('messages.Expense Date'),[])!!}
				{!! Form::input('text','expense_date',isset($expense->expense_date) ? $expense->expense_date : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Expense Date','readonly' => 'true'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('amount',trans('messages.Expense Amount'),[])!!}
				{!! Form::input('number','amount',isset($expense->amount) ? $expense->amount : '',['class'=>'form-control','placeholder'=>'Enter Expense Amount'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('remarks',trans('messages.Remarks'),[])!!}
			    {!! Form::textarea('remarks',isset($expense->remarks) ? $expense->remarks : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Remarks'])!!}
			  </div>
			  	{{ App\Classes\Helper::getCustomFields('expense-form',$custom_field_values) }}
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
