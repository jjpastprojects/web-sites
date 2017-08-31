@extends('layouts.default')

	@section('content')
				<div class="row">
					<div class="col-sm-4">
						<div class="box-info text-center user-profile-2">
							<h4> Job # {!! str_pad($job->id, 3, 0, STR_PAD_LEFT) !!} </h4>
							<h5>{!! $job->job_title !!}</h5>
							<ul class="list-group">
							  <li class="list-group-item">
								<span class="badge success">{!! App\Classes\Helper::showDate($job->created_at) !!}</span>
								Posted On
							  </li>
							  <li class="list-group-item">
								<span class="badge success">{!! $job->Location->location !!}</span>
								Post
							  </li>
							  <li class="list-group-item">
								<span class="badge success">{!! $job->numbers !!}</span>
								Number of Posts
							  </li>
							</ul>

							<p>{!! $job->job_description !!}</p>
						</div>
					</div>
					
					<div class="modal fade" id="myModal" role="basic" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							</div>
						</div>
					</div>
					
					<div class="col-sm-8">
						<div class="box-info">
							<h2><strong>Application</strong> List</h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>{!! trans('messages.Name') !!}</th>
												<th>{!! trans('messages.Email') !!}</th>
												<th>{!! trans('messages.Contact') !!}</th>
												<th>{!! trans('messages.Status') !!}</th>
												<th>{!! trans('messages.Resume') !!}</th>
												<th>{!! trans('messages.Option') !!}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($applications as $application)
												<tr>
													<td>{!! $application->name !!}</td>
													<td>{!! $application->email !!}</td>
													<td>{!! $application->contact_number !!}</td>
													<td>{!! \App\Classes\Helper::getApplicationStatus($application->status) !!}</td>
													<td><a href="{!! URL::to('/uploads/resume/'.$application->resume) !!}">Click Here</a></td>
													<td>
														<a href="{!! URL::to('/application/'.$application->id) !!}" class='DTTT_button_small' data-toggle='modal' data-target='#myModal' > <i class='fa fa-share'></i></a>
														{!! delete_form(['application.deleteApplication',$application->id]) !!}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
						</div>
					</div>
				</div>
				
	@stop