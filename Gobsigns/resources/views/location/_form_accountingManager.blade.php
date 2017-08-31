<div class="col-sm-12">
	<div id="transaction-date" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
	    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
	    <span></span> <b class="caret"></b>
	</div>
</div>
<div class="col-sm-12 table-view-out">
	<div class="service-request-wrapper">
		<table id="service_request" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">SERVICE REQUESTED</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Sign Rate') !!}</th>
	                <th>{!! trans('messages.Walker Rate') !!}</th>
	                <th>{!! trans('messages.Driver Rate') !!}</th>
	                <th>{!! trans('messages.Other') !!}</th>
	                <th>{!! trans('messages.Prepaid') !!}</th>
	                <th>{!! trans('messages.Deduction') !!}</th>
	                <th>{!! trans('messages.Balance Due') !!}</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['services_sign_rate'] !!}</td>
	        		<td>{!! $location['services_walker_rate'] !!}</td>
	        		<td>{!! $location['services_driver_rate'] !!}</td>
	        		<td>{!! $location['services_other'] !!}</td>
	        		<td>{!! $location['services_prepaid'] !!}</td>
	        		<td>{!! $location['services_deduction'] !!}</td>
	        		<td>{!! $location['services_balance_due'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
	<div class="consultant-fees-wrapper">
		<table id="consultant_fees" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">CONSULTANT FEES/SCHEDULE 1099</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Install Rate') !!}</th>
	                <th>{!! trans('messages.Walker Rate') !!}</th>
	                <th>{!! trans('messages.Driver Rate') !!}</th>
	                <th>{!! trans('messages.Other') !!}</th>
	                <th>{!! trans('messages.Prepaid') !!}</th>
	                <th>{!! trans('messages.Deduction') !!}</th>
	                <th>{!! trans('messages.Balance Due') !!}</th>
	            </tr>
	        </thead>
	        <tbody>	        	
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['consultantfees_install_rate'] !!}</td>
	        		<td>{!! $location['consultantfees_walker_rate'] !!}</td>
	        		<td>{!! $location['consultantfees_driver_rate'] !!}</td>
	        		<td>{!! $location['consultantfees_other'] !!}</td>
	        		<td>{!! $location['consultantfees_prepaid'] !!}</td>
	        		<td>{!! $location['consultantfees_deduction'] !!}</td>
	        		<td>{!! $location['consultantfees_balance_due'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
	<div class="advances-non1099-wrapper">
		<table id="advances_non1099" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">ADVANCES/NON-1099</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Walker Rate') !!}</th>
	                <th>{!! trans('messages.Driver Rate') !!}</th>
	                <th>{!! trans('messages.Other') !!}</th>
	                <th>{!! trans('messages.Prepaid') !!}</th>
	                <th>{!! trans('messages.Deduction') !!}</th>
	                <th>{!! trans('messages.Balance Due') !!}</th>
	            </tr>
	        </thead>
	        <tbody>	        	
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['advances_walker_advance'] !!}</td>
	        		<td>{!! $location['advances_driver_advance'] !!}</td>
	        		<td>{!! $location['advances_other'] !!}</td>
	        		<td>{!! $location['advances_prepaid'] !!}</td>
	        		<td>{!! $location['advances_deduction'] !!}</td>
	        		<td>{!! $location['advances_balance_due'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
	<div class="sales-commissions-wrapper">
		<table id="sales_commissions" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">SALES COMMISSIONS</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Amount') !!}</th>
	            </tr>
	        </thead>
	        <tbody>	        	
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['sales_amount'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
	<div class="district-manager-commissions-wrapper">
		<table id="district_manager" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">DISTIRCT MANAGER COMMISSIONS</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Amount') !!}</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['district_manager_amount'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
	<div class="pl-wrapper">
		<table id="pl" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<caption class="text-center">P & L</caption>
			<thead>
	            <tr>
	                <th>{!! trans('messages.Gross Pofit Before Deduction') !!}</th>
	                <th>{!! trans('messages.Capital Deduction') !!}</th>
	                <th>{!! trans('messages.Gross Pofit After Deduction') !!}</th>
	                <th>{!! trans('messages.Gross Profit %') !!}</th>
	            </tr>
	        </thead>
	        <tbody>
	        	@foreach($locations as $location)
	        	<tr>
	        		<td>{!! $location['gross_profit_before_deduction'] !!}</td>
	        		<td>{!! $location['capital_deduction_amount'] !!}</td>
	        		<td>{!! $location['gross_profit_after_deduction'] !!}</td>
	        		<td>{!! $location['gross_profit'] !!}</td>
	        	</tr>
	        	@endforeach
	        </tbody>
		</table>
	</div>
</div>