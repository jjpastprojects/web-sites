<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LocationRequest;
use Entrust;
use App\Classes\Helper;
use App\Location;
use App\Client;
use App\User;
use Auth;
use Activity;
use Config;

Class LocationController extends Controller{

	protected $form = 'location-form';

	public function index(Location $location){

		if(!Entrust::can('manage_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

		if(Entrust::hasRole('admin'))
			$locations = $location->get();
		else
			$locations = $location->whereIn('id',$child_locations)->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
                trans('messages.Created Date'),

        		trans('messages.Location'),
        		trans('messages.Client Name'),
        		//trans('messages.Top Location'),
        		trans('messages.Job Number'),
        		trans('messages.Store'),
        		trans('messages.Address'),
        		trans('messages.City'),
        		trans('messages.State'),
        		trans('messages.Zip'),
        		trans('messages.Phone'),
        		//trans('messages.Fax'),

        		trans('messages.Manager'),
        		trans('messages.Mobile Phone'),
        		trans('messages.Regional Manager'),
        		trans('messages.Mobile Phone'),

        		trans('messages.Ground Signs'),
        		trans('messages.Car Signs'),
        		trans('messages.Walker Signs'),
        		trans('messages.Verbiage Decals'),
        		trans('messages.Address Decals'),

                trans('messages.Friday - Monday'),

        		trans('messages.Enterprise'),

        		trans('messages.Holiday Date / None'),

        		trans('messages.Mon'),
        		trans('messages.Tue'),
        		trans('messages.Wed'),
        		trans('messages.Thu'),
        		trans('messages.Fri'),
        		trans('messages.Sat'),
        		trans('messages.Sun'),

        		trans('messages.Mon'),
        		trans('messages.Tue'),
        		trans('messages.Wed'),
        		trans('messages.Thu'),
        		trans('messages.Fri'),
        		trans('messages.Sat'),
        		trans('messages.Sun'),

        		trans('messages.Mon'),
        		trans('messages.Tue'),
        		trans('messages.Wed'),
        		trans('messages.Thu'),
        		trans('messages.Fri'),
        		trans('messages.Sat'),
        		trans('messages.Sun'),

        		trans('messages.Ground Signs'),
        		trans('messages.Car Signs'),
        		trans('messages.Walker Signs'),

				trans('messages.Mon'),
        		trans('messages.Tue'),
        		trans('messages.Wed'),
        		trans('messages.Thu'),
        		trans('messages.Fri'),
        		trans('messages.Sat'),
        		trans('messages.Sun'),

        		trans('messages.Agency Name Address'),
        		trans('messages.Address'),
        		trans('messages.City'),
        		trans('messages.State'),
        		trans('messages.Zip'),
        		trans('messages.Agency Phone'),
        		trans('messages.DM Phone'),
        		trans('messages.Branch Email'),
        		trans('messages.Range to Target in Miles'),
        		trans('messages.Order Confirmations'),

        		trans('messages.Day'),
        		trans('messages.Start Time'),
        		trans('messages.End Time'),

        		trans('messages.Day'),
        		trans('messages.Start Time'),
        		trans('messages.End Time'),

                trans('messages.Sign Type'),
                trans('messages.Color'),
                trans('messages.Layout Needed / Approved'),
                trans('messages.Printer'),
                trans('messages.Quantity'),
                trans('messages.Rate Per'),
                trans('messages.Total'),

                trans('messages.Top Line'),
                trans('messages.Star Burst / Discounts'),
                trans('messages.Store Name'),
                trans('messages.Bottom Line'),
                trans('messages.Additional Lines'),
                trans('messages.Address'),

                trans('messages.Ground'),
                trans('messages.Express'),

                trans('messages.Daily Event Notification'),
                trans('messages.Invoice'),

                trans('messages.Order Date'),
                trans('messages.Delivery Date'),

                trans('messages.Mon').trans('messages.Qty'),
                trans('messages.Tue').trans('messages.Qty'),
                trans('messages.Wed').trans('messages.Qty'),
                trans('messages.Thu').trans('messages.Qty'),
                trans('messages.Fri').trans('messages.Qty'),
                trans('messages.Sat').trans('messages.Qty'),
                trans('messages.Sun').trans('messages.Qty'),
                trans('messages.Total Walkers'),
                trans('messages.Mon').trans('messages.Total Hours'),
                trans('messages.Tue').trans('messages.Total Hours'),
                trans('messages.Wed').trans('messages.Total Hours'),
                trans('messages.Thu').trans('messages.Total Hours'),
                trans('messages.Fri').trans('messages.Total Hours'),
                trans('messages.Sat').trans('messages.Total Hours'),
                trans('messages.Sun').trans('messages.Total Hours'),
                trans('messages.Total Hours'),

                trans('messages.Hourly Rate'),
                trans('messages.Total Amount'),

                trans('messages.Mon').trans('messages.Qty'),
                trans('messages.Tue').trans('messages.Qty'),
                trans('messages.Wed').trans('messages.Qty'),
                trans('messages.Thu').trans('messages.Qty'),
                trans('messages.Fri').trans('messages.Qty'),
                trans('messages.Sat').trans('messages.Qty'),
                trans('messages.Sun').trans('messages.Qty'),
                trans('messages.Total Walkers'),
                trans('messages.Mon').trans('messages.Total Hours'),
                trans('messages.Tue').trans('messages.Total Hours'),
                trans('messages.Wed').trans('messages.Total Hours'),
                trans('messages.Thu').trans('messages.Total Hours'),
                trans('messages.Fri').trans('messages.Total Hours'),
                trans('messages.Sat').trans('messages.Total Hours'),
                trans('messages.Sun').trans('messages.Total Hours'),
                trans('messages.Total Hours'),

                trans('messages.Hourly Rate'),
                trans('messages.Total Amount'),

                trans('messages.Sign Rate'),
                trans('messages.Walker Rate'),
                trans('messages.Driver Rate'),
                trans('messages.Other'),
                trans('messages.Prepaid'),
                trans('messages.Deduction'),
                trans('messages.Balance Due'),

                trans('messages.Install Rate'),
                trans('messages.Walker Rate'),
                trans('messages.Driver Rate'),
                trans('messages.Other'),
                trans('messages.Prepaid'),
                trans('messages.Deduction'),
                trans('messages.Balance Due'),

                trans('messages.Walker Advance'),
                trans('messages.Driver Advance'),
                trans('messages.Other'),
                trans('messages.Prepaid'),
                trans('messages.Deduction'),
                trans('messages.Balance Due'),

                trans('messages.Consultant Checks'),
                trans('messages.Promotional Materials'),

                trans('messages.Name'),
                trans('messages.Amount'),

                trans('messages.Name'),
                trans('messages.Amount'),

                trans('messages.Name'),
                trans('messages.Amount')
    		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

		foreach ($locations as $location){
			$client = $location->Client;
			$cols = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/location/'.$location->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
					delete_form(['location.destroy',$location->id]).
					'</div>',
                    date('F j, Y', strtotime($location->created_at)),
					$location->location,
					$client->client_name,
					//($location->top_location_id) ? $location->Parent->location.' ('.$location->Parent->Client->client_name.')' : '',
					$location->job_number,
					$location->store,
					$location->address1.' '.$location->address2,
					$location->city,
					$location->state,
					$location->zip,
					$location->phone,
					//$location->fax,
					$location->manager,
					$location->manager_mobile_phone,
					$location->regional_manager,
					$location->regional_manager_mobile_phone,

					$this->checkZero($location->ground_signs),
					$this->checkZero($location->car_signs),
					$this->checkZero($location->walker_signs),
					$this->checkZero($location->verbiage_decals),
					$this->checkZero($location->address_decals),

					$this->checkZero($location->ground_signs_quantity),

					$location->car_rental_enterprise,

					$location->holiday_date_nonedaily_walker_monday,

					$this->checkZero($location->daily_walker_monday),
                    $this->checkZero($location->daily_walker_tuesday),
                    $this->checkZero($location->daily_walker_wednesday),
                    $this->checkZero($location->daily_walker_thursday),
                    $this->checkZero($location->daily_walker_friday),
                    $this->checkZero($location->daily_walker_saturday),

                    $this->checkZero($location->daily_walker_sunday),
                    $this->checkZero($location->daily_driver_monday),
                    $this->checkZero($location->daily_driver_tuesday),
                    $this->checkZero($location->daily_driver_wednesday),
                    $this->checkZero($location->daily_driver_thursday),
                    $this->checkZero($location->daily_driver_friday),
                    $this->checkZero($location->daily_driver_saturday),
                    $this->checkZero($location->daily_driver_sunday),

                    $location->daily_checkin_monday,
                    $location->daily_checkin_tuesday,
                    $location->daily_checkin_wednesday,
                    $location->daily_checkin_thursday,
                    $location->daily_checkin_friday,
                    $location->daily_checkin_saturday,
                    $location->daily_checkin_sunday,

                    $this->checkZero($location->remaining_ground_signs),
                    $this->checkZero($location->remaining_car_signs),
                    $this->checkZero($location->remaining_walker_signs),

					$location->forms_required_monday,
                    $location->forms_required_tuesday,
                    $location->forms_required_wednesday,
                    $location->forms_required_thursday,
                    $location->forms_required_friday,
                    $location->forms_required_saturday,
                    $location->forms_required_sunday,

                    $location->agency_name_address,
                    $location->agency_address1.' '.$location->agency_address1,
                    $location->agency_city,
                    $location->agency_state,
                    $location->agency_zip,
                    $location->agency_phone,
                    $location->agency_dm_phone,
                    $location->agency_branch_email,
                    $location->agency_range_target,
                    $location->agency_order_confirms,

                    $location->walker_start_day,
                    $location->walker_start_time,
                    $location->walker_end_time,

                    $location->drivers_start_day,
                    $location->drivers_start_time,
                    $location->drivers_end_time,

                    $location->print_sign_type,
                    $location->print_color,
                    $location->print_layout_approval,
                    $location->printer,
                    $location->print_quantity,
                    $location->print_rate_per,
                    $location->print_total,

                    $location->verbiage_top_line,
                    $location->verbiage_star_burst,
                    $location->verbiage_store_name,
                    $location->verbiage_bottom_line,
                    $location->verbiage_additional_lines,
                    $location->verbiage_address,

                    $location->package_ground,
                    $location->package_express,

                    $location->emailing_eventNotify,
                    $location->emailing_invoice,

                    $location->delivery_order_date,
                    $location->delivery_date,

                    $location->signwalker_mon_qty,
                    $location->signwalker_tue_qty,
                    $location->signwalker_wed_qty,
                    $location->signwalker_thu_qty,
                    $location->signwalker_fri_qty,
                    $location->signwalker_sat_qty,
                    $location->signwalker_sun_qty,
                    $location->signwalker_total_walkers,
                    $location->signwalker_mon_hours,
                    $location->signwalker_tue_hours,
                    $location->signwalker_wed_hours,
                    $location->signwalker_thu_hours,
                    $location->signwalker_fri_hours,
                    $location->signwalker_sat_hours,
                    $location->signwalker_sun_hours,
                    $location->signwalker_total_hours,

                    $location->signwalker_hourly_rate,
                    $location->signwalker_total_amount,

                    $location->signdriver_mon_qty,
                    $location->signdriver_tue_qty,
                    $location->signdriver_wed_qty,
                    $location->signdriver_thu_qty,
                    $location->signdriver_fri_qty,
                    $location->signdriver_sat_qty,
                    $location->signdriver_sun_qty,
                    $location->signdriver_total_walkers,
                    $location->signdriver_mon_hours,
                    $location->signdriver_tue_hours,
                    $location->signdriver_wed_hours,
                    $location->signdriver_thu_hours,
                    $location->signdriver_fri_hours,
                    $location->signdriver_sat_hours,
                    $location->signdriver_sun_hours,
                    $location->signdriver_total_hours,

                    $location->signdriver_hourly_rate,
                    $location->signdriver_total_amount,

                    $location->services_sign_rate,
                    $location->services_walker_rate,
                    $location->services_driver_rate,
                    $location->services_other,
                    $location->services_prepaid,
                    $location->services_deduction,
                    $location->services_balance_due,

                    $location->consultantfees_install_rate,
                    $location->consultantfees_walker_rate,
                    $location->consultantfees_driver_rate,
                    $location->consultantfees_other,
                    $location->consultantfees_prepaid,
                    $location->consultantfees_deduction,
                    $location->consultantfees_balance_due,

                    $location->advances_walker_advance,
                    $location->advances_driver_advance,
                    $location->advances_other,
                    $location->advances_prepaid,
                    $location->advances_deduction,
                    $location->advances_balance_due,

                    $location->shipping_consultant_checks,
                    $location->shipping_promotional_materials,

                    $location->sales_name,
                    $location->sales_amount,

                    $location->area_manager_name,
                    $location->area_manager_amount,

                    $location->district_manager_name,
                    $location->district_manager_amount
				);
			$id = $location->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
		}

        Helper::writeResult($col_data);

        $user = User::first();

        $data = ['col_heads' => $col_heads];

		return view('location.index',$data);
	}

    public function create(){

        if(!Entrust::can('create_location'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        $clients = Client::lists('client_name','id')->all();

        $child_locations = Helper::childLocation(Auth::user()->location_id,1);
        array_push($child_locations, Auth::user()->location_id);

        if(Entrust::hasRole('admin'))
            $top_locations = Location::lists('location','id')->all();
        else
            $top_locations = Location::whereIn('id',$child_locations)->lists('location','id')->all();

        $locations = $this->get_all_locations();

        $old_job_number = $this->get_job_number();
        $old_numbers = explode('-', $old_job_number);

        if (count($old_numbers) == 2) {
            $new_number = (int)$old_numbers[1] + 1;
            $job_number = date('y') . "-0" . $new_number;
        } else
            $job_number = date ('y') . '-0500';

        $location = new Location();
        $location->job_number = $job_number;

        $assets = ['datetimepicker'];
        return view('location.create',compact('clients','top_locations','assets', 'locations', 'location'));
    }

    public function show(){
	}

	public function reporting(){

		if(!Entrust::can('create_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $end_date = date ('Y-m-d');
        $start_date = date('Y-m-d', time() - 30 * 86400);
        $locations = $this->get_all_locations($start_date, $end_date);

		$assets = ['datetimepicker'];
		return view('location.reporting',compact('assets', 'locations'));
	}

	public function edit(Location $location){

		if(!Entrust::can('edit_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$clients = Client::lists('client_name','id')->all();

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);
		array_push($child_locations, Auth::user()->location_id);

		if(Entrust::hasRole('admin'))
			$top_locations = array_diff(Location::where('id','!=',$location->id)->lists('location','id')->all(), Helper::childLocation($location->id));
		else
			$top_locations = array_diff(Location::where('id','!=',$location->id)->whereIn('id',$child_locations)->lists('location','id')->all(), Helper::childLocation($location->id));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$location->id);
		$data = [
					'location' => $location,
					'clients' => $clients,
					'top_locations' => $top_locations,
					'custom_field_values' => $custom_field_values
				];

		$assets = ['datetimepicker'];
		return view('location.edit',$data,compact('assets'));
	}

	public function store(LocationRequest $request, Location $location){	

		if(!Entrust::can('create_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();

		if(!isset($data['top_location_id']) || $data['top_location_id'] == '')
			$data['top_location_id'] = null;

		$location->fill($data)->save();

		Helper::storeCustomField($this->form,$location->id, $data);

		$activity = 'New location "'.$request->input('location').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(LocationRequest $request, Location $location){
		if(!Entrust::can('edit_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $data = $request->all();
		$top_locations = array_diff(Location::where('id','!=',$location->id)->lists('location','id')->all(), Helper::childLocation($location->id));

		/*if(!array_key_exists($data['top_location_id'], $top_locations) && $data['top_location_id'] != '')
			return redirect()->back()->withErrors('Top location cannot be a child location.');*/

		if(!isset ($data['top_location_id']) || $data['top_location_id'] == '')
			$data['top_location_id'] = null;

		$location->fill($data)->save();

		Helper::updateCustomField($this->form,$location->id, $data);

		$activity = 'Location "'.$request->input('location').'" updated';
		Activity::log($activity);
		return redirect('/location')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Location $location){
		if(!Entrust::can('delete_location'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $location->id);
		
		$activity = 'Location "'.$location->location.'" deleted';
		Activity::log($activity);
		
        $location->delete();
        return redirect('/location')->withSuccess(config('constants.DELETED'));
	}

	public function checkZero ($val){
		if($val)
			return $val;
		else
			return null;
	}

    public function getlocations (Request $request) {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $locations = $this->get_all_locations($start_date, $end_date);

        return json_encode(array('success' => true, 'data' => $locations));
    }

    protected function get_job_number () {
        $location = Location::orderBy('job_number', 'DESC')->get()->first();

        return $location->job_number;
    }

    protected function get_all_locations($start_date = null, $end_date = null){

        if(Entrust::hasRole('admin')) {
            if ($start_date != null && $end_date != null) {
                $end_date = date ('Y-m-d', strtotime($end_date) + 86400);
                $start_date = date ('Y-m-d', strtotime($start_date) - 86400);
                $locations = Location::whereBetween('created_at', array($start_date, $end_date))->get();
            } else 
                $locations = Location::get();
        } else
            return null;

        $col_data=array();

        $total_services_sign_rate = 0;
        $total_services_walker_rate = 0;
        $total_services_driver_rate = 0;
        $total_services_other = 0;
        $total_services_prepaid = 0;
        $total_services_deduction = 0;
        $total_services_balance_due = 0;

        $total_consultantfees_install_rate = 0;
        $total_consultantfees_walker_rate = 0;
        $total_consultantfees_driver_rate = 0;
        $total_consultantfees_other = 0;
        $total_consultantfees_prepaid = 0;
        $total_consultantfees_deduction = 0;
        $total_consultantfees_balance_due = 0;

        $total_advances_walker_advance = 0;
        $total_advances_driver_advance = 0;
        $total_advances_other = 0;
        $total_advances_prepaid = 0;
        $total_advances_deduction = 0;
        $total_advances_balance_due = 0;

        $total_sales_amount = 0;

        $total_district_manager_amount = 0;

        $total_gross_profit_before_deduction = 0;
        $total_capital_deduction_amount = 0;
        $total_gross_profit_after_deduction = 0;
        $total_gross_profit = 0;

        foreach ($locations as $location){
            $client = $location->Client;

            $gross_profit_before_deduction = ($location->services_sign_rate + $location->services_walker_rate + $location->services_driver_rate + $location->services_other) + $location->services_deduction - ($location->consultantfees_deduction + $location->advances_deduction) + ($location->consultantfees_install_rate + $location->consultantfees_walker_rate + $location->consultantfees_driver_rate + $location->consultantfees_other + $location->advances_walker_advance + $location->advances_driver_advance + $location->advances_other + $location->print_total) - ($location->shipping_consultant_checks + $location->shipping_promotional_materials + $location->sales_amount + $location->district_manager_amount);

            $gross_profit_after_deduction = $gross_profit_before_deduction - $location->capital_deduction_amount;

            if ($location->services_sign_rate + $location->services_walker_rate + $location->services_driver_rate + $location->services_other + $location->services_deduction == 0)
                $gross_profit = 0;
            else
                $gross_profit = ROUND ($gross_profit_after_deduction / ($location->services_sign_rate + $location->services_walker_rate + $location->services_driver_rate + $location->services_other + $location->services_deduction), 2);
                
            $cols = array(
                    'location' => $location->location,
                    'client' => $client->client_name,
                    'job_number' => $location->job_number,
                    'store' => $location->store,
                    'created_date' => date('F j, Y', strtotime($location->created_at)),
                    'address' => $location->address1.' '.$location->address2,
                    'city' => $location->city,
                    'state' => $location->state,
                    'zip' => $location->zip,
                    'phone' => $location->phone,
                    //'fax' => $location->fax,
                    'manager' => $location->manager,
                    'manager_mobile_phone' => $location->manager_mobile_phone,
                    'regional_manager' => $location->regional_manager,
                    'regional_manager_mobile_phone' => $location->regional_manager_mobile_phone,

                    'ground_signs' => $this->checkZero($location->ground_signs),
                    'car_signs' => $this->checkZero($location->car_signs),
                    'walker_signs' => $this->checkZero($location->walker_signs),
                    'verbiage_decals' => $this->checkZero($location->verbiage_decals),
                    'address_decals' => $this->checkZero($location->address_decals),

                    'ground_signs_quantity' => $this->checkZero($location->ground_signs_quantity),

                    'car_rental_enterprise' => $location->car_rental_enterprise,

                    'holiday_date_nonedaily_walker_monday' => $location->holiday_date_nonedaily_walker_monday,

                    'daily_walker_monday' => $this->checkZero($location->daily_walker_monday),
                    'daily_walker_tuesday' => $this->checkZero($location->daily_walker_tuesday),
                    'daily_walker_wednesday' => $this->checkZero($location->daily_walker_wednesday),
                    'daily_walker_thursday' => $this->checkZero($location->daily_walker_thursday),
                    'daily_walker_friday' => $this->checkZero($location->daily_walker_friday),
                    'daily_walker_saturday' => $this->checkZero($location->daily_walker_saturday),

                    'daily_walker_sunday' => $this->checkZero($location->daily_walker_sunday),
                    'daily_driver_monday' => $this->checkZero($location->daily_driver_monday),
                    'daily_driver_tuesday' => $this->checkZero($location->daily_driver_tuesday),
                    'daily_driver_wednesday' => $this->checkZero($location->daily_driver_wednesday),
                    'daily_driver_thursday' => $this->checkZero($location->daily_driver_thursday),
                    'daily_driver_friday' => $this->checkZero($location->daily_driver_friday),
                    'daily_driver_saturday' => $this->checkZero($location->daily_driver_saturday),
                    'daily_driver_sunday' => $this->checkZero($location->daily_driver_sunday),

                    'daily_checkin_monday' => $location->daily_checkin_monday,
                    'daily_checkin_tuesday' => $location->daily_checkin_tuesday,
                    'daily_checkin_wednesday' => $location->daily_checkin_wednesday,
                    'daily_checkin_thursday' => $location->daily_checkin_thursday,
                    'daily_checkin_friday' => $location->daily_checkin_friday,
                    'daily_checkin_saturday' => $location->daily_checkin_saturday,
                    'daily_checkin_sunday' => $location->daily_checkin_sunday,

                    'remaining_ground_signs' => $this->checkZero($location->remaining_ground_signs),
                    'remaining_car_signs' => $this->checkZero($location->remaining_car_signs),
                    'remaining_walker_signs' => $this->checkZero($location->remaining_walker_signs),

                    'forms_required_monday' => $location->forms_required_monday,
                    'forms_required_tuesday' => $location->forms_required_tuesday,
                    'forms_required_wednesday' => $location->forms_required_wednesday,
                    'forms_required_thursday' => $location->forms_required_thursday,
                    'forms_required_friday' => $location->forms_required_friday,
                    'forms_required_saturday' => $location->forms_required_saturday,
                    'forms_required_sunday' => $location->forms_required_sunday,

                    'agency_name_address' => $location->agency_name_address,
                    'agency_address' => $location->agency_address1.' '.$location->agency_address1,
                    'agency_city' => $location->agency_city,
                    'agency_state' => $location->agency_state,
                    'agency_zip' => $location->agency_zip,
                    'agency_phone' => $location->agency_phone,
                    'agency_dm_phone' => $location->agency_dm_phone,
                    'agency_branch_email' => $location->agency_branch_email,
                    'agency_range_target' => $location->agency_range_target,
                    'agency_order_confirms' => $location->agency_order_confirms,

                    'walker_start_day' => $location->walker_start_day,
                    'walker_start_time' => $location->walker_start_time,
                    'walker_end_time' => $location->walker_end_time,

                    'drivers_start_day' => $location->drivers_start_day,
                    'drivers_start_time' => $location->drivers_start_time,
                    'drivers_end_time' => $location->drivers_end_time,

                    'print_sign_type' => $location->print_sign_type,
                    'print_color' => $location->print_color,
                    'print_layout_approval' => $location->print_layout_approval,
                    'printer' => $location->printer,
                    'print_quantity' => $location->print_quantity,
                    'print_rate_per' => $location->print_rate_per,
                    'print_total' => $location->print_total,

                    'verbiage_top_line' => $location->verbiage_top_line,
                    'verbiage_star_burst' => $location->verbiage_star_burst,
                    'verbiage_store_name' => $location->verbiage_store_name,
                    'verbiage_bottom_line' => $location->verbiage_bottom_line,
                    'verbiage_additional_lines' => $location->verbiage_additional_lines,
                    'verbiage_address' => $location->verbiage_address,

                    'package_ground' => $location->package_ground,
                    'package_express' => $location->package_express,

                    'emailing_eventNotify' => $location->emailing_eventNotify,
                    'emailing_invoice' => $location->emailing_invoice,

                    'delivery_order_date' => $location->delivery_order_date,
                    'delivery_date' => $location->delivery_date,

                    'signwalker_mon_qty' => $location->signwalker_mon_qty,
                    'signwalker_tue_qty' => $location->signwalker_tue_qty,
                    'signwalker_wed_qty' => $location->signwalker_wed_qty,
                    'signwalker_thu_qty' => $location->signwalker_thu_qty,
                    'signwalker_fri_qty' => $location->signwalker_fri_qty,
                    'signwalker_sat_qty' => $location->signwalker_sat_qty,
                    'signwalker_sun_qty' => $location->signwalker_sun_qty,
                    'signwalker_total_walkers' => $location->signwalker_total_walkers,
                    'signwalker_mon_hours' => $location->signwalker_mon_hours,
                    'signwalker_tue_hours' => $location->signwalker_tue_hours,
                    'signwalker_wed_hours' => $location->signwalker_wed_hours,
                    'signwalker_thu_hours' => $location->signwalker_thu_hours,
                    'signwalker_fri_hours' => $location->signwalker_fri_hours,
                    'signwalker_sat_hours' => $location->signwalker_sat_hours,
                    'signwalker_sun_hours' => $location->signwalker_sun_hours,
                    'signwalker_total_hours' => $location->signwalker_total_hours,

                    'signwalker_hourly_rate' => $location->signwalker_hourly_rate,
                    'signwalker_total_amount' => $location->signwalker_total_amount,

                    'signdriver_mon_qty' => $location->signdriver_mon_qty,
                    'signdriver_tue_qty' => $location->signdriver_tue_qty,
                    'signdriver_wed_qty' => $location->signdriver_wed_qty,
                    'signdriver_thu_qty' => $location->signdriver_thu_qty,
                    'signdriver_fri_qty' => $location->signdriver_fri_qty,
                    'signdriver_sat_qty' => $location->signdriver_sat_qty,
                    'signdriver_sun_qty' => $location->signdriver_sun_qty,
                    'signdriver_total_walkers' => $location->signdriver_total_walkers,
                    'signdriver_mon_hours' => $location->signdriver_mon_hours,
                    'signdriver_tue_hours' => $location->signdriver_tue_hours,
                    'signdriver_wed_hours' => $location->signdriver_wed_hours,
                    'signdriver_thu_hours' => $location->signdriver_thu_hours,
                    'signdriver_fri_hours' => $location->signdriver_fri_hours,
                    'signdriver_sat_hours' => $location->signdriver_sat_hours,
                    'signdriver_sun_hours' => $location->signdriver_sun_hours,
                    'signdriver_total_hours' => $location->signdriver_total_hours,

                    'signdriver_hourly_rate' => $location->signdriver_hourly_rate,
                    'signdriver_total_amount' => $location->signdriver_total_amount,

                    'services_sign_rate' => $location->services_sign_rate,
                    'services_walker_rate' => $location->services_walker_rate,
                    'services_driver_rate' => $location->services_driver_rate,
                    'services_other' => $location->services_other,
                    'services_prepaid' => $location->services_prepaid,
                    'services_deduction' => $location->services_deduction,
                    'services_balance_due' => $location->services_balance_due,

                    'consultantfees_install_rate' => $location->consultantfees_install_rate,
                    'consultantfees_walker_rate' => $location->consultantfees_walker_rate,
                    'consultantfees_driver_rate' => $location->consultantfees_driver_rate,
                    'consultantfees_other' => $location->consultantfees_other,
                    'consultantfees_prepaid' => $location->consultantfees_prepaid,
                    'consultantfees_deduction' => $location->consultantfees_deduction,
                    'consultantfees_balance_due' => $location->consultantfees_balance_due,

                    'advances_walker_advance' => $location->advances_walker_advance,
                    'advances_driver_advance' => $location->advances_driver_advance,
                    'advances_other' => $location->advances_other,
                    'advances_prepaid' => $location->advances_prepaid,
                    'advances_deduction' => $location->advances_deduction,
                    'advances_balance_due' => $location->advances_balance_due,

                    'shipping_consultant_checks' => $location->shipping_consultant_checks,
                    'shipping_promotional_materials' => $location->shipping_promotional_materials,

                    'sales_name' => $location->sales_name,
                    'sales_amount' => $location->sales_amount,

                    'area_manager_name' => $location->area_manager_name,
                    'area_manager_amount' => $location->area_manager_amount,

                    'district_manager_name' => $location->district_manager_name,
                    'district_manager_amount' => $location->district_manager_amount,

                    'gross_profit_before_deduction' => $gross_profit_before_deduction,
                    'capital_deduction_amount' => $location->capital_deduction_amount,
                    'gross_profit_after_deduction' => $gross_profit_after_deduction,
                    'gross_profit' => $gross_profit
                );
             
            $total_services_sign_rate += $location->services_sign_rate;
            $total_services_walker_rate += $location->services_walker_rate;
            $total_services_driver_rate += $location->services_driver_rate;
            $total_services_other += $location->services_other;
            $total_services_prepaid += $location->services_prepaid;
            $total_services_deduction += $location->services_deduction;
            $total_services_balance_due += $location->services_balance_due;

            $total_consultantfees_install_rate += $location->consultantfees_install_rate;
            $total_consultantfees_walker_rate += $location->consultantfees_walker_rate;
            $total_consultantfees_driver_rate += $location->consultantfees_driver_rate;
            $total_consultantfees_other += $location->consultantfees_other;
            $total_consultantfees_prepaid += $location->consultantfees_prepaid;
            $total_consultantfees_deduction += $location->consultantfees_deduction;
            $total_consultantfees_balance_due += $location->consultantfees_balance_due;

            $total_advances_walker_advance += $location->advances_walker_advance;
            $total_advances_driver_advance += $location->advances_driver_advance;
            $total_advances_other += $location->advances_other;
            $total_advances_prepaid += $location->advances_prepaid;
            $total_advances_deduction += $location->advances_deduction;
            $total_advances_balance_due += $location->advances_balance_due;

            $total_sales_amount += $location->sales_amount;

            $total_district_manager_amount += $location->area_manager_amount;

            $total_gross_profit_before_deduction += $gross_profit_before_deduction;
            $total_capital_deduction_amount += $location->capital_deduction_amount;
            $total_gross_profit_after_deduction += $gross_profit_after_deduction;

            $col_data[] = $cols;
        }

        if ($total_services_sign_rate + $total_services_walker_rate + $total_services_driver_rate + $total_services_other + $total_services_deduction == 0)
            $total_gross_profit = 0;
        else
            $total_gross_profit = ROUND ($total_gross_profit_after_deduction / ($total_services_sign_rate + $total_services_walker_rate + $total_services_driver_rate + $total_services_other + $total_services_deduction), 2);

        $col_data[] = array(
                'location' => '',
                'client' => '',
                'job_number' => '',
                'created_date' => '',

                'services_sign_rate' => $total_services_sign_rate,
                'services_walker_rate' => $total_services_walker_rate,
                'services_driver_rate' => $total_services_driver_rate,
                'services_other' => $total_services_other,
                'services_prepaid' => $total_services_prepaid,
                'services_deduction' => $total_services_deduction,
                'services_balance_due' => $total_services_balance_due,

                'consultantfees_install_rate' => $total_consultantfees_install_rate,
                'consultantfees_walker_rate' => $total_consultantfees_walker_rate,
                'consultantfees_driver_rate' => $total_consultantfees_driver_rate,
                'consultantfees_other' => $total_consultantfees_other,
                'consultantfees_prepaid' => $total_consultantfees_prepaid,
                'consultantfees_deduction' => $total_consultantfees_deduction,
                'consultantfees_balance_due' => $total_consultantfees_balance_due,

                'advances_walker_advance' => $total_advances_walker_advance,
                'advances_driver_advance' => $total_advances_driver_advance,
                'advances_other' => $total_advances_other,
                'advances_prepaid' => $total_advances_prepaid,
                'advances_deduction' => $total_advances_deduction,
                'advances_balance_due' => $total_advances_balance_due,

                'sales_amount' => $total_sales_amount,

                'district_manager_amount' => $total_district_manager_amount,

                'gross_profit_before_deduction' => $total_gross_profit_before_deduction,
                'capital_deduction_amount' => $total_capital_deduction_amount,
                'gross_profit_after_deduction' => $total_gross_profit_after_deduction,
                'gross_profit' => $total_gross_profit
            );

        return $col_data;
    }
}
?>