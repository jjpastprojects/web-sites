
			  <div class="form-group">
			    {!! Form::label('salary_type',trans('messages.Type'),[])!!}
				{!! Form::select('salary_type', [null=>'Please Select','earning' => 'Earning','deduction' => 'Deduction'],isset($salary_type->salary_type) ? $salary_type->salary_type : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Type'])!!}
			  </div>
			  <div class="form-group">
			    {!! Form::label('salary_head',trans('messages.Salary Head'),[])!!}
				{!! Form::input('text','salary_head',isset($salary_type->salary_head) ? $salary_type->salary_head : '',['class'=>'form-control','placeholder'=>'Enter Salary Head'])!!}
			  </div>
			  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary']) !!}
