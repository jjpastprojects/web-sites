<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use Entrust;
use App\Classes\Helper;
use App\Holiday;
use Activity;
use Config;

Class HolidayController extends Controller{

	protected $form = 'holiday-form';

	public function index(Holiday $holiday){

		if(!Entrust::can('manage_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $holidays = Holiday::all();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Date'),
        		trans('messages.Description'));

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($holidays as $holiday){

			$cols = array('<div class="btn-group btn-group-xs">'.
					'<a href="/holiday/'.$holiday->id.'/edit" class="btn btn-default btn-xs md-trigger"> <i class="fa fa-edit"></i></a> '.
					delete_form(['holiday.destroy',$holiday->id]).
					'</div>',
					Helper::showDate($holiday->date),
					$holiday->holiday_description);		
			$id = $holiday->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $assets = ['mutidatepicker'];
        $data = ['col_heads' => $col_heads,'assets' => $assets];
		return view('holiday.index',$data);
	}

	public function show(){
	}

	public function create(){

		if(!Entrust::can('create_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		return view('holiday.create');
	}

	public function edit(Holiday $holiday){

		if(!Entrust::can('edit_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$holiday->id);
		return view('holiday.edit',compact('holiday','custom_field_values'));
	}

	public function store(HolidayRequest $request,Holiday $holiday){	

		if(!Entrust::can('create_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$dates = explode(',',$request->input('date'));
		$data = $request->all();
		foreach($dates as $date){
			$holiday_exists = Holiday::where('date','=',$date)->count();
			if(!$holiday_exists){
				$holiday = new Holiday;
				$holiday->date = $date;
				$holiday->holiday_description = $request->input('holiday_description');
				$holiday->save();
				Helper::storeCustomField($this->form,$holiday->id, $data);
			}
		}

		$activity = 'Added new holiday';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(HolidayRequest $request,Holiday $holiday){

		if(!Entrust::can('edit_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$dates = explode(',',$request->input('date'));
		if(count($dates) > 1)
			return redirect()->back()->withErrors('Only one date can be edited at a time. ');
		
	    $data = $request->all();
		$holiday->fill($data);
		$holiday->save();
		Helper::updateCustomField($this->form,$holiday->id, $data);

		$activity = 'Updated a holiday';
		Activity::log($activity);
		return redirect('/holiday')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Holiday $holiday){
		if(!Entrust::can('delete_holiday'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $holiday->id);
        $holiday->delete();
        return redirect('/holiday')->withSuccess(config('constants.DELETED'));
	}
}
?>