@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Select') !!} </strong> </h2>
					
					{!! Form::open(['route' => 'payroll.create','role' => 'form', 'class'=>'payroll-form']) !!}
						<div class="form-group">
					    {!! Form::label('month_year',trans('messages.Month & Year'),[])!!}
					    <div class="row">
							<div class="col-xs-6">
								{!! Form::select('month', [''=>''] + App\Classes\Helper::getMonths(), isset($month) ? $month : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Month'])!!}
							</div>
							<div class="col-xs-6">
								{!! Form::select('year', [''=>''] + App\Classes\Helper::getYears(), isset($year) ? $year : date('Y'),['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Year'])!!}
							</div>
						</div>
					  </div>
					  <div class="form-group">
					    {!! Form::label('user_id',trans('messages.Staff'),['class' => 'control-label'])!!}
					    {!! Form::select('user_id', [''=>''] + $users, isset($user_id) ? $user_id : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select User'])!!}
					  </div>
					  {!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Get'),['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
				</div>
			</div>
			@if(isset($user_id) && isset($month) && isset($year))
			<div class="col-sm-8">
				<div class="box-info full">
					
					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#summary" data-toggle="tab"><i class="fa fa-arrows"></i> {!! trans('messages.Summary') !!}</a></li>
					  <li><a href="#salary" data-toggle="tab"><i class="fa fa-money"></i> {!! trans('messages.Salary') !!}</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane animated active fadeInRight" id="summary">
							<div class="user-profile-content">
								<h5><strong>{!! trans('messages.Attendance') !!}</strong> {!! trans('messages.Summary for') !!} {!! ucfirst($month). " ".$year !!}</h5>
								@if(isset($att_summary))
									<div class="col-sm-6">
										<ul class="list-group">
										  <li class="list-group-item">
											<span class="badge badge-danger">{!! $att_summary['A'] !!}</span>
											Absent
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-info">{!! $att_summary['H'] !!}</span>
											Holiday
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-success">{!! $att_summary['P'] !!}</span>
											Present
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-default">{!! $att_summary['W'] !!}</span>
											Total Working Days
										  </li>
										</ul>
									</div>
								@endif
								@if(isset($summary))
									<div class="col-sm-6">
										<ul class="list-group">
										  <li class="list-group-item">
											<span class="badge badge-danger">{!! array_key_exists('total_late',$summary) ? $summary['total_late'] : '-' !!}</span>
											Total Late
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-info">{!! array_key_exists('total_early',$summary) ? $summary['total_early'] : '-' !!}</span>
											Total Early
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-default">{!! array_key_exists('total_overtime',$summary) ? $summary['total_overtime'] : '-' !!}</span>
											Total Overtime
										  </li>
										  <li class="list-group-item">
											<span class="badge badge-success">{!! array_key_exists('total_working',$summary) ? $summary['total_working'] : '-' !!}</span>
											Total Working Duration
										  </li>
										</ul>
									</div>
								@endif
								<h5><strong>{!! trans('messages.Monthly') !!}</strong> {!! trans('messages.Salary of') !!} {!! $user->first_name." ".$user->last_name !!}</h5>
								@if(count($salary))
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Salary Head') !!}</th>
												<th>{!! trans('messages.Type') !!}</th>
												<th>{!! trans('messages.Amount') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($salary as $sal)
												<tr>
													<td>{!! $sal->salary_head !!}</td>
													<td>{!! ucfirst($sal->salary_type) !!}</td>
													<td>{!! round($sal->amount,2) !!}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								@else
								<div class="alert alert-danger"><strong>{!! trans('messages.Salary not yet set!!') !!}</strong></div>
								@endif
							</div>
						</div>
						<div class="tab-pane animated fadeInRight" id="salary">
							<div class="user-profile-content">
								<h3 class="text-center ">{!! $user->first_name." ".$user->last_name !!}</h3>
								<h4 class="text-center ">{!! $user->Location->location." in ".$user->Location->Client->client_name !!} Client</h4>
								<h4 class="text-center ">Salary Slip {!! ucfirst($month)." ".$year !!}</h4>
									@if(Entrust::hasRole('admin'))
									{!! Form::open(['route' => 'payroll.store','role' => 'form', 'class'=>'payroll-store-form']) !!}
								  		<div class="col-sm-6">
								  			<h2>{!! trans('messages.Earning Salary') !!}</h2>
					    				  	@foreach($earning_salary_types as $earning_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($earning_salary_type->id,$earning_salary_type->salary_head,[])!!}
												{!! Form::input('number',$earning_salary_type->id,array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$earning_salary_type->salary_head])!!}
											</div>
											@endforeach
										</div>
								  		<div class="col-sm-6">
								  			<h2>{!! trans('messages.Deduction Salary') !!}</h2>
					    				  	@foreach($deduction_salary_types as $deduction_salary_type)
					    				  	<div class="form-group">
											    {!! Form::label($deduction_salary_type->id,$deduction_salary_type->salary_head,[])!!}
												{!! Form::input('number',$deduction_salary_type->id,array_key_exists($deduction_salary_type->id, $payroll)  ? round($payroll[$deduction_salary_type->id],2) : '',['class'=>'form-control','placeholder'=>'Enter ' .$deduction_salary_type->salary_head])!!}
											</div>
											@endforeach
										</div>
										<h2>{!! trans('messages.Actual Contribution') !!}</h2>
										<div class="col-sm-12">
											<div class="form-group">
											    {!! Form::label('employee_contribution','Employee Contribution',[])!!}
												{!! Form::input('number','employee_contribution',isset($payroll_slip->employee_contribution) ? round($payroll_slip->employee_contribution,2) : '',['class'=>'form-control','placeholder'=>'Enter Employee Contribution'])!!}
											</div>
											<div class="form-group">
											    {!! Form::label('employer_contribution','Employer Contribution',[])!!}
												{!! Form::input('number','employer_contribution',isset($payroll_slip->employer_contribution) ? round($payroll_slip->employer_contribution,2) : '',['class'=>'form-control','placeholder'=>'Enter Employer Contribution'])!!}
											</div>
											<div class="form-group">
											    {!! Form::label('date_of_contribution','Date of Contribution',[])!!}
												{!! Form::input('text','date_of_contribution',isset($payroll_slip->date_of_contribution) ? $payroll_slip->date_of_contribution : '',['class'=>'form-control datepicker-input','placeholder'=>'Enter Employer Contribution','readonly' => 'true'])!!}
											</div>
											<div class="checkbox">
												<label>
												  <input type="checkbox" name="sms" value="yes"> Send SMS
												</label>
												<label>
												  <input type="checkbox" name="mail" value="yes"> Send Mail
												</label>
											</div>
										</div>

										{!! Form::hidden('user_id',$user_id)!!}
										{!! Form::hidden('month',$month)!!}
										{!! Form::hidden('year',$year)!!}
										{!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
									{!! Form::close() !!}	
								<div class="clear"></div>
								@endif

								@if($payroll)
									<?php $total_earning = $total_deduction = 0; ?>
									<h2><strong>{!! trans('messages.Final Salary Sheet') !!}</strong>
										<a href="/payroll/generate/print/{!! $payroll_slip->id !!}" class="DTTT_button_small pull-right"><i class="fa fa-print"></i></a>
										<a href="/payroll/generate/pdf/{!! $payroll_slip->id !!}" class="DTTT_button_small pull-right"><i class="fa fa-file"></i></a>
									</h2>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											@foreach($earning_salary_types as $earning_salary_type)
											<dt>{!! $earning_salary_type->salary_head !!}</dt>
											<dd>{!! array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0 !!}</dd>
											<?php $total_earning += array_key_exists($earning_salary_type->id, $payroll) ? round($payroll[$earning_salary_type->id],2) : 0; ?>
											@endforeach
										</dl>
									</div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											@foreach($deduction_salary_types as $deduction_salary_type)
											<dt>{!! $deduction_salary_type->salary_head !!}</dt>
											<dd>{!! array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0 !!}</dd>
											<?php $total_deduction += array_key_exists($deduction_salary_type->id, $payroll) ? round($payroll[$deduction_salary_type->id],2) : 0; ?>
											@endforeach
										</dl>
									</div>
									<hr />
									<div class="clear"></div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt>{!! trans('messages.Total Earning') !!}</dt>
											<dd>{!! $total_earning !!}</dd>
										</dl>
									</div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt>{!! trans('messages.Total Deduction') !!}</dt>
											<dd>{!! $total_deduction !!}</dd>
										</dl>
									</div>
									<div class="clear"></div>
									<div class="col-sm-6">
										<dl class="dl-horizontal">
											<dt><big>NET SALARY</big></dt>
											<dd>{!! $total_earning - $total_deduction !!}</dd>
										</dl>
									</div>
									<div class="clear"></div>

								@else
								<div class="alert alert-danger"><strong>{!! trans('messages.Payroll not generated for this month!!') !!}</strong></div>
								@endif
							</div>
						</div>
					</div>

								
				</div>
			</div>
			@endif
		</div>

	@stop