<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeProfileRequest;
use App\Classes\Helper;
use App\User;
use App\Template;
use Entrust;
use Auth;
use Config;
use App\SalaryType;
use App\Salary;
use App\DocumentType;
use Image;
use Activity;
use File;
use Mail;
use DB;

class EmployeeController extends Controller
{
  protected $form = 'employee-form';

  public function index(User $employee){

        if(!Entrust::can('manage_employee'))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(Entrust::can('manage_all_employee'))
          $employees = $employee->get();
        elseif(Entrust::can('manage_subordinate')){
          $childs = Helper::childLocation(Auth::user()->location_id,1);
          $employees = $employee->with('roles')->whereIn('location_id',$childs)->get();
        } else
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        $col_data=array();
        $col_heads = array(
                trans('messages.Option'),
                trans('messages.Employee Code'),
                trans('messages.First Name'),
                trans('messages.Last Name'),
                trans('messages.Username'),
                trans('messages.Email'),
                trans('messages.Mobile Phone'),
                trans('messages.Role'),
                trans('messages.Location'),
                trans('messages.Status'));

        $token = csrf_token();
        foreach ($employees as $employee){
            foreach($employee->roles as $role)
              $role_name = $role->display_name;
            $location = $employee->Location;
            $status = ($employee->Profile->date_of_leaving == null) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">in-active</span>';
            $col_data[] = array(
                    '<div class="btn-group btn-group-xs">'.
                    '<a href="employee/'.$employee->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a> '.
                    '<a href="employee/welcomeEmail/'.$employee->id.'/'.$token.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="Send Welcome Email"> <i class="fa fa-envelope"></i></a>'.
                    '<a href="employee/'.$employee->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a> '.
                    delete_form(['employee.destroy',$employee->id]).
                    '</div>',
                    ($employee->Profile->employee_code != '') ? $employee->Profile->employee_code : 'Not assigned' ,
                    $employee->first_name,
                    $employee->last_name,
                    $employee->username,
                    $employee->email,
                    $employee->mobile_phone,
                    $role_name,
                    $location->location,
                    $status
                    );    
            }

        Helper::writeResult($col_data);

        return view('employee.index',compact('col_heads'));
  }

  public function show(User $employee){

      if(!Entrust::can('view_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->location_id) ))
          return redirect('/dashboard')->withErrors(config('constants.NA'));

      $document_types = DocumentType::lists('document_type_name','id')->all();
      $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
      $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();
      $salary = Salary::where('user_id','=',$employee->id)
          ->lists('amount','salary_type_id')->all();
      
      $profile = $employee->Profile;
      $custom_field_values = Helper::getCustomFieldValues($this->form,$employee->id);
      return view('employee.show',compact('custom_field_values','employee','salary','profile','document_types','earning_salary_types','deduction_salary_types'));
  }

  public function edit(User $employee){
      $child_locations = Helper::childLocation(Auth::user()->location_id,1);

      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !in_array($employee->location_id, $child_locations) ))
          return redirect('/dashboard')->withErrors(config('constants.NA'));

      if(!Helper::getMode())
          return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

      foreach($employee->roles as $role)
        $role_id = $role->id;

      $query = \App\Location::whereNotNull('locations.id');

      if(!Entrust::can('manage_all_employee'))
        $query->whereIn('locations.id',$child_locations);

      $locations = $query->join('clients','clients.id','=','locations.client_id')
        ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location,locations.id AS location_id'))
        ->lists('full_location','location_id')->all();

      $roles = \App\Role::lists('display_name','id')->all();

      return view('employee.edit',compact('employee','locations','roles','role_id'));
  }

  public function profileUpdate(EmployeeProfileRequest $request, $id){

        $employee = User::find($id);

        if(!$employee)
            return redirect('employee')->withErrors(config('constants.INVALID_LINK'));

        if(!Entrust::can('profile_update_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->location_id) ))
            return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        Activity::log('Profile updated');
        $profile = $employee->Profile ?: new Profile;
        $photo = $profile->photo;
        $data = $request->all();
        $profile->fill($data);
        if($request->input('date_of_birth') == '')
            $profile->date_of_birth = null;
        if($request->input('date_of_joining') == '')
            $profile->date_of_joining = null;
        if($request->input('date_of_leaving') == '')
            $profile->date_of_leaving = null;

        if ($request->hasFile('photo') && $request->input('remove_photo') != 1) {
            $filename = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid();
            $file = $request->file('photo')->move('uploads/user/', $filename.".".$extension);
            $img = Image::make('uploads/user/'.$filename.".".$extension);
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('uploads/user/'.$filename.".".$extension);
            $profile->photo = $filename.".".$extension;
        } elseif($request->input('remove_photo') == 1){
            File::delete('uploads/user/'.$profile->photo);
            $profile->photo = null;
        }
        else
        $profile->photo = $photo;

        Helper::updateCustomField($this->form,$employee->id, $data);

        $employee->profile()->save($profile);

        return redirect('/employee/'.$id.'/#basic')->withSuccess(config('constants.SAVED'));
  }

  public function update(EmployeeRequest $request, User $employee){
      if(!Entrust::can('edit_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->location_id) ))
          return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->email = $request->input('email');
        $employee->mobile_phone = $request->input('mobile_phone');
        $employee->location_id = $request->input('location_id');

        if(Entrust::hasRole('admin')){
          $roles[] = $request->input('role_id');
          $employee->roles()->sync($roles);
        }
        $employee->save();

        return redirect('/employee')->withSuccess(config('constants.SAVED'));
  }

  public function changePassword(){
      return view('auth.change_password');
  }

  
  public function doChangePassword(Request $request)
  {
    if(!Helper::getMode())
        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    $this->validate($request, [
            'old_password' => 'required|valid_password',
            'new_password' => 'required|confirmed|different:old_password|min:4',
            'new_password_confirmation' => 'required|different:old_password|same:new_password'
        ]);
        $credentials = $request->only(
                'new_password', 'new_password_confirmation'
        );

        $user = Auth::user();
        
        $user->password = bcrypt($credentials['new_password']);
        $user->save();
        return redirect('change_password')->withSuccess('Password has been changed.');    
  }

  public function doChangeEmployeePassword(Request $request, $id)
  {
    $employee = User::find($id);
        
    if(!Helper::getMode())
        return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

    if(!Entrust::can('reset_employee_password') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->location_id) ))
          return redirect('/dashboard')->withErrors(config('constants.NA'));

    $this->validate($request, [
            'new_password' => 'required|confirmed|min:4',
            'new_password_confirmation' => 'required|same:new_password'
        ]);
        $credentials = $request->only(
                'new_password', 'new_password_confirmation'
        );

        $employee->password = bcrypt($credentials['new_password']);
        $employee->save();
        return redirect()->back()->withSuccess('Password has been changed.');    
  }

  public function destroy(User $employee){
    
        if(!Entrust::can('delete_employee') || (!Entrust::can('manage_all_employee') && Entrust::can('manage_subordinate') && !Helper::isChild($employee->location_id) ))
          return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        if($employee->id == Auth::user()->id)
            return redirect('/employee')->withErrors('You cannot delete yourself. ');

        Helper::deleteCustomField($this->form, $employee->id);
        $employee->delete();
        return redirect('/employee')->withSuccess(config('constants.DELETED'));
  }
}