<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_name_address',trans('messages.Agency Name'),[])!!}
		{!! Form::input('text','agency_name_address',isset($location->agency_name_address) ? $location->agency_name_address : '',['class'=>'form-control', 'placeholder'=>'Enter Agency Name Address'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group margin-bottom5">
		{!! Form::label('agency_address',trans('messages.Address'),[])!!}
		{!! Form::input('text','agency_address1',isset($location->agency_address1) ? $location->agency_address1 : '',['class'=>'form-control', 'placeholder'=>'Enter Address'])!!}
	</div>
	<div class="form-group">
		{!! Form::input('text','agency_address2',isset($location->agency_address2) ? $location->agency_address2 : '',['class'=>'form-control', 'placeholder'=>''])!!}
	</div>
</div>
<div class="col-sm-7 col-md-7">
	<div class="form-group">
		{!! Form::label('agency_city',trans('messages.City'),[])!!}
		{!! Form::input('text','agency_city',isset($location->agency_city) ? $location->agency_city : '',['class'=>'form-control', 'placeholder'=>'Enter City'])!!}
	</div>
</div>
<div class="col-sm-3 col-md-3">
	<div class="form-group">
		{!! Form::label('agency_state',trans('messages.State'),[])!!}
		{!! Form::select('agency_state', [
					''=>'',
					'AL'=>'Alabama',
					'AK'=>'Alaska',
					'AZ'=>'Arizona',
					'AR'=>'Arkansas',
					'CA'=>'California',
					'CO'=>'Colorado',
					'CT'=>'Connecticut',
					'DE'=>'Delaware',
					'DC'=>'District of Columbia',
					'FL'=>'Florida',
					'GA'=>'Georgia',
					'HI'=>'Hawaii',
					'ID'=>'Idaho',
					'IL'=>'Illinois',
					'IN'=>'Indiana',
					'IA'=>'Iowa',
					'KS'=>'Kansas',
					'KY'=>'Kentucky',
					'LA'=>'Louisiana',
					'ME'=>'Maine',
					'MD'=>'Maryland',
					'MA'=>'Massachusetts',
					'MI'=>'Michigan',
					'MN'=>'Minnesota',
					'MS'=>'Mississippi',
					'MO'=>'Missouri',
					'MT'=>'Montana',
					'NE'=>'Nebraska',
					'NV'=>'Nevada',
					'NH'=>'New Hampshire',
					'NJ'=>'New Jersey',
					'NM'=>'New Mexico',
					'NY'=>'New York',
					'NC'=>'North Carolina',
					'ND'=>'North Dakota',
					'OH'=>'Ohio',
					'OK'=>'Oklahoma',
					'OR'=>'Oregon',
					'PA'=>'Pennsylvania',
					'PR'=>'Puerto Rico',
					'RI'=>'Rhode Island',
					'SC'=>'South Carolina',
					'SD'=>'South Dakota',
					'TN'=>'Tennessee',
					'TX'=>'Texas',
					'UT'=>'Utah',
					'VT'=>'Vermont',
					'VA'=>'Virginia',
					'WA'=>'Washington',
					'WV'=>'West Virginia',
					'WI'=>'Wisconsin',
					'WY'=>'Wyoming',
				],isset($location->agency_state) ? $location->agency_state : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select State'])!!}
	</div>
</div>
<div class="col-sm-2 col-md-2">
	<div class="form-group">
		{!! Form::label('agency_zip',trans('messages.Zip'),[])!!}
		{!! Form::input('text','agency_zip',isset($location->agency_zip) ? $location->agency_zip : '',['class'=>'form-control', 'placeholder'=>'Enter Zip'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_phone',trans('messages.Agency Phone'),[])!!}
		{!! Form::input('text','agency_phone',isset($location->agency_phone) ? $location->agency_phone : '',['class'=>'form-control', 'placeholder'=>'Enter Agency Phone'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_dm_phone',trans('messages.DM Phone'),[])!!}
		{!! Form::input('text','agency_dm_phone',isset($location->agency_dm_phone) ? $location->agency_dm_phone : '',['class'=>'form-control', 'placeholder'=>'Enter DM Phone'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_branch_email',trans('messages.Branch Email'),[])!!}
		{!! Form::input('text','agency_branch_email',isset($location->agency_branch_email) ? $location->agency_branch_email : '',['class'=>'form-control', 'placeholder'=>'Enter Branch Email'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_range_target',trans('messages.Range to Target in Miles'),[])!!}
		<input id="agency_range_target"  name="agency_range_target" type="text" data-provide="slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="{!! isset($location->agency_range_target) ? $location->agency_range_target : 0 !!}"/>
		<span id="agency_range_target_val" class="slider-val">{!! isset($location->agency_range_target) ? $location->agency_range_target : 0 !!}</span>
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('agency_order_confirms',trans('messages.Order Confirmations'),[])!!}
		{!! Form::input('text','agency_order_confirms',isset($location->agency_order_confirms) ? $location->agency_order_confirms : '',['class'=>'form-control', 'placeholder'=>'Enter Order Confirmations'])!!}
	</div>
</div>