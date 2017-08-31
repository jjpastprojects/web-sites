@extends('layouts.default')

	@section('content')

		<div class="modal fade" id="myModal" role="basic" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<div class="tabs-left row">	
						<ul class="nav nav-tabs col-md-2" style="padding-right:0;">
						  <li class="active"><a href="#general" data-toggle="tab"><span class="fa fa-cog"></span> {!! trans('messages.General') !!}</a></li>
						  <li><a href="#permission" data-toggle="tab"><span class="fa fa-key"></span> {!! trans('messages.Permission') !!}</a></li>
						  <li><a href="#mail" data-toggle="tab"><span class="fa fa-envelope"></span> {!! trans('messages.Mail') !!}</a></li>
						  <li><a href="#sms" data-toggle="tab"><span class="fa fa-mobile"></span> {!! trans('messages.SMS') !!}</a></li>
						  <li><a href="#time" data-toggle="tab"><span class="fa fa-clock-o"></span> {!! trans('messages.Time') !!}</a></li>
						  <li><a href="#award" data-toggle="tab"><span class="fa fa-trophy"></span> {!! trans('messages.Award') !!}</a></li>
						  <li><a href="#leave" data-toggle="tab"><span class="fa fa-coffee"></span> {!! trans('messages.Leave') !!}</a></li>
						  <li><a href="#document" data-toggle="tab"><span class="fa fa-file"></span> {!! trans('messages.Document') !!}</a></li>
						  <li><a href="#salary" data-toggle="tab"><span class="fa fa-money"></span> {!! trans('messages.Salary') !!}</a></li>
						  <li><a href="#expense" data-toggle="tab"><span class="fa fa-credit-card"></span> {!! trans('messages.Expense') !!}</a></li>
						  <li><a href="#job" data-toggle="tab"><span class="fa fa-bullhorn"></span> {!! trans('messages.Job') !!}</a></li>
				        </ul>
				        <div id="myTabContent" class="tab-content col-md-9">
						  <div class="tab-pane animated active fadeInRight" id="general">
						    <div class="user-profile-content-wm">
								<h2><strong>{!! trans('messages.General') !!}</strong> {!! trans('messages.Configuration') !!}</h2>
								{!! Form::open(['route' => 'configuration.store','role' => 'form', 'class'=>'config-form ']) !!}
									@include('configuration._form')
								{!! Form::close() !!}
							</div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="mail">
						    <div class="user-profile-content">
								<h2><strong>{!! trans('messages.Mail') !!}</strong> {!! trans('messages.Configuration') !!}</h2>
								{!! Form::open(['route' => 'configuration.mailStore','role' => 'form', 'class'=>'mail-form ']) !!}
									@include('configuration._mail')
								{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="sms">
						    <div class="user-profile-content">
								<h2><strong>{!! trans('messages.SMS') !!}</strong> {!! trans('messages.Configuration') !!} (Default Twilio SMS Integrated)</h2>
								{!! Form::open(['route' => 'configuration.smsStore','role' => 'form', 'class'=>'sms-form ']) !!}
									@include('configuration._sms')
								{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="job">
						    <div class="user-profile-content">
								<h2><strong>{!! trans('messages.Job') !!}</strong> {!! trans('messages.Configuration') !!}</h2>
								{!! Form::open(['route' => 'configuration.jobStore','role' => 'form', 'class'=>'job-configuration-form ']) !!}
									@include('configuration._job')
								{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="permission">
						    <div class="user-profile-content">
								
								<div class="col-sm-4">
									<div class="box-info">
										<h2><strong>Create New Role</strong> </h2>
										{!! Form::open(['route' => 'role.store','role' => 'form', 'class'=>'role-form']) !!}
											@include('role._form')
										{!! Form::close() !!}
									</div>
								</div>
								<div class="col-sm-8">
									<div class="box-info">
										<h2><strong>List All Role</strong> </h2>
										<div class="table-responsive">
											<table class="table table-hover table-striped">
												<thead>
													<tr>
														<th>{!! trans('messages.Name') !!}</th>
														<th>{!! trans('messages.Display Name') !!}</th>
														<th>{!! trans('messages.Option') !!}</th>
													</tr>
												</thead>
												<tbody>
													@foreach($roles as $role)
														<tr>
															<td>{!! $role->name !!}</td>
															<td>{!! $role->display_name !!}</td>
															<td>
																<a href="{!! URL::to('/role/'.$role->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																{!! delete_form(['role.destroy',$role->id]) !!}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="clear"></div>

								<h2><strong>{!! trans('messages.Manage') !!}</strong> {!! trans('messages.Permission') !!}</h2>
								{!! Form::open(['route' => 'configuration.save_permission','role' => 'form', 'class'=>'permission-form ']) !!}
								  <p class="alert alert-info"><strong>Subordinates are the different locations under any location.</strong></p>
								  <table class="table table-hover table-striped">
								  	<thead>
								  		<tr>
								  			<th>Permission</th>
								  			@foreach($roles as $role)
								  			<th>{!! ucwords($role->name) !!}</th>
								  			@endforeach
								  		</tr>
								  		</tr>
								  	</thead>
								  	<tbody>
								  		@foreach($permissions as $permission)
								  			@if($permission->category != $category)
								  			<tr style="background-color:#3498DB;color:#ffffff;"><td colspan="{!! count($roles)+1 !!} "><strong>{!! \App\Classes\Helper::toWord($permission->category) !!} Module</strong></td></tr>
								  			<?php $category = $permission->category; ?>
								  			@endif
								  			<tr>
								  				<td>{!! ucwords($permission->display_name) !!}</td>
									  			@foreach($roles as $role)
									  			<th><input type="checkbox" name="permission[{!!$role->id!!}][{!!$permission->id!!}]" value = '1' {!! (in_array($role->id.'-'.$permission->id,$permission_role)) ? 'checked' : '' !!}></th>
									  			@endforeach
								  			</tr>
								  		@endforeach
								  	</tbody>
								  </table>
								  <br /><br />
								  {!! Form::submit(isset($buttonText) ? $buttonText : 'Save Permission',['class' => 'btn btn-primary pull-right']) !!}
								{!! Form::close() !!}
								<div class="clear"></div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="time">
						    <div class="user-profile-content">
								<h2><strong>{!! trans('messages.Office') !!}</strong> {!! trans('messages.Timing') !!}</h2>
								{!! Form::open(['route' => 'configuration.time','role' => 'form', 'class'=>'time-form ']) !!}
									@include('configuration.time')
								{!! Form::close() !!}
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="award">
						    <div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Award Type') !!}</h2>
											{!! Form::open(['route' => 'award_type.store','role' => 'form', 'class'=>'award-type-form ']) !!}
												@include('award_type._form')
											{!! Form::close() !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Award Types') !!}</h2>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>{!! trans('messages.Award Name') !!}</th>
																<th>{!! trans('messages.Option') !!}</th>
															</tr>
														</thead>
														<tbody>
															@foreach($award_types as $award_type)
																<tr>
																	<td>{!! $award_type->award_name !!}</td>
																	<td>
																		<a href="{!! URL::to('/award_type/'.$award_type->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																		{!! delete_form(['award_type.destroy',$award_type->id]) !!}
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
										</div>
									</div>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="leave">
						    <div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Leave Type') !!}</h2>
											{!! Form::open(['route' => 'leave_type.store','role' => 'form', 'class'=>'leave-type-form ']) !!}
												@include('leave_type._form')
											{!! Form::close() !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Leave Types') !!}</h2>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>{!! trans('messages.leave Name') !!}</th>
																<th>{!! trans('messages.Option') !!}</th>
															</tr>
														</thead>
														<tbody>
															@foreach($leave_types as $leave_type)
																<tr>
																	<td>{!! $leave_type->leave_name !!}</td>
																	<td>
																		<a href="{!! URL::to('/leave_type/'.$leave_type->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																		{!! delete_form(['leave_type.destroy',$leave_type->id]) !!}
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
										</div>
									</div>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="document">
						    <div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Document Type') !!}</h2>
											{!! Form::open(['route' => 'document_type.store','role' => 'form', 'class'=>'document-type-form ']) !!}
												@include('document_type._form')
											{!! Form::close() !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Document Types') !!}</h2>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>{!! trans('messages.Document Type Name') !!}</th>
																<th>{!! trans('messages.Option') !!}</th>
															</tr>
														</thead>
														<tbody>
															@foreach($document_types as $document_type)
																<tr>
																	<td>{!! $document_type->document_type_name !!}</td>
																	<td>
																		<a href="{!! URL::to('/document_type/'.$document_type->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																		{!! delete_form(['document_type.destroy',$document_type->id]) !!}
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
										</div>
									</div>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="salary">
						    <div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Salary Type') !!}</h2>
											{!! Form::open(['route' => 'salary_type.store','role' => 'form', 'class'=>'salary-type-form ']) !!}
												@include('salary_type._form')
											{!! Form::close() !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Salary Types') !!}</h2>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>{!! trans('messages.Salary Head') !!}</th>
																<th>{!! trans('messages.Type') !!}</th>
																<th>{!! trans('messages.Option') !!}</th>
															</tr>
														</thead>
														<tbody>
															@foreach($salary_types as $salary_type)
																<tr>
																	<td>{!! $salary_type->salary_head !!}</td>
																	<td>{!! ucfirst($salary_type->salary_type) !!}</td>
																	<td>
																		<a href="{!! URL::to('/salary_type/'.$salary_type->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																		{!! delete_form(['salary_type.destroy',$salary_type->id]) !!}
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
										</div>
									</div>
								</div>
						    </div>
						  </div>
						  <div class="tab-pane animated fadeInRight" id="expense">
						    <div class="user-profile-content">
								<div class="row">
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Expense Head') !!}</h2>
											{!! Form::open(['route' => 'expense_head.store','role' => 'form', 'class'=>'expense-head-form ']) !!}
												@include('expense_head._form')
											{!! Form::close() !!}
										</div>
									</div>
									<div class="col-sm-6">
										<div class="box-info">
											<h2><strong>{!! trans('messages.Listing All') !!}</strong> {!! trans('messages.Expense Heads') !!}</h2>
												<div class="table-responsive">
													<table class="table table-hover table-striped">
														<thead>
															<tr>
																<th>{!! trans('messages.Expense Head') !!}</th>
																<th>{!! trans('messages.Option') !!}</th>
															</tr>
														</thead>
														<tbody>
															@foreach($expense_heads as $expense_head)
																<tr>
																	<td>{!! $expense_head->expense_head !!}</td>
																	<td>
																		<a href="{!! URL::to('/expense_head/'.$expense_head->id.'/edit') !!}" class='btn btn-xs btn-default' data-toggle='modal' data-target='#myModal' > <i class='fa fa-edit'></i> Edit</a>
																		{!! delete_form(['expense_head.destroy',$expense_head->id]) !!}
																	</td>
																</tr>
															@endforeach
														</tbody>
													</table>
												</div>
										</div>
									</div>
								</div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
				
	@stop