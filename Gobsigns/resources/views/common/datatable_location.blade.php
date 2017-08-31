	<div class="table-responsive">
		<table class="table table-hover datatable">
			<thead>
				<tr class="top-header">
	                <th colspan="12">{{trans('messages.Location')}}</th>
	                <th colspan="4">{{trans('messages.Location Management Information')}}</th>
	                <th colspan="5">{{trans('messages.Ordered Material')}}</th>
	                <th colspan="1">{{trans('messages.Ground Signs Install Quantity')}}</th>
	                <th colspan="1">{{trans('messages.Car Rental')}}</th>
	                <th colspan="1">{{trans('messages.Holiday Weekend')}}</th>
	                <th colspan="7">{{trans('messages.Daily Sign Walker Schedule')}}</th>
	                <th colspan="7">{{trans('messages.Daily Sign Driver Schedule')}}</th>
	                <th colspan="7">{{trans('messages.Daily Check In')}}</th>
	                <th colspan="3">{{trans('messages.Remainging Sign Counts')}}</th>
	                <th colspan="7">{{trans('messages.Forms Required')}}</th>
	                <th colspan="10">{{trans('messages.Temp Agency')}}</th>
	                <th colspan="3">{{trans('messages.Walker Start Time')}}</th>
	                <th colspan="3">{{trans('messages.Drivers Start Time')}}</th>
	                <th colspan="7">{{trans('messages.Printing Details')}}</th>
	                <th colspan="6">{{trans('messages.Verbiage Detail')}}</th>
	                <th colspan="2">{{trans('messages.Package Tracking')}}</th>
	                <th colspan="2">{{trans('messages.Emailing Details')}}</th>
	                <th colspan="2">{{trans('messages.Delivery Information / Job Comments')}}</th>
	                <th colspan="16">{{trans('messages.Sign Walkers Counts and Hours')}}</th>
	                <th colspan="2">{{trans('messages.Total Calculations')}}</th>
	                <th colspan="16">{{trans('messages.Sign Drivers Counts and Hours')}}</th>
	                <th colspan="2">{{trans('messages.Total Calculations')}}</th>
	                <th colspan="7">{{trans('messages.Services Requested')}}</th>
	                <th colspan="7">{{trans('messages.Consultant Fees / Schedule 1099')}}</th>
	                <th colspan="6">{{trans('messages.ADVANCES / NON-1099')}}</th>
	                <th colspan="2">{{trans('messages.Shipping Estimates')}}</th>
	                <th colspan="2">{{trans('messages.Sales Commissions')}}</th>
	                <th colspan="2">{{trans('messages.Area Manager Commissions')}}</th>
	                <th colspan="2">{{trans('messages.District Manager Commissions')}}</th>
	            </tr>
				<tr>
					@foreach($col_heads as $col_head)
					@if($col_head == 'Option')
					<th style="width:120px;">{!! $col_head !!}</th>
					@else
					<th>{!! $col_head !!}</th>
					@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
			</tbody>
			@if(isset($col_foots))
			<tfoot>
				<tr>
					@foreach($col_foots as $col_foot)
					<th>{!! $col_foot !!}</th>
					@endforeach
				</tr>
			</tfoot>
			@endif
		</table>
	</div>