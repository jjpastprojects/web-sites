<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('client_id',trans('messages.Client').' #',[])!!}
		{!! Form::select('client_id', [''=>''] + $clients,isset($location->client_id) ? $location->client_id : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Client'])!!}
	</div>
</div>
<!--div class="col-md-12">
	<div class="form-group">
		{!! Form::label('top_location_id',trans('messages.Top Location'),[])!!}
		{!! Form::select('top_location_id', [''=>''] + $top_locations,isset($location->top_location_id) ? $location->top_location_id : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select Top Location'])!!}
		<span class="help-block">Leave blank if location is top location.</span>
	</div>
</div-->
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('location',trans('messages.Location').' #',[])!!}
		{!! Form::input('text','location',isset($location->location) ? $location->location : '',['class'=>'form-control', 'placeholder'=>'Enter Location', 'id'=>'location_id'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('job',trans('messages.Job Number').' #',[])!!}
		{!! Form::input('text','job_number',isset($location->job_number) ? $location->job_number : '',['class'=>'form-control', 'placeholder'=>'Enter Job Number', 'id'=>'job_number'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('store',trans('messages.Store').' #',[])!!}
		{!! Form::input('text','store',isset($location->store) ? $location->store : '',['class'=>'form-control', 'placeholder'=>'Enter Store'])!!}
	</div>
</div>
<div class="col-sm-12">
	<div class="form-group margin-bottom5">
		{!! Form::label('address',trans('messages.Address'),[])!!}
		{!! Form::input('text','address1',isset($location->address1) ? $location->address1 : '',['class'=>'form-control', 'placeholder'=>'Enter Address', 'id'=>'address1'])!!}
	</div>
	<div class="form-group">
		{!! Form::input('text','address2',isset($location->address2) ? $location->address2 : '',['class'=>'form-control', 'placeholder'=>''])!!}
	</div>
</div>
<div class="col-sm-7 col-md-7">
	<div class="form-group">
		{!! Form::label('city',trans('messages.City'),[])!!}
		{!! Form::input('text','city',isset($location->city) ? $location->city : '',['class'=>'form-control', 'placeholder'=>'Enter City'])!!}
	</div>
</div>
<div class="col-sm-3 col-md-3">
	<div class="form-group">
		{!! Form::label('state',trans('messages.State'),[])!!}
		{!! Form::select('state', [
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
				],isset($location->state) ? $location->state : '',['class'=>'form-control input-xlarge select2me', 'placeholder'=>'Select State'])!!}
	</div>
</div>
<div class="col-sm-2 col-md-2">
	<div class="form-group">
		{!! Form::label('zip',trans('messages.Zip'),[])!!}
		{!! Form::input('text','zip',isset($location->zip) ? $location->zip : '',['class'=>'form-control', 'placeholder'=>'Enter Zip'])!!}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{!! Form::label('phone',trans('messages.Phone'),[])!!}
		{!! Form::input('text','phone',isset($location->phone) ? $location->phone : '',['class'=>'form-control', 'placeholder'=>'Enter Phone'])!!}
	</div>
</div>
<!--div class="col-md-12">
	<div class="form-group">
		{!! Form::label('fax',trans('messages.Fax'),[])!!}
		{!! Form::input('text','fax',isset($location->fax) ? $location->fax : '',['class'=>'form-control', 'placeholder'=>'Enter Fax'])!!}
	</div>
</div-->