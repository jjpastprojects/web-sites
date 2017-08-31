@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-3">
				<!-- Begin user profile -->
				<div class="box-info text-center user-profile-2">
					<h4>{!! trans('messages.Hello') !!}, {!! $employee->first_name !!} {!! $employee->last_name !!}</h4>
					{!! App\Classes\Helper::getAvatar($employee->id) !!}
					
					<h5>{!! $employee->name !!}</h5>
					<h5>{!! $employee->Location->location." in ".$employee->Location->Client->client_name!!} {!! trans('messages.Client') !!}</h5>
					{!! ($employee->Profile->date_of_leaving == null) ? '<span class="label label-success">'.trans('messages.active').'</span>' : '<span class="label label-danger">'.trans('messages.in-active').'</span>' !!}
					
				</div><!-- End div .box-info -->
				<div class="box-info">
					<h4>Send SMS</h4>
					{!! Form::model($employee,['files' => true, 'method' => 'PATCH','action' => ['SMSController@sendEmployeeSMS',$employee->id] ,'class' => 'sms-form', 'role' => 'form']) !!}
    				  	<div class="form-group">
							{!! Form::textarea('sms','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter SMS','onkeyup'=>'countChar(this)','maxlength' => 160])!!}
			  				<div class="help-box" id="charNum"></div>
						</div>
						{!! Form::submit(isset($buttonText) ? $buttonText : 'Send SMS',['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
					<script>
				      function countChar(val) {
				        var len = val.value.length;
				          $('#charNum').text(160 - len + ' characters left');
				      };
				    </script>
				</div>
				@if(Entrust::can('reset_employee_password') && $employee->id != Auth::user()->id)
				<div class="box-info">
					<h4>Reset Password</h4>
					{!! Form::model($employee,['method' => 'PATCH','route' => ['change_employee_password',$employee->id] ,'class' => 'change_password-form']) !!}
					  <div class="form-group">
						{!! Form::input('password','new_password','',['class'=>'form-control','placeholder'=>'Enter New Password'])!!}
					  </div>
					  <div class="form-group">
						{!! Form::input('password','new_password_confirmation','',['class'=>'form-control','placeholder'=>'Enter New Confirm Password'])!!}
					  </div>
					  	{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
				@endif
				<!-- Begin user profile -->
			</div><!-- End div .col-sm-4 -->
			
			<div class="col-sm-9">
				<div class="box-info full">
					<!-- Nav tab -->
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-user"></i> {!! trans('messages.Basic') !!}</a></li>
					  <li><a href="#bank-account" data-toggle="tab"><i class="fa fa-laptop"></i> {!! trans('messages.Account') !!}</a></li>
					  <li><a href="#document" data-toggle="tab"><i class="fa fa-file"></i> {!! trans('messages.Documents') !!}</a></li>
					  <li><a href="#salary" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>
					</ul>
					<!-- End nav tab -->

					<!-- Tab panes -->
					<div class="tab-content">
					
						
						<!-- Tab basic -->
						<div class="tab-pane animated fadeInRight active" id="basic">
							<h2>{!! trans('messages.Basic Information') !!}</h2>
							<div class="user-profile-content">
								{!! Form::model($employee,['files' => true, 'method' => 'PATCH','action' => ['EmployeeController@profileUpdate',$employee->id] ,'class' => 'employee-form', 'role' => 'form']) !!}
			    				  	<div class="col-sm-6">
				    				  	<div class="form-group">
										    {!! Form::label('employee_code',trans('messages.Employee Code'))!!}
											{!! Form::input('text','employee_code',isset($profile->employee_code) ? $profile->employee_code : '',['class'=>'form-control','placeholder'=>'Enter Employee Code'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('father_name',trans('messages.Father Name'))!!}
											{!! Form::input('text','father_name',isset($profile->father_name) ? $profile->father_name : '',['class'=>'form-control','placeholder'=>'Enter Father Name'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('mother_name',trans('messages.Mother Name'))!!}
											{!! Form::input('text','mother_name',isset($profile->mother_name) ? $profile->mother_name : '',['class'=>'form-control','placeholder'=>'Enter Mother Name'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('date_of_birth',trans('messages.Date of Birth'))!!}
											{!! Form::input('text','date_of_birth',isset($profile->date_of_birth) ? $profile->date_of_birth : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date of Birth','readonly' => 'true'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('date_of_joining',trans('messages.Date of Joining'))!!}
											{!! Form::input('text','date_of_joining',isset($profile->date_of_joining) ? $profile->date_of_joining : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date of Joining','readonly' => 'true'])!!}
											<div class="help-block"><span id="reset-date-of-joining" class="btn btn-xs" href='#'>Reset</span></div>
										</div>
										<div class="form-group">
										    {!! Form::label('date_of_leaving',trans('messages.Date of Leaving'))!!}
											{!! Form::input('text','date_of_leaving',isset($profile->date_of_leaving) ? $profile->date_of_leaving : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Date of Leaveing','readonly' => 'true'])!!}
											<div class="help-block"><span id="reset-date-of-leaving" class="btn btn-xs" href='#'>Reset</span></div>
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('contact_number',trans('messages.Contact Number'))!!}
											{!! Form::input('text','contact_number',isset($profile->contact_number) ? $profile->contact_number : '',['class'=>'form-control','placeholder'=>'Enter Contact Number'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('alternate_contact_number',trans('messages.Alternate Contact Number'))!!}
											{!! Form::input('text','alternate_contact_number',isset($profile->alternate_contact_number) ? $profile->alternate_contact_number : '',['class'=>'form-control','placeholder'=>'Enter Alternate Contact Number'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('alternate_email',trans('messages.Alternate Email'))!!}
											{!! Form::input('text','alternate_email',isset($profile->alternate_email) ? $profile->alternate_email : '',['class'=>'form-control','placeholder'=>'Enter Alternate Email'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('present_address',trans('messages.Present Address'),[])!!}
										    {!! Form::textarea('present_address',isset($profile->present_address) ? $profile->present_address : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Present Address'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('permanent_address',trans('messages.Permanent Address'),[])!!}
										    {!! Form::textarea('permanent_address',isset($profile->permanent_address) ? $profile->permanent_address : '',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Permanent Address'])!!}
										</div>
									</div>
									<div class="col-sm-6">
				    				  	<div class="form-group">
											<input type="file" name="photo" id="photo" class="btn btn-default" title="Select Profile Photo">
											@if($profile->photo != null)
												<div class="checkbox">
													<label>
													  {!! Form::checkbox('remove_photo', 1) !!} {!! trans('messages.Remove Photo') !!}
													</label>
												</div>
											@endif
										</div>
										<div class="form-group">
										    {!! Form::label('facebook_link',trans('messages.Facebook Profile'))!!}
											{!! Form::input('text','facebook_link',isset($profile->facebook_link) ? $profile->facebook_link : '',['class'=>'form-control','placeholder'=>'Enter Facebook Profile'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('twitter_link',trans('messages.Twitter Profile'))!!}
											{!! Form::input('text','twitter_link',isset($profile->twitter_link) ? $profile->twitter_link : '',['class'=>'form-control','placeholder'=>'Enter Twitter Profile'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('blogger_link',trans('messages.Blogger Profile'))!!}
											{!! Form::input('text','blogger_link',isset($profile->blogger_link) ? $profile->blogger_link : '',['class'=>'form-control','placeholder'=>'Enter Blogger Profile'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('linkedin_link',trans('messages.LinkedIn Profile'))!!}
											{!! Form::input('text','linkedin_link',isset($profile->linkedin_link) ? $profile->linkedin_link : '',['class'=>'form-control','placeholder'=>'Enter LinkedIn Profile'])!!}
										</div>
				    				  	<div class="form-group">
										    {!! Form::label('googleplus_link',trans('messages.Google Plus Profile'))!!}
											{!! Form::input('text','googleplus_link',isset($profile->googleplus_link) ? $profile->googleplus_link : '',['class'=>'form-control','placeholder'=>'Enter Google Plus Profile'])!!}
										</div>
									{{ App\Classes\Helper::getCustomFields('employee-form',$custom_field_values) }}
									{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Save'),['class' => 'btn btn-primary']) !!}
									</div>
								{!! Form::close() !!}
							</div>
						</div>
						<!-- End Tab basic -->
						<!-- Tab bank-account -->
						<div class="tab-pane animated fadeInRight" id="bank-account">
							<h2>{!! trans('messages.Add Bank Account') !!}</h2>
							<div class="user-profile-content">
								{!! Form::open(['route' => 'bank_account.store','role' => 'form', 'class'=>'bank-account-form']) !!}
			    				  	<div class="col-sm-6">
				    				  	<div class="form-group">
										    {!! Form::label('bank_name',trans('messages.Bank Name'))!!}
											{!! Form::input('text','bank_name','',['class'=>'form-control','placeholder'=>'Enter Bank Name'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('account_name',trans('messages.Account Name'))!!}
											{!! Form::input('text','account_name','',['class'=>'form-control','placeholder'=>'Enter Account Name'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('account_number',trans('messages.Account Number'))!!}
											{!! Form::input('text','account_number','',['class'=>'form-control','placeholder'=>'Enter Account Number'])!!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
										    {!! Form::label('ifsc_code',trans('messages.IFSC Code'))!!}
											{!! Form::input('text','ifsc_code','',['class'=>'form-control','placeholder'=>'Enter IFSC Code'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('bank_branch',trans('messages.Branch Name'))!!}
											{!! Form::input('text','bank_branch','',['class'=>'form-control','placeholder'=>'Enter Branch Name'])!!}
										</div>
										{!! Form::hidden('user_id',$employee->id)!!}
										{!! Form::submit(trans('messages.Add'),['class' => 'btn btn-primary']) !!}
									</div>
								{!! Form::close() !!}

								<div class="clear"></div>
								<h2>{!! trans('messages.List All Bank Accounts') !!}</h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Bank Name') !!}</th>
												<th>{!! trans('messages.Account Name') !!}</th>
												<th>{!! trans('messages.Account Number') !!}</th>
												<th>{!! trans('messages.IFSC Code') !!}</th>
												<th>{!! trans('messages.Branch') !!}</th>
												<th>{!! trans('messages.Option') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($employee->BankAccount as $bankAccount)
											<tr>
												<td>{!! $bankAccount->bank_name !!}</td>
												<td>{!! $bankAccount->account_name !!}</td>
												<td>{!! $bankAccount->account_number !!}</td>
												<td>{!! $bankAccount->ifsc_code !!}</td>
												<td>{!! $bankAccount->bank_branch !!}</td>
												<td>{!! delete_form(['bank_account.destroy',$bankAccount->id]) !!}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- End Tab bank-account -->
						<!-- Tab document -->
						<div class="tab-pane animated fadeInRight" id="document">
							<h2>{!! trans('messages.Add New Document') !!}</h2>
							<div class="user-profile-content">
								{!! Form::open(['files'=>true, 'route' => 'document.store','role' => 'form', 'class'=>'document-form']) !!}
			    				  	<div class="col-sm-6">
				    				  	<div class="form-group">
										    {!! Form::label('document_type_id',trans('messages.Document Type'),[])!!}
											{!! Form::select('document_type_id', [null=>'Please Select'] + $document_types,'',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Document Type'])!!}
										</div>
		  								<div class="form-group">
											<input type="file" name="file" id="file" class="btn btn-default" title="Select Document">
										</div>
										<div class="form-group">
										    {!! Form::label('document_title',trans('messages.Document Title'))!!}
											{!! Form::input('text','document_title','',['class'=>'form-control','placeholder'=>'Enter Document Title'])!!}
										</div>
										<div class="form-group">
										    {!! Form::label('expiry_date',trans('messages.Expiry Date'))!!}
											{!! Form::input('text','expiry_date','',['class'=>'form-control datepicker-input','placeholder'=>'Enter Document Expiry Date','readonly' => 'true'])!!}
										</div>
									</div>
									<div class="col-sm-6">	
										<div class="form-group">
										    {!! Form::label('document_description',trans('messages.Document Description'),[])!!}
										    {!! Form::textarea('document_description','',['size' => '30x3', 'class' => 'form-control', 'placeholder' => 'Enter Document Description'])!!}
										</div>
										{!! Form::hidden('user_id',$employee->id)!!}
										{!! Form::submit(trans('messages.Add'),['class' => 'btn btn-primary']) !!}
									</div>
								{!! Form::close() !!}

								<div class="clear"></div>
								<h2>{!! trans('messages.List All Documents') !!}</h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Document Type') !!}</th>
												<th>{!! trans('messages.Title') !!}</th>
												<th>{!! trans('messages.Expiry Date') !!}</th>
												<th>{!! trans('messages.Description') !!}</th>
												<th>{!! trans('messages.File') !!}</th>
												<th>{!! trans('messages.Option') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($employee->Document as $document)
											<tr>
												<td>{!! $document->DocumentType->document_type_name !!}</td>
												<td>{!! $document->document_title !!}</td>
												<td>{!! App\Classes\Helper::showDate($document->expiry_date) !!}</td>
												<td>{!! $document->document_description !!}</td>
												<td><a target=_blank href="/uploads/document/{!! $document->document !!}">Click here</a></td>
												<td>{!! delete_form(['document.destroy',$document->id]) !!} </td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- End Tab document -->
						<!-- Tab salary -->
						<div class="tab-pane animated fadeInRight" id="salary">
							<div class="user-profile-content">
								{!! Form::open(['route' => 'salary.store','role' => 'form', 'class'=>'salary-form']) !!}
			    				  	
			    				  		<div class="col-sm-6">
			    				  			<h2>{!! trans('messages.Earning Salary') !!}</h2>
					    				  	@foreach($earning_salary_types as $earning_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($earning_salary_type->id,$earning_salary_type->salary_head,[])!!}
												{!! Form::input('number',$earning_salary_type->id,array_key_exists($earning_salary_type->id, $salary) ? round($salary[$earning_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$earning_salary_type->salary_head])!!}
											</div>
											@endforeach
										</div>
			    				  		<div class="col-sm-6">
			    				  			<h2>{!! trans('messages.Deduction Salary') !!}</h2>
					    				  	@foreach($deduction_salary_types as $deduction_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($deduction_salary_type->id,$deduction_salary_type->salary_head,[])!!}
												{!! Form::input('number',$deduction_salary_type->id,array_key_exists($deduction_salary_type->id, $salary)  ? round($salary[$deduction_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$deduction_salary_type->salary_head])!!}
											</div>
											@endforeach
									
										@if(count($earning_salary_types) || count($deduction_salary_types))
										{!! Form::hidden('user_id',$employee->id)!!}
										{!! Form::submit(trans('messages.Save'),['class' => 'btn btn-primary']) !!}
										@endif
										</div>
								{!! Form::close() !!}
								<div class="clear"></div>
							</div>
						</div>
						<!-- End Tab salary -->
						
					</div><!-- End div .tab-content -->
				</div><!-- End div .box-info -->
			</div>
		</div>
	@stop