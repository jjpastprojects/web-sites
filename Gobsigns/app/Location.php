<?php
namespace App;
use Eloquent;

class Location extends Eloquent {

	protected $fillable = [
							'client_id',
							'location',
                            'top_location_id',
                            'job_number',
                            'store',
                            'address1',
                            'address2',
                            'city',
                            'state',
                            'zip',
                            'phone',
                            /*'fax',*/
                            'manager',
                            'manager_mobile_phone',
                            'regional_manager',
                            'regional_manager_mobile_phone',
                            'ground_signs',
                            'car_signs',
                            'walker_signs',
                            'verbiage_decals',
                            'address_decals',
                            'ground_signs_quantity',
                            'car_rental_enterprise',
                            'holiday_date_none',
                            'daily_walker_monday',
                            'daily_walker_tuesday',
                            'daily_walker_wednesday',
                            'daily_walker_thursday',
                            'daily_walker_friday',
                            'daily_walker_saturday',
                            'daily_walker_sunday',
                            'daily_driver_monday',
                            'daily_driver_tuesday',
                            'daily_driver_wednesday',
                            'daily_driver_thursday',
                            'daily_driver_friday',
                            'daily_driver_saturday',
                            'daily_driver_sunday',
                            'daily_checkin_monday',
                            'daily_checkin_tuesday',
                            'daily_checkin_wednesday',
                            'daily_checkin_thursday',
                            'daily_checkin_friday',
                            'daily_checkin_saturday',
                            'daily_checkin_sunday',
                            'remaining_ground_signs',
                            'remaining_car_signs',
                            'remaining_walker_signs',
                            'forms_required_monday',
                            'forms_required_tuesday',
                            'forms_required_wednesday',
                            'forms_required_thursday',
                            'forms_required_friday',
                            'forms_required_saturday',
                            'forms_required_sunday',
                            'agency_name_address',
                            'agency_address1',
                            'agency_address2',
                            'agency_city',
                            'agency_state',
                            'agency_zip',
                            'agency_phone',
                            'agency_dm_phone',
                            'agency_branch_email',
                            'agency_range_target',
                            'agency_order_confirms',
                            'walker_start_day',
                            'walker_start_time',
                            'walker_end_time',
                            'drivers_start_day',
                            'drivers_start_time',
                            'drivers_end_time',
                            'print_sign_type',
                            'print_color',
                            'print_layout_approval',
                            'printer',
                            'print_quantity',
                            'print_rate_per',
                            'print_total',
                            'verbiage_top_line',
                            'verbiage_star_burst',
                            'verbiage_store_name',
                            'verbiage_bottom_line',
                            'verbiage_additional_lines',
                            'verbiage_address',
                            'package_ground',
                            'package_express',
                            'emailing_eventNotify',
                            'emailing_invoice',
                            'delivery_order_date',
                            'delivery_date',
                            'signwalker_mon_qty',
                            'signwalker_tue_qty',
                            'signwalker_wed_qty',
                            'signwalker_thu_qty',
                            'signwalker_fri_qty',
                            'signwalker_sat_qty',
                            'signwalker_sun_qty',
                            'signwalker_total_walkers',
                            'signwalker_mon_hours',
                            'signwalker_tue_hours',
                            'signwalker_wed_hours',
                            'signwalker_thu_hours',
                            'signwalker_fri_hours',
                            'signwalker_sat_hours',
                            'signwalker_sun_hours',
                            'signwalker_total_hours',
                            'signwalker_hourly_rate',
                            'signwalker_total_amount',
                            'signdriver_mon_qty',
                            'signdriver_tue_qty',
                            'signdriver_wed_qty',
                            'signdriver_thu_qty',
                            'signdriver_fri_qty',
                            'signdriver_sat_qty',
                            'signdriver_sun_qty',
                            'signdriver_total_walkers',
                            'signdriver_mon_hours',
                            'signdriver_tue_hours',
                            'signdriver_wed_hours',
                            'signdriver_thu_hours',
                            'signdriver_fri_hours',
                            'signdriver_sat_hours',
                            'signdriver_sun_hours',
                            'signdriver_total_hours',
                            'signdriver_hourly_rate',
                            'signdriver_total_amount',
                            'services_sign_rate',
                            'services_walker_rate',
                            'services_driver_rate',
                            'services_other',
                            'services_prepaid',
                            'services_deduction',
                            'services_balance_due',
                            'consultantfees_install_rate',
                            'consultantfees_walker_rate',
                            'consultantfees_driver_rate',
                            'consultantfees_other',
                            'consultantfees_prepaid',
                            'consultantfees_deduction',
                            'consultantfees_balance_due',
                            'advances_walker_advance',
                            'advances_driver_advance',
                            'advances_other',
                            'advances_prepaid',
                            'advances_deduction',
                            'advances_balance_due',
                            'shipping_consultant_checks',
                            'shipping_promotional_materials',
                            'sales_name',
                            'sales_amount',
                            'area_manager_name',
                            'area_manager_amount',
                            'district_manager_name',
                            'district_manager_amount',
                            'capital_deduction_amount'
						];
	protected $primaryKey = 'id';
	protected $table = 'locations';

	protected function client()
    {
        return $this->belongsTo('App\Client','client_id','id');
    }

    protected function children()
    {
        return $this->hasMany('App\Location','top_location_id','id');
    }

    protected function parent()
    {
        return $this->belongsTo('App\Location','top_location_id','id');
    }

	protected function profile()
    {
        return $this->hasMany('App\Profile');
    }

	protected function job()
    {
        return $this->hasMany('App\Job');
    }

	public function notice()
    {
        return $this->belongsToMany('App\Notice','notice_location','notice_id','location_id');
    }

}
