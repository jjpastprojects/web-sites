@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-8">
				{!! Form::open(['route' => 'location.store','role' => 'form', 'class'=>'location-form col-sm-12 no-padding-rl']) !!}
				<div class="box-info no-padding-rl padding-top0">
					<h2 class="col-sm-12 padding-top20 margin-top0">
						<strong>{!! trans('messages.Add New') !!}</strong> {!! trans('messages.Location') !!}
						<div class="additional-btn">
							<a class="additional-icon" id="dropdownMenu4" data-toggle="dropdown">
								<i class="fa fa-cog"></i>
							</a>
							<ul class="dropdown-menu pull-right animated half fadeInDown" role="menu" aria-labelledby="dropdownMenu4">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="/location">{!! trans('messages.List All Location') !!}</a></li>
								@if(Entrust::hasRole('admin'))
								<li role="presentation"><a role="menuitem" tabindex="-1" href="/reporting">{!! trans('messages.Report All Location') !!}</a></li>
								@endif
							</ul>
						</div>
					</h2>

					<div class="col-xs-3 col-sm-3">
					    <ul class="nav nav-tabs tabs-left ver-tab">
							<li class="active"><a href="#location" data-toggle="tab">{{trans('messages.Location')}}</a></li>
							<li><a href="#contacts" data-toggle="tab">{{trans('messages.Contacts')}}</a></li>
							<li><a href="#job_details" data-toggle="tab">{{trans('messages.Job Details')}}</a></li>
							<li><a href="#daily_schedule" data-toggle="tab">{{trans('messages.Daily Schedule')}}</a></li>
							<li><a href="#temp_agency" data-toggle="tab">{{trans('messages.Temp Agency')}}</a></li>
							<li><a href="#signage" data-toggle="tab">{{trans('messages.Signage')}}</a></li>
							<li><a href="#accounting" data-toggle="tab">{{trans('messages.Accounting')}}</a></li>
					    </ul>
					</div>

					<div class="col-xs-9 col-sm-9">
					    <div class="tab-content">
						    <div class="tab-pane active" id="location">
						      	@include('location._form')
					      	</div>
						    <div class="tab-pane" id="contacts">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Location Management Information') !!}</h2>
						    	@include('location._form_locationManagement')
						    </div>
						    <div class="tab-pane" id="job_details">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Ordered Material') !!}</h2>
								@include('location._form_orderedMaterial')

								<h2 class="col-sm-12 padding-top20 margin-top10 sub-h">{!! trans('messages.Ground Signs Install Quantity') !!}</h2>
								@include('location._form_groundSignsInstallQuantity')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Car Rental') !!}</h2>
								@include('location._form_carRental')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Holiday Weekend') !!}</h2>
								@include('location._form_holidayWeekend')
						    </div>
						    <div class="tab-pane" id="daily_schedule">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Daily Sign Walker Schedule') !!}</h2>
								@include('location._form_dailySignWalkerSchedule')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Daily Sign Driver Schedule') !!}</h2>
								@include('location._form_dailySignDriverSchedule')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Daily Check In') !!}</h2>
								@include('location._form_dailyCheckIn')

								<h2 class="col-sm-12 padding-top20 margin-top10"><strong>{!! trans('messages.Remainging Sign Counts') !!}</strong></h2>
								@include('location._form_remainingSignCounts')

								<h2 class="col-sm-12 padding-top20 margin-top10"><strong>{!! trans('messages.Forms Required') !!}</strong></h2>
								@include('location._form_formsRequired')
						    </div>
						    <div class="tab-pane" id="temp_agency">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Temp Agency') !!}</h2>
								@include('location._form_tempAgency')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Walker Start Time') !!}</h2>
								@include('location._form_walkerStartTime')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Drivers Start Time') !!}</h2>
								@include('location._form_driversStartTime')
						    </div>
						    <div class="tab-pane" id="signage">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Printing Details') !!}</h2>
								@include('location._form_printingDetails')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Verbiage Detail') !!}</h2>
								@include('location._form_verbiageDetail')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Package Tracking') !!}</h2>
								@include('location._form_packageTracking')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Emailing Details') !!}</h2>
								@include('location._form_emailingDetails')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Delivery Information / Job Comments') !!}</h2>
								@include('location._form_deliveryInfoJobComments')
						    </div>
						    <div class="tab-pane" id="accounting">
						    	<h2 class="col-sm-12 sub-h">{!! trans('messages.Sign Walkers Counts and Hours') !!}</h2>
								@include('location._form_signWalkersCountsHours')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Total Calculations') !!}</h2>
								@include('location._form_signWalkersTotalCalculations')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Sign Drivers Counts and Hours') !!}</h2>
								@include('location._form_signDriversCountsHours')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Total Calculations') !!}</h2>
								@include('location._form_signDriversTotalCalculations')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Services Requested') !!}</h2>
								@include('location._form_servicesRequested')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Consultant Fees / Schedule 1099') !!}</h2>
								@include('location._form_colsultantFees')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.ADVANCES / NON-1099') !!}</h2>
								@include('location._form_advances')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Shipping Estimates') !!}</h2>
								@include('location._form_shippingEstimates')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Sales Commissions') !!}</h2>
								@include('location._form_salesCommissions')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Area Manager Commissions') !!}</h2>
								@include('location._form_areaManagerCommissions')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.District Manager Commissions') !!}</h2>
								@include('location._form_districtManagerCommissions')

								<h2 class="col-sm-12 sub-h">{!! trans('messages.Capital Deduction') !!}</h2>
								@include('location._form_capitalDeduction')
						    </div>
					    </div>
					</div>

					<div class="col-sm-9 col-xs-9 col-xs-offset-3 col-sm-offset-3 padding-l30 padding-top10 location-save-btn">
						{!! Form::button(trans('messages.Previous'),['class' => 'btn btn-primary location-pre-btn']) !!}
						{!! Form::button(trans('messages.Next'),['class' => 'btn btn-primary location-next-btn']) !!}
						{{ App\Classes\Helper::getCustomFields('location-form',$custom_field_values) }}
						{!! Form::submit(isset($buttonText) ? $buttonText : trans('messages.Add'),['class' => 'btn btn-primary location-add-btn']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>

			<div class="col-sm-4">
				<div class="the-notes info"><h4>{!! trans('messages.Help') !!}</h4>Locations are post at various client that can be allotted to an employee.
				For example, account client can have location of Sr Account Manager, Account Manager etc.
				etc. You can create location here; every location should have a unique name in a client. Once you create location, you can move to create employee.</div>
				<!--div class="accounting-report">
					@include('location._form_accountingManager')
				</div-->
			</div>
		</div>
	@stop