<?php
namespace App\Http\Controllers;
use App\Classes\Helper;
use Config;
use App\CustomField;
use File;
use Activity;
use Auth;
use Entrust;
use Illuminate\Http\Request;
use App\Http\Requests\CustomFieldRequest;

Class CustomFieldController extends Controller{

	public function index(CustomField $custom_field){

		if(!Entrust::can('manage_custom_field'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_fields = $custom_field->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Form'),
        		trans('messages.Field Title'),
        		trans('messages.Field Type'),
        		trans('messages.Field Value'),
        		trans('messages.Required'),
        		trans('messages.Option'));

		foreach($custom_fields as $custom_field){
			$col_data[] = array(
				Helper::toWord($custom_field->form),
				$custom_field->field_title,
				$custom_field->field_type,
				implode('<br />',explode(',',$custom_field->field_values)),
				($custom_field->field_required) ? 'Yes' : 'No',
				delete_form(['custom_field.destroy',$custom_field->id])
				);
		}

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('custom_field.index',$data);
	}

	public function store(CustomFieldRequest $request, CustomField $custom_field){

		if(!Entrust::can('manage_custom_field'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$data = $request->all();
        $custom_field->fill($data);

		$field_value = explode(',',$request->input('field_value'));
		$field_value = array_unique($field_value);
		$custom_field->field_values = implode(',',$field_value);
		$custom_field->field_name = Helper::create_slug($request->input('field_title'));
		$custom_field->save();

		$activity = 'New Custom Field "'.$request->input('field_title').'" added';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function destroy(CustomField $custom_field){
		if(!Entrust::can('manage_custom_field'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $custom_field->delete();
		$activity = 'Deleted a Custome Field';
		Activity::log($activity);

        return redirect('/custom_field')->withSuccess(config('constants.DELETED'));
	}
}
?>