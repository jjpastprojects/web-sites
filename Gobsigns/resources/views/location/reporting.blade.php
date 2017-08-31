@extends('layouts.default')

	@section('content')

		<div class="row">
			<div class="col-sm-12">
				<div class="box-info">
					<h2><strong>{!! trans('messages.Reporting All') !!}</strong> {!! trans('messages.Locations') !!}
					<div class="additional-btn">
						{!! \App\Classes\Helper::help(config('help.location_index')) !!}
						<a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location/create">{!! trans('messages.Add New Location') !!}</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/location/create">{!! trans('messages.List All Location') !!}</a></li>
						</ul>
					</div>
					</h2>
					


					<div class="row accounting-report">
						<div class="col-sm-12">
							<div id="transaction-date" class="pull-right">
							    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
							    <span></span> <b class="caret"></b>
							</div>
						</div>
						<div class="col-sm-12 table-view-out">
							<div class="service-request-wrapper">
								<table id="service_request" class="table table-hover reporting-table" cellspacing="0" width="100%">
									<thead>
										<tr class="top-header">
											<th colspan="11">{{trans('messages.Services Requested')}}</th>
							                <th colspan="7">{{trans('messages.Consultant Fees / Schedule 1099')}}</th>
							                <th colspan="6">{{trans('messages.ADVANCES / NON-1099')}}</th>
							                <th colspan="1">{{trans('messages.Sales Commissions')}}</th>
							                <th colspan="1">{{trans('messages.District Manager Commissions')}}</th>
							                <th colspan="4">P & L</th>
										</tr>
							            <tr>
							            	<th>{!! trans('messages.Created Date') !!}</th>
							                <th>{!! trans('messages.Location') !!}</th>
							                <th>{!! trans('messages.Client Name') !!}</th>
							                <th>{!! trans('messages.Job Number') !!}</th>
							                <th>{!! trans('messages.Sign Rate') !!}</th>
							                <th>{!! trans('messages.Walker Rate') !!}</th>
							                <th>{!! trans('messages.Driver Rate') !!}</th>
							                <th>{!! trans('messages.Other') !!}</th>
							                <th>{!! trans('messages.Prepaid') !!}</th>
							                <th>{!! trans('messages.Deduction') !!}</th>
							                <th>{!! trans('messages.Balance Due') !!}</th>
							                <th>{!! trans('messages.Install Rate') !!}</th>
							                <th>{!! trans('messages.Walker Rate') !!}</th>
							                <th>{!! trans('messages.Driver Rate') !!}</th>
							                <th>{!! trans('messages.Other') !!}</th>
							                <th>{!! trans('messages.Prepaid') !!}</th>
							                <th>{!! trans('messages.Deduction') !!}</th>
							                <th>{!! trans('messages.Balance Due') !!}</th>
							                <th>{!! trans('messages.Walker Rate') !!}</th>
							                <th>{!! trans('messages.Driver Rate') !!}</th>
							                <th>{!! trans('messages.Other') !!}</th>
							                <th>{!! trans('messages.Prepaid') !!}</th>
							                <th>{!! trans('messages.Deduction') !!}</th>
							                <th>{!! trans('messages.Balance Due') !!}</th>
							                <th>{!! trans('messages.Amount') !!}</th>
							                <th>{!! trans('messages.Amount') !!}</th>
							                <th>{!! trans('messages.Gross Pofit Before Deduction') !!}</th>
							                <th>{!! trans('messages.Capital Deduction') !!}</th>
							                <th>{!! trans('messages.Gross Pofit After Deduction') !!}</th>
							                <th>{!! trans('messages.Gross Profit %') !!}</th>
							            </tr>
							        </thead>
							        <tbody>
							        	@foreach($locations as $location)
							        	<tr>
							        		<td>{!! $location['created_date'] !!}</td>
							        		<td>{!! $location['location'] !!}</td>
							        		<td>{!! $location['client'] !!}</td>
							        		<td>{!! $location['job_number'] !!}</td>
							        		<td>${!! $location['services_sign_rate'] !!}</td>
							        		<td>${!! $location['services_walker_rate'] !!}</td>
							        		<td>${!! $location['services_driver_rate'] !!}</td>
							        		<td>${!! $location['services_other'] !!}</td>
							        		<td>${!! $location['services_prepaid'] !!}</td>
							        		<td>${!! $location['services_deduction'] !!}</td>
							        		<td>${!! $location['services_balance_due'] !!}</td>
							        		<td>${!! $location['consultantfees_install_rate'] !!}</td>
							        		<td>${!! $location['consultantfees_walker_rate'] !!}</td>
							        		<td>${!! $location['consultantfees_driver_rate'] !!}</td>
							        		<td>${!! $location['consultantfees_other'] !!}</td>
							        		<td>${!! $location['consultantfees_prepaid'] !!}</td>
							        		<td>${!! $location['consultantfees_deduction'] !!}</td>
							        		<td>${!! $location['consultantfees_balance_due'] !!}</td>
							        		<td>${!! $location['advances_walker_advance'] !!}</td>
							        		<td>${!! $location['advances_driver_advance'] !!}</td>
							        		<td>${!! $location['advances_other'] !!}</td>
							        		<td>${!! $location['advances_prepaid'] !!}</td>
							        		<td>${!! $location['advances_deduction'] !!}</td>
							        		<td>${!! $location['advances_balance_due'] !!}</td>
							        		<td>${!! $location['sales_amount'] !!}</td>
							        		<td>${!! $location['district_manager_amount'] !!}</td>
							        		<td>${!! $location['gross_profit_before_deduction'] !!}</td>
							        		<td>${!! $location['capital_deduction_amount'] !!}</td>
							        		<td>${!! $location['gross_profit_after_deduction'] !!}</td>
							        		<td>{!! $location['gross_profit'] !!}%</td>
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

	@stop